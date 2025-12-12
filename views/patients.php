<?php
include "../config/connection.php";
$getAllPatients = mysqli_query($connection, $allPatients);


if (isset($_POST['addPatient'])) {
    $firstName  = $_POST['firstName'];
    $lastName   = $_POST['lastName'];
    $gender     = $_POST['gender'];
    $phoneNumber = $_POST['phoneNumber'];
    $email      = $_POST['email'];
    $birth      = $_POST['birth'];

    $query = "INSERT INTO patients
              (first_name,last_name,gender,date_of_birth,phone_number,email)
              VALUES ('$firstName', '$lastName', '$gender',
                      '$birth','$phoneNumber','$email')";
    mysqli_query($connection, $query);
    header('Location: patients.php');
    exit;
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "select * from patients where patient_id = $id";
    $query_run = mysqli_query($connection, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $raw) {
?>
            <div id="addPatientForm">
                <div class="justify-center flex ">
                    <form class="p-6 w-1/3 md:w-2/3 bg-gray-100 border border-gray-400 rounded-2xl" action="../views/patients.php" method="POST">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="text" name="patient_id" value="<?= $raw["patient_id"]; ?>" class="hidden">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
                                <input name="firstName" type="text" value="<?= $raw["first_name"]; ?>" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="First Name">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
                                <input name="lastName" type="text" value="<?= $raw["last_name"]; ?>" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Last Name">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Date of Birth</label>
                                <input name="birth" type="date" value="<?= $raw["date_of_birth"]; ?>" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Gender</label>
                                <select name="gender" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                    <option value="" disabled>Select</option>
                                    <option value="male" value="male" <?= ($raw["gender"] === 'male') ? 'selected' : '' ?>>Male</option>
                                    <option value="female" value="male" <?= ($raw["gender"] === 'female') ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                                <input name="phoneNumber" type="tel" value="<?= $raw["phone_number"] ?>" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="05/06/07XXXXXXXX">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                <input name="email" type="email" value="<?= $raw["email"] ?>" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="email@example.com">
                            </div>
                        </div>

                        <button type="submit" class="w-1/2 px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition" name="updatePatient">
                            <i class="fas fa-save mr-2"></i>
                            Save
                        </button>
                    </form>
                </div>
            </div>
<?php
        };
    } else {
        echo "no data found";
    };
}


if (isset($_POST["updatePatient"])) {
    $id         = $_POST["patient_id"];
    $firstName  = $_POST['firstName'];
    $lastName   = $_POST['lastName'];
    $gender     = $_POST['gender'];
    $phoneNumber = $_POST['phoneNumber'];
    $email      = $_POST['email'];
    $birth      = $_POST['birth'];

    $query = "update patients set first_name='$firstName', last_name='$lastName', gender='$gender', phone_number='$phoneNumber', email='$email', date_of_birth='$birth' where patient_id ='$id'";
    $query_run = mysqli_query($connection, $query);
    header('Location: patients.php');
    exit;
}



if (isset($_GET['id'], $connection)) {

    $deleteQuery = $connection->prepare("delete from patients where patient_id = ?");
    $deleteQuery->bind_param('i', $_GET['id']);
    $deleteQuery->execute();
    $deleteQuery->close();
    header('Location: patients.php');
    exit;
}


$search = isset($_GET['search_patient']) ? trim($_GET['search_patient']) : '';

if (!empty($search)) {
    $query = "select * from patients where first_name like '%$search%' or last_name like '%$search%'";
    $getAllPatients = mysqli_query($connection, $query);
} else {
    $getAllPatients = mysqli_query($connection, $allPatients);
}
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
    <script src="../assets/app.js" defer></script>
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

    <form method="GET" action="../views/patients.php" class="mt-5 mr-2 flex justify-end">
        <input type="text" name="search_patient" placeholder="Enter first or last name" value="<?= htmlspecialchars($_GET['search_patient'] ?? '') ?>" class="border border-gray-300 rounded-lg px-4 py-2">
        <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
    </form>

    <div class="flex justify-end">
        <button id="showAddPatientForm" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition flex items-center mt-5 mr-2">
            + Add Patient
        </button>
    </div>

    <div id="addPatientForm" class="hidden">
        <div class="justify-center flex ">
            <form class="p-6 w-1/3 md:w-2/3 bg-gray-100 border border-gray-400 rounded-2xl" action="../views/patients.php" method="POST">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
                        <input name="firstName" type="text" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="First Name">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
                        <input name="lastName" type="text" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Last Name">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Date of Birth</label>
                        <input name="birth" type="date" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Gender</label>
                        <select name="gender" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="" disabled>Select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                        <input name="phoneNumber" type="tel" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="05/06/07XXXXXXXX">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input name="email" type="email" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="email@example.com">
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-6">
                    <button type="button" class="w-1/2 px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Cancel
                    </button>
                    <button type="submit" class="w-1/2 px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition" name="addPatient">
                        <i class="fas fa-save mr-2"></i>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div class="overflow-x-auto flex justify-center mt-5">
        <table class="display w-2/3 md:w-full md:mx-2">
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
                        <td class="py-1">
                            <a class="bg-red-500 text-white px-2 py-1 rounded text-sm font-semibold " href="patients.php?id=<?= $patient['patient_id']; ?>">Delete</a>
                            <a class="bg-green-500 text-white px-2 py-1 rounded text-sm font-semibold " href="patients.php?id=<?= $patient['patient_id']; ?>">Edit</a>
                        </td>
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