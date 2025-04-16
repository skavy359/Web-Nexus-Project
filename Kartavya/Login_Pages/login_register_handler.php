<?php

session_start();
require_once 'config.php';

// Initialize log file
$log_file = 'auth_log.txt';

// Rate limiting function
function checkRateLimit($email)
{
    $max_attempts = 5;
    $lockout_time = 15 * 60; // 15 minutes in seconds

    $rate_file = 'rate_limits.json';
    $current_time = time();

    // Read existing rate limit data
    if (file_exists($rate_file)) {
        $limits = json_decode(file_get_contents($rate_file), true);
    } else {
        $limits = [];
    }

    // Clean up expired entries
    foreach ($limits as $key => $data) {
        if ($current_time - $data['timestamp'] > $lockout_time) {
            unset($limits[$key]);
        }
    }

    // Check if user is locked out
    if (isset($limits[$email]) && $limits[$email]['attempts'] >= $max_attempts) {
        if ($current_time - $limits[$email]['timestamp'] < $lockout_time) {
            $remaining = $lockout_time - ($current_time - $limits[$email]['timestamp']);
            return ['status' => false, 'message' => "Too many failed attempts. Please try again in " . ceil($remaining / 60) . " minutes."];
        } else {
            // Reset attempts if lockout period has passed
            $limits[$email] = ['attempts' => 1, 'timestamp' => $current_time];
        }
    } else {
        // Initialize or increment attempts
        if (!isset($limits[$email])) {
            $limits[$email] = ['attempts' => 1, 'timestamp' => $current_time];
        } else {
            $limits[$email]['attempts']++;
            $limits[$email]['timestamp'] = $current_time;
        }
    }

    // Save updated rate limit data
    file_put_contents($rate_file, json_encode($limits));
    return ['status' => true];
}

// Log function
function logAuth($message)
{
    global $log_file;
    $timestamp = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];
    file_put_contents($log_file, "[$timestamp] [$ip] $message" . PHP_EOL, FILE_APPEND);
}

// Server-side validation functions
function validateEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

function validatePassword($password)
{
    if (strlen($password) < 6) {
        return false;
    }
    return true;
}

if (isset($_POST['register'])) {
    // Server-side validation
    $errors = [];

    // Validate name
    $name = trim($_POST['name']);
    if (empty($name)) {
        $errors[] = "Name is required";
    }

    // Validate email
    $email = trim($_POST['email']);
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!validateEmail($email)) {
        $errors[] = "Invalid email format";
    }

    // Validate password
    $password = $_POST['password'];
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (!validatePassword($password)) {
        $errors[] = "Password must be at least 6 characters long";
    }

    // If validation fails
    if (!empty($errors)) {
        $_SESSION['register_error'] = implode(', ', $errors);
        $_SESSION['active_form'] = 'register';
        header("Location: login_page.php");
        exit();
    }

    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email'");

        if ($checkEmail === false) {
            throw new Exception("Database query error: " . $conn->error);
        }

        if ($checkEmail->num_rows > 0) {
            $_SESSION['register_error'] = 'Email is already registered!';
            $_SESSION['active_form'] = 'register';
        } else {
            $result = $conn->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password_hash')");

            if ($result === false) {
                throw new Exception("Database error during registration: " . $conn->error);
            }

            // Log successful registration
            logAuth("User registered: $email");

            // Set success message
            $_SESSION['register_success'] = 'Registration successful! You can now log in.';
            $_SESSION['active_form'] = 'login';
        }
    } catch (Exception $e) {
        logAuth("Registration error: " . $e->getMessage());
        $_SESSION['register_error'] = 'An error occurred during registration. Please try again later.';
        $_SESSION['active_form'] = 'register';
    }

    header("Location: login_page.php");
    exit();
}

if (isset($_POST['login'])) {
    // Server-side validation
    $errors = [];

    // Validate email
    $email = trim($_POST['email']);
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!validateEmail($email)) {
        $errors[] = "Invalid email format";
    }

    // Validate password
    $password = $_POST['password'];
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // If validation fails
    if (!empty($errors)) {
        $_SESSION['login_error'] = implode(', ', $errors);
        $_SESSION['active_form'] = 'login';
        header("Location: login_page.php");
        exit();
    }

    // Check rate limiting
    $rate_check = checkRateLimit($email);
    if (!$rate_check['status']) {
        $_SESSION['login_error'] = $rate_check['message'];
        $_SESSION['active_form'] = 'login';
        logAuth("Rate limit exceeded for: $email");
        header("Location: login_page.php");
        exit();
    }

    try {
        $result = $conn->query("SELECT * from users WHERE email = '$email'");

        if ($result === false) {
            throw new Exception("Database query error: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Regenerate session ID for security
                session_regenerate_id(true);

                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];

                // Log successful login
                logAuth("Successful login: $email");

                // Redirect based on role if you still want to use this logic
                // You may need to adjust this based on your database schema
                if (isset($user['role']) && $user['role'] === 'admin') {
                    header("Location: admin_page.php");
                } else {
                    header("Location: user_page.php");
                }
                exit();
            } else {
                // Log failed login
                logAuth("Failed login (wrong password): $email");
            }
        } else {
            // Log failed login
            logAuth("Failed login (email not found): $email");
        }

        $_SESSION['login_error'] = 'Incorrect email or password';
        $_SESSION['active_form'] = 'login';
    } catch (Exception $e) {
        logAuth("Login error: " . $e->getMessage());
        $_SESSION['login_error'] = 'An error occurred during login. Please try again later.';
        $_SESSION['active_form'] = 'login';
    }

    header("Location: login_page.php");
    exit();
}
?>