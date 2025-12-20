<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unity Care Clinic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="bg-gray-50 flex h-screen overflow-hidden">

    <aside class="bg-gray-800 text-white w-64 shrink-0 hidden md:block">
        <div class="p-4 gradient-bg">
            <div class="flex items-center">
                <i class="fas fa-hospital text-2xl mr-3"></i>
                <h1 class="text-xl font-bold">Unity Care</h1>
            </div>
        </div>

        <nav class="mt-6">
            <a href="views\dashboard.php" class="flex items-center px-6 py-3 hover:bg-gray-700 transition">
                <span>Dashboard</span>
            </a>
            <a href="views\patients.php" class="flex items-center px-6 py-3 hover:bg-gray-700 transition">
                <span>Patients</span>
            </a>
            <a href="views\doctors.php" class="flex items-center px-6 py-3 hover:bg-gray-700 transition">
                <span>Doctors</span>
            </a>
            <a href="views\departments.php" class="flex items-center px-6 py-3 hover:bg-gray-700 transition">
                <span>Departments</span>
            </a>      
        </nav>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        <nav class="gradient-bg shadow-lg shrink-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <i class="fas fa-hospital text-white text-3xl mr-3 md:hidden"></i>
                        <span class="text-white text-2xl font-bold md:hidden">Unity Care Clinic</span>
                        <span class="text-white text-2xl font-bold hidden md:block">Welcome</span>
                    </div>
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="views\dashboard.php" class="text-white hover:text-gray-200 px-3 py-2 rounded-md text-xl font-medium">
                            <i class="fas fa-chart-line mr-2"></i>Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">

            <div class="gradient-bg text-white py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h1 class="text-5xl font-bold mb-4">Hospital Management System</h1>
                    <p class="text-xl mb-8 text-gray-100">Comprehensive administration platform for Unity Care Clinic</p>
                    <a href="views\dashboard.php" class="bg-white text-black hover:text-gray-600 px-3 py-2 rounded-md text-xl font-medium">
                        <i class="fas fa-chart-line mr-2"></i>Dashboard
                    </a>
                </div>
            </div>

            <div class="bg-white py-12 mt-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Key Features</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="text-center p-6">
                            <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-chart-line text-blue-600 text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 mb-2">Dashboard</h3>
                            <p class="text-gray-600 text-sm">Real-time statistics and interactive charts</p>
                        </div>

                        <div class="text-center p-6">
                            <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-shield-alt text-purple-600 text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 mb-2">Secure</h3>
                            <p class="text-gray-600 text-sm">Protection against SQL injections</p>
                        </div>

                        <div class="text-center p-6">
                            <div class="bg-orange-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-bolt text-orange-600 text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 mb-2">Performance</h3>
                            <p class="text-gray-600 text-sm">Query optimization and response times</p>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="bg-gray-800 text-white py-8 mt-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <h3 class="text-lg font-bold mb-4">Unity Care Clinic</h3>
                            <p class="text-gray-400 text-sm">Modern and secure hospital management system.</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-4">Technologies</h3>
                            <ul class="space-y-2 text-sm text-gray-400">
                                <li>Procedural PHP 8.5</li>
                                <li>MySQLi</li>
                                <li>Tailwind CSS</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-4">Contact</h3>
                            <p class="text-gray-400 text-sm">
                                <i class="fas fa-envelope mr-2"></i>contact@hc.unity.com<br>
                                <i class="fas fa-phone mr-2"></i>+212 666666666
                            </p>
                        </div>
                    </div>
                    <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400 text-sm">
                        <p>&copy; 2025 Unity Care Clinic. All rights reserved.</p>
                    </div>
                </div>
            </footer>

        </main>
    </div>
</body>

</html>