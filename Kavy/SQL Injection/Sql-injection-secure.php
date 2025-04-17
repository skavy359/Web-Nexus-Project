<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /Web-Nexus-Project/Kartavya/Login_Pages/login_page.php");
    exit;
}

$search_term = "";
$search_results = [];
$security_message = "";

$pdo = new stdClass();
$pdo->query_log = [];
$stmt = new stdClass();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search_term = $_POST['search_term'];
    $secure_query = "SELECT * FROM products WHERE name LIKE ?";
    $search_param = "%" . $search_term . "%";
    
    $pdo->query_log[] = [
        'query' => $secure_query,
        'params' => [$search_param]
    ];
    
    $security_message = "<div class='text-green-500 mb-4'>
        <p class='font-bold'>✓ SECURE IMPLEMENTATION</p>
        <p>Using prepared statements with parameter binding:</p>
        <p>Secure Query: <span class='font-mono bg-gray-800 px-2 py-1 rounded text-yellow-300'>$secure_query</span></p>
        <p>Parameters: <span class='font-mono bg-gray-800 px-2 py-1 rounded text-yellow-300'>['$search_param']</span></p>
        <p class='mt-2 text-xs'>This implementation prevents:</p>
        <ul class='list-disc ml-5 text-xs'>
            <li>SQL injection attacks</li>
            <li>Unintended data access</li>
            <li>Database manipulation</li>
        </ul>
    </div>";

    $injection_patterns = [
        "' OR '1'='1", "1=1", "1==1", "' OR 1=1 --", "\" OR 1=1 --", 
        "OR 1=1", "' OR 1=1", "admin'--", "1'='1"
    ];
    
    if (in_array($search_term, $injection_patterns)) {
        if (stripos('laptop', $search_term) !== false) {
            $search_results[] = ['id' => 1, 'name' => 'Laptop', 'price' => '$999.99'];
        }
    } else {
        if (stripos('laptop', $search_term) !== false) {
            $search_results[] = ['id' => 1, 'name' => 'Laptop', 'price' => '$999.99'];
        }
        if (stripos('smartphone', $search_term) !== false) {
            $search_results[] = ['id' => 2, 'name' => 'Smartphone', 'price' => '$699.99'];
        }
        if (stripos('headphones', $search_term) !== false) {
            $search_results[] = ['id' => 3, 'name' => 'Headphones', 'price' => '$149.99'];
        }
        if (stripos('monitor', $search_term) !== false) {
            $search_results[] = ['id' => 4, 'name' => 'Monitor', 'price' => '$299.99'];
        }
        if (stripos('keyboard', $search_term) !== false) {
            $search_results[] = ['id' => 5, 'name' => 'Keyboard', 'price' => '$89.99'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Form - SQL Injection Protection</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/night-owl.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            hljs.highlightAll();
        });
    </script>
</head>

<body class="bg-[#020617] text-white font-['Lexend'] cursor-[url('/Assets/Images/cursor_01.png'),_auto]">
    <!-- HEADER -->
    <nav class="fixed z-[999] top-0 left-0 h-[10vh] w-screen flex items-center justify-between p-4 bg-[#020617] border-b-2 border-[#3E4B5E] max-md:p-0">
        <div class="headerStuff flex items-center space-x-3 max-md:space-x-1">
            <img src="/Web-Nexus-Project/Assets/Images/logo.svg" alt="logo" class="w-12 max-md:w-8">
            <span class="text-2xl font-bold text-white font-['Press_Start_2P'] font-black drop-shadow-[5px_5px_0px_black] max-md:text-xs hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Web-Nexus</span>
        </div>

        <div class="flex items-center justify-between space-x-10 max-md:space-x-4">
            <a href="/Web-Nexus-Project/Kavy/Home/Home-Page.php#vulnerabilities" class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
            <a href="/Web-Nexus-Project/Kavy/Home/Home-Page.php" class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Home</a>
            <a href="/Web-Nexus-Project/Karan/About Us/contact us.php" class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Contact Us</a>
        </div>

        <div class="hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] flex justify-center items-center">
            <div onclick="window.location.href='Sql-injection.php'" class="yellowButton yellowButtonHeader hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                <div class="relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 mr-3 rounded-md border-3 border-[rgb(221,170,16)] transition-colors duration-500">
                    <div class="font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] text-black font-thin text-sm max-md:text-[8px]">
                        <a href="/Web-Nexus-Project/Kavy/SQL Injection/Sql-injection.php">Back to Vulnerability</a>
                    </div>
                    <div class="absolute w-[102%] h-[115%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md transition-colors duration-500 -z-1 top-[1%] left-0"></div>
                </div>
            </div>
        </div>
    </nav>
    <!-- MAIN CONTENT -->
    <div class="pt-[15vh] pb-10 px-4 flex flex-col items-center justify-start min-h-screen">
        <div class="w-full max-w-7xl flex flex-col md:flex-row gap-8">
            <!-- LEFT SIDE: FORM -->
            <div class="formSection md:w-1/2 bg-[#0F172A] p-6 rounded-lg border-2 border-[#3E4B5E] shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="flex items-center justify-center font-['Press_Start_2P'] text-white font-black text-xl border-2 border-[#3E4B5E] rounded-full w-10 h-10 mr-4">✓</div>
                    <h2 class="text-2xl font-['Press_Start_2P'] text-green-500">Secure Search</h2>
                </div>

                <?php echo $security_message; ?>

                <form method="POST" class="mt-4">
                    <div class="mb-6">
                        <label for="search_term" class="block text-sm font-medium text-gray-300 mb-1">Product Search</label>
                        <input type="text" name="search_term" id="search_term" value="<?php echo htmlspecialchars($search_term); ?>" placeholder="Enter product name" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-300">
                        <p class="text-xs text-gray-400 mt-1">Try searching for a product or try SQL injection - it won't work!</p>
                    </div>
                    
                    <button type="submit" class="relative bg-green-500 hover:bg-green-600 w-full px-4 py-3 rounded-md border-2 border-[rgb(34,197,94)] transition-colors duration-500 group hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                        <div class="font-['Press_Start_2P'] text-black group-hover:text-white drop-shadow-[2px_2px_0px_rgb(34,197,94)] text-sm">Search (Secure)</div>
                        <div class="absolute w-[101%] h-[110%] bg-[rgb(34,197,94)] hover:bg-green-600 rounded-md transition-colors duration-500 -z-10 top-[2%] left-0"></div>
                    </button>
                    
                    <div class="mt-4 text-center">
                        <a href="Sql-injection-Vulnerable.php" class="text-blue-400 hover:text-blue-300 text-sm hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">See the vulnerable version</a>
                    </div>
                </form>

                <?php if (!empty($search_results)): ?>
                <div class="mt-6">
                    <h3 class="text-lg font-bold text-white mb-2">Search Results</h3>
                    <div class="bg-[#1E293B] rounded-md overflow-hidden">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-800">
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-300">ID</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-300">Product</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-300">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($search_results as $product): ?>
                                <tr class="border-t border-gray-700">
                                    <td class="px-4 py-2 text-sm text-gray-300"><?php echo $product['id']; ?></td>
                                    <td class="px-4 py-2 text-sm text-gray-300"><?php echo htmlspecialchars($product['name']); ?></td>
                                    <td class="px-4 py-2 text-sm text-gray-300"><?php echo htmlspecialchars($product['price']); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- RIGHT SIDE: EXPLANATION -->
            <div class="formSection md:w-1/2 bg-[#0F172A] p-6 rounded-lg border-2 border-[#3E4B5E] shadow-lg">
                <h3 class="text-xl font-['Press_Start_2P'] text-green-500 mb-6">Security Implementation</h3>
                
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">How it's secured</h4>
                    <p class="text-gray-300 mb-4">This form uses prepared statements with parameter binding to prevent SQL injection:</p>
                    <pre class="bg-gray-800 p-4 rounded-md overflow-x-auto mb-4">
<code class="language-php">// Secure implementation
$stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ?");
$search_param = "%" . $search_term . "%";
$stmt->execute([$search_param]);
</code>
                    </pre>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Why this is secure</h4>
                    <ul class="list-disc pl-5 text-gray-300 space-y-2">
                        <li>User input is <strong>never</strong> directly embedded in SQL queries</li>
                        <li>Parameters are sent separately from the SQL command</li>
                        <li>Input with special characters is automatically escaped</li>
                        <li>SQL structure cannot be modified by user input</li>
                        <li>Each parameter has a defined data type and validation</li>
                    </ul>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Comparison</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-red-900/30 p-4 rounded-md">
                            <p class="font-bold text-red-400 mb-2">Vulnerable</p>
                            <pre class="text-xs overflow-x-auto">
<code class="language-php">
    $query = "SELECT * FROM products 
    WHERE name LIKE '%" . $search_term . "%'";
</code>
                            </pre>
                            <p class="text-xs mt-2 text-gray-400">User input directly in query</p>
                        </div>
                        <div class="bg-green-900/30 p-4 rounded-md">
                            <p class="font-bold text-green-400 mb-2">Secure</p>
                            <pre class="text-xs overflow-x-auto">
<code class="language-php">
    $stmt = $pdo->prepare(
    "SELECT * FROM products WHERE name LIKE ?"
    );
    $stmt->execute(["%".$search_term."%"]);
</code>
                            </pre>
                            <p class="text-xs mt-2 text-gray-400">Parameters separate from SQL</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-white mb-2">Additional Security Measures</h4>
                    <ul class="list-disc pl-5 text-gray-300 space-y-2">
                        <li><strong>Output escaping</strong>: Using 
                        <code class="bg-gray-800 px-1 rounded text-xs">htmlspecialchars()</code>
                        to prevent XSS attacks when displaying data</li>
                        <li><strong>Input validation</strong>: Validating input formats before processing</li>
                        <li><strong>Least privilege</strong>: Database users should have minimal required permissions</li>
                        <li><strong>Error handling</strong>: Custom error messages that don't reveal database details</li>
                        <li><strong>Database abstraction</strong>: Using ORM libraries for additional safety layers</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="bg-gray-950 text-white py-16 mt-16">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 text-center md:text-left">
            <div>
                <img src="/Web-Nexus-Project/Assets/Images/logo.svg" alt="Web-Nexus Logo" class="w-24 mx-auto md:mx-0">
                <p class="mt-4 text-gray-400">Learn security the hands-on-way.</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Company</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact us.php" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">About Us</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Careers</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Support</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact us.php" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Help Center</a></li>
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact us.php" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Contact</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">FAQs</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Follow Us</h3>
                <div class="mt-4 flex justify-center md:justify-start space-x-4">
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Web-Nexus-Project/Assets/Images/github.png" alt="Github" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Web-Nexus-Project/Assets/Images/LinkedIn.jpg" alt="Linkedin" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Web-Nexus-Project/Assets/Images/twitter.jpg" alt="Twitter" class="w-8">
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-12 text-center text-gray-500">
            &copy; 2025 Web-Nexus. All Rights Reserved.
        </div>
    </footer>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/gsap.min.js" integrity="sha512-f6bQMg6nkSRw/xfHw5BCbISe/dJjXrVGfz9BSDwhZtiErHwk7ifbmBEtF9vFW8UNIQPhV2uEFVyI/UHob9r7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/ScrollTrigger.min.js" integrity="sha512-AcqPGqrrAEtEwe+ADO5R8RbdFi7tuU7b/A2cJJH0Im0D18NRk5p5s4B3E5PMuO81KFw0ClN7J5SHVUJz7KOb0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/Web-Nexus-Project/Malay/Animations/DeserialisationAnimation/vulnerable_deserialisation_animation.js"></script>

</body>
</html>