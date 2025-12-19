<?php
include "../config/connection.php";

if (isset($_SESSION['admin_id'])) {
    header('location:dashboard.php');
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "select * from admins where username = '$username' and password = '$password'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $row['id'];
        header('location:dashboard.php');
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>
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
                    <input type="text" name="username" placeholder="Enter your username" required class="w-full px-4 py-3 bg-gray-400 border rounded-lg text-white font-medium text-2xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-md font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required class="w-full px-4 py-3 border bg-gray-400 rounded-lg text-white font-medium focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition">
                    Login
                </button>
                <?php if ($error): ?>
                    <div class="text-white p-3">
                        <?= $error ?>
                    </div>
                <?php endif; ?>
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