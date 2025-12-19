<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-900 min-h-screen">
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full h-screen md:h-auto md:w-2/3 lg:w-1/3 bg-gray-700 md:rounded-xl md:shadow-lg overflow-hidden flex flex-col">
            <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-800 text-white flex items-center">
                <i class="fas fa-hospital text-2xl mr-3"></i>
                <h1 class="text-xl font-bold">Hospital System</h1>
            </div>
            <form method="POST" action="login.php" class="p-6 flex-1 flex flex-col justify-center space-y-5">
                <div>
                    <label class="block text-md font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" required class="w-full px-4 py-3 bg-gray-400 border rounded-lg text-white font-medium text-2xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-md font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 border bg-gray-400 rounded-lg text-white font-medium focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition">
                    Login
                </button>
            </form>

            <footer class="bg-gray-800 text-white py-8 mt-12">
                <div class="max-w-7xl mx-auto px-4 text-center text-gray-400 text-sm">
                    <p>&copy; 2025 Unity Care Clinic. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>