<?php
include "../config/connection.php";
$getAllPatients = mysqli_query($connection, $allPatients);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unity Care Clinic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body class="bg-gray-50">
    <nav class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-hospital text-white text-3xl mr-3"></i>
                    <span class="text-white text-2xl font-bold">Unity Care Clinic</span>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="#" class="text-white hover:text-gray-200 px-3 py-2 rounded-md text-xl font-medium">
                        <i class="fas fa-chart-line mr-2"></i>Dashboard
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="overflow-x-auto flex justify-center mt-12">
        <table class="display w-2/3">
            <thead>
                <tr>
                    <th class="border text-center">Full Name</th>
                    <th class="border text-center">Birth Date</th>
                    <th class="border text-center">Gender</th>
                    <th class="border text-center">Phone</th>
                    <th class="border text-center">Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($patient = mysqli_fetch_assoc($getAllPatients)):
                ?>
                    <tr>
                        <td class="border text-center"><?= $patient['first_name']; ?> <?= $patient['last_name']; ?></td>
                        <td class="border text-center"><?= $patient['date_of_birth']; ?></td>
                        <td class="border text-center"><?= htmlspecialchars(strtoupper(substr($patient['gender'], 0, 1))) ?></td>
                        <td class="border text-center"><?= $patient['phone_number']; ?></td>
                        <td class="border text-center"><?= $patient['email']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
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
</body>

</html>