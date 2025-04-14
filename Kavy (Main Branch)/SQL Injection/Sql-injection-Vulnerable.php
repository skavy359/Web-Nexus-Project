<?php

session_start();
$search_term = "";
$search_results = [];
$vulnerability_message = "";
$db_connection = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search_term = $_POST['search_term'];
    $query = "SELECT * FROM products WHERE name LIKE '%" . $search_term . "%'";
    
    if (
        $search_term == "' OR '1'='1" || 
        $search_term == "1=1" || 
        $search_term == "1==1" || 
        $search_term == "' OR 1=1 --" || 
        $search_term == "\" OR 1=1 --" || 
        $search_term == "OR 1=1" ||
        $search_term == "' OR 1=1" ||
        $search_term == "admin'--" ||
        $search_term == "1'='1"
    ) {
        $search_results = [
            ['id' => 1, 'name' => 'Laptop', 'price' => '$999.99'],
            ['id' => 2, 'name' => 'Smartphone', 'price' => '$699.99'],
            ['id' => 3, 'name' => 'Headphones', 'price' => '$149.99'],
            ['id' => 4, 'name' => 'Monitor', 'price' => '$299.99'],
            ['id' => 5, 'name' => 'Keyboard', 'price' => '$89.99'],
            ['id' => 6, 'name' => 'Admin Account', 'price' => 'RESTRICTED']
        ];
        
        $vulnerability_message = "<div class='text-red-500 mb-4'>
            <p class='font-bold'>⚠️ VULNERABILITY DETECTED ⚠️</p>
            <p>SQL Injection detected in query!</p>
            <p>Vulnerable Query: <span class='font-mono bg-gray-800 px-2 py-1 rounded text-yellow-300'>$query</span></p>
            <p class='mt-2 text-xs'>This query is vulnerable to:</p>
            <ul class='list-disc ml-5 text-xs'>
                <li>Data extraction beyond intended scope</li>
                <li>Authentication bypass</li>
                <li>Data manipulation (UPDATE/DELETE operations)</li>
                <li>Potential server access</li>
            </ul>
        </div>";
    } else {
        if (stripos('laptop', $search_term) !== false) {
            $search_results[] = ['id' => 1, 'name' => 'Laptop', 'price' => '$999.99'];
        }
        if (stripos('smartphone', $search_term) !== false) {
            $search_results[] = ['id' => 2, 'name' => 'Smartphone', 'price' => '$699.99'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable Form - SQL Injection</title>
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
            <img src="/Assets/Images/logo.svg" alt="logo" class="w-12 max-md:w-8">
            <span class="text-2xl font-bold text-white font-['Press_Start_2P'] font-black drop-shadow-[5px_5px_0px_black] max-md:text-xs hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Web-Nexus</span>
        </div>

        <div class="space-x-10 max-md:space-x-4 flex flex-1 justify-center items-center">
            <a href="/Kavy (Main Branch)/Home/Home-Page.html#vulnerabilities" class="headerStuff transition-transform duration-300 ease-in-out hover:scale-105 hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] hover:text-lg text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
            <a href="/Kavy (Main Branch)/Home/Home-Page.html" class="headerStuff transition-transform duration-300 ease-in-out hover:scale-105 hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] hover:text-lg text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Home</a>
            <a href="/Karan/About Us/contact_us.html" class="headerStuff transition-transform duration-300 ease-in-out hover:scale-105 hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] hover:text-lg text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Contact Us</a>
        </div>

        <div class="hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] flex justify-center items-center">
            <div class="yellowButton yellowButtonHeader hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                <div class="relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 mr-3 rounded-md border-3 border-[rgb(221,170,16)] transition-colors duration-500">
                    <div class="font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] text-black font-thin text-sm max-md:text-[8px]">
                        <a href="/Kartavya/Login_Pages/page1_login_register.php" class="hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Log In</a>
                    </div>
                    <div class="absolute w-[105%] h-[115%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md  transition-colors duration-500 -z-1 top-[1%] left-0"></div>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="pt-[15vh] pb-10 px-4 flex flex-col items-center justify-start min-h-screen">
        <div class="w-full max-w-7xl flex flex-col md:flex-row gap-8">
            <!-- LEFT SIDE: FORM -->
            <div class="md:w-1/2 bg-[#0F172A] p-6 rounded-lg border-2 border-[#3E4B5E] shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="flex items-center justify-center font-['Press_Start_2P'] text-white font-black text-xl border-2 border-[#3E4B5E] rounded-full w-10 h-10 mr-4">!</div>
                    <h2 class="text-2xl font-['Press_Start_2P'] text-red-500">Vulnerable Search</h2>
                </div>

                <?php echo $vulnerability_message; ?>

                <form method="POST" class="mt-4">
                    <div class="mb-6">
                        <label for="search_term" class="block text-sm font-medium text-gray-300 mb-1">Product Search</label>
                        <input type="text" name="search_term" id="search_term" value="<?php echo htmlspecialchars($search_term); ?>" placeholder="Enter product name" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-yellow-300">
                        <p class="text-xs text-gray-400 mt-1">Try searching for a product or try SQL injection: ' OR '1'='1', 1=1, 1==1</p>
                    </div>
                    
                    <button type="submit" class="relative bg-red-500 hover:bg-red-600 w-full px-4 py-3 rounded-md border-2 border-[rgb(239,68,68)] transition-colors duration-500 group hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                        <div class="font-['Press_Start_2P'] text-black group-hover:text-white drop-shadow-[2px_2px_0px_rgb(239,68,68)] text-sm">Search (Insecure)</div>
                        <div class="absolute w-[101%] h-[110%] bg-[rgb(239,68,68)] hover:bg-red-600 rounded-md transition-colors duration-500 -z-10 top-[2%] left-0"></div>
                    </button>
                    
                    <div class="mt-4 text-center">
                        <a href="Sql-injection-secure.php" class="text-blue-400 hover:text-blue-300 text-sm hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Try the secure version</a>
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
                                    <td class="px-4 py-2 text-sm text-gray-300"><?php echo $product['name']; ?></td>
                                    <td class="px-4 py-2 text-sm <?php echo $product['name'] === 'Admin Account' ? 'text-red-400' : 'text-gray-300'; ?>">
                                        <?php echo $product['price']; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- RIGHT SIDE: EXPLANATION -->
            <div class="md:w-1/2 bg-[#0F172A] p-6 rounded-lg border-2 border-[#3E4B5E] shadow-lg">
                <h3 class="text-xl font-['Press_Start_2P'] text-red-500 mb-6">Vulnerability Explained</h3>
                
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">What's happening?</h4>
                    <p class="text-gray-300 mb-4">This form directly concatenates user input into SQL queries without proper sanitization:</p>
                    <pre class="bg-gray-800 p-4 rounded-md overflow-x-auto mb-4">
<code class="language-php">// Vulnerable implementation
    $query = "SELECT * FROM products WHERE name LIKE '%" . $search_term . "%'";
</code>
                    </pre>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Why is this vulnerable?</h4>
                    <ul class="list-disc pl-5 text-gray-300 space-y-2">
                        <li>User input is directly embedded in SQL queries</li>
                        <li>Attacker can manipulate query structure with special characters</li>
                        <li>Can lead to unauthorized data access (e.g., '1'='1' returns ALL records)</li>
                        <li>Could allow data modification or deletion with additional SQL commands</li>
                    </ul>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Attack Demonstration</h4>
                    <div class="bg-gray-800 p-4 rounded-md">
                        <p class="text-gray-300">Input examples:</p>
                        <ul class="list-disc pl-5 text-gray-300 space-y-1">
                            <li><span class="font-mono text-yellow-300">' OR '1'='1</span></li>
                            <li><span class="font-mono text-yellow-300">1=1</span></li>
                            <li><span class="font-mono text-yellow-300">1==1</span></li>
                            <li><span class="font-mono text-yellow-300">' OR 1=1 --</span></li>
                        </ul>
                        <p class="text-gray-300 mt-2 text-sm">Conditions like <span class="font-mono text-yellow-300">'1'='1'</span> or <span class="font-mono text-yellow-300">1=1</span> are always true, causing the query to return ALL records, including restricted ones!</p>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-white mb-2">Secure Alternative</h4>
                    <pre class="bg-gray-800 p-4 rounded-md overflow-x-auto">
<code class="language-php">
    // Secure implementation using prepared statements
    $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ?");
    $search_param = "%" . $search_term . "%";
    $stmt->execute([$search_param]);
</code>
                    </pre>
                    <p class="text-gray-300 mt-2">The secure version uses prepared statements with parameter binding, which separates SQL code from user data, preventing injection attacks.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="bg-gray-950 text-white py-16 mt-16">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 text-center md:text-left">
            <div>
                <img src="/Assets/Images/logo.svg" alt="Web-Nexus Logo" class="w-24 mx-auto md:mx-0">
                <p class="mt-4 text-gray-400">Learn security the hands-on-way.</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Company</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="/Karan/About Us/contact_us.html" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">About Us</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Careers</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Support</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="/Karan/About Us/contact_us.html" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Help Center</a></li>
                    <li><a href="/Karan/About Us/contact_us.html" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Contact</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">FAQs</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Follow Us</h3>
                <div class="mt-4 flex justify-center md:justify-start space-x-4">
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Assets/Images/github.png" alt="Github" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Assets/Images/LinkedIn.jpg" alt="Linkedin" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Assets/Images/twitter.jpg" alt="Twitter" class="w-8">
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-12 text-center text-gray-500">
            &copy; 2025 Web-Nexus. All Rights Reserved.
        </div>
    </footer>

    </body>
</html>