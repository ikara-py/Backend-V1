<?php
include "../config/connection.php";

function addDoctors($connection){
    $firstName  = $_POST['firstName'];
    $lastName   = $_POST['lastName'];
    $specialization = $_POST['specialization'];
    $phoneNumber = $_POST['phoneNumber'];
    $email      = $_POST['email'];

    $query = "insert into doctors
              (first_name,last_name,specialization,phone_number,email)
              values ('$firstName', '$lastName', '$specialization',
                      '$phoneNumber','$email')";
    mysqli_query($connection, $query);
    header('location:doctors.php');
    exit;
}

if (isset($_POST['updatePatient'])) {
    $id = $_POST['doctor_id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phoneNumber'];
    $specialization = $_POST['specialization'];

    $query = "UPDATE doctors SET first_name='$firstName', last_name='$lastName', email='$email', phone_number='$phone', specialization='$specialization' WHERE doctor_id=$id";
    mysqli_query($connection, $query);
    header('location:doctors.php');
    exit;
}

$search = isset($_GET['search_patient']) ? trim($_GET['search_patient']) : '';

if (!empty($search)) {
    $query = "select * from doctors where first_name like '%$search%' or last_name like '%$search%'";
    $getAllDoctors = mysqli_query($connection, $query);
} else {
    $query = "select * from doctors";
    $getAllDoctors = mysqli_query($connection, $query);
}

function edit_d($connection)
{
    if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
        echo "Invalid doctor ID for editing.";
        return;
    }

    $id = $_GET["id"];
    $query = "select * from doctors where doctor_id = $id";
    $query_run = mysqli_query($connection, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $raw) {
?>
            <script src="https://cdn.tailwindcss.com"></script>
            <div id="editDoctorModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-2xl p-6 w-full max-w-2xl mx-4">
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Edit Doctor Record</h3>
                    <form class="bg-white" action="doctors.php" method="POST">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="text" name="doctor_id" value="<?= $raw["doctor_id"]; ?>" class="hidden">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
                                <input name="firstName" type="text" value="<?= $raw["first_name"]; ?>" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
                                <input name="lastName" type="text" value="<?= $raw["last_name"]; ?>" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Specialization</label>
                                <select name="specialization" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                    <option value="cardiology" <?= $raw['specialization'] == 'cardiology' ? 'selected' : '' ?>>cardiology</option>
                                    <option value="pediatrics" <?= $raw['specialization'] == 'pediatrics' ? 'selected' : '' ?>>pediatrics</option>
                                    <option value="neurology" <?= $raw['specialization'] == 'neurology' ? 'selected' : '' ?>>neurology</option>
                                    <option value="orthopedics" <?= $raw['specialization'] == 'orthopedics' ? 'selected' : '' ?>>orthopedics</option>
                                    <option value="oncology" <?= $raw['specialization'] == 'oncology' ? 'selected' : '' ?>>oncology</option>
                                    <option value="gynecology" <?= $raw['specialization'] == 'gynecology' ? 'selected' : '' ?>>gynecology</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                                <input name="phoneNumber" type="tel" value="<?= $raw["phone_number"] ?>" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                <input name="email" type="email" value="<?= $raw["email"] ?>" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4 mt-6">
                            <a href="doctors.php" class="w-1/2 px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-center">
                                Cancel
                            </a>
                            <button type="submit" class="w-1/2 px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition" name="updatePatient">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
<?php
        };
    } else {
        echo "no data found";
    };
}


function delete_d($connection)
{
    if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
        header('location:doctors.php');
        exit;
    }

    $id = $_GET["id"];
    $deleteQuery = $connection->prepare("delete from doctors where doctor_id = ?");
    $deleteQuery->bind_param('i', $id);
    $deleteQuery->execute();
    $deleteQuery->close();
    header('location:doctors.php');
    exit;
}


$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case "delete":
        delete_d($connection);
        break;
    case "edit":
        edit_d($connection);
        break;
    default:
}

if(isset($_POST['addPatient'])){
    addDoctors($connection);
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

<body class="bg-gray-50 flex h-screen overflow-hidden">

    <aside class="bg-gray-800 text-white w-64 shrink-0 hidden md:block">
        <div class="p-4 gradient-bg">
            <div class="flex items-center">
                <i class="fas fa-hospital text-2xl mr-3"></i>
                <h1 class="text-xl font-bold">Unity Care</h1>
            </div>
        </div>

        <nav class="mt-6">
            <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-700 transition">
                <span>Dashboard</span>
            </a>
            <a href="patients.php" class="flex items-center px-6 py-3 hover:bg-gray-700 transition">
                <span>Patients</span>
            </a>
            <a href="doctors.php" class="flex items-center px-6 py-3 bg-gray-900 border-l-4 border-blue-500">
                <span>Doctors</span>
            </a>
            <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-700 transition">
                <span>Departments</span>
            </a>
            <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-700 transition">
                <span>appointments</span>
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
                        <span class="text-white text-2xl font-bold hidden md:block">Doctors Management</span>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">

            <form method="GET" action="doctors.php" class="mt-5 mr-2 flex justify-end">
                <input type="text" name="search_patient" placeholder="Enter name" value="<?= htmlspecialchars($_GET['search_patient'] ?? '') ?>" class="border border-gray-300 rounded-lg px-4 py-2">
                <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
            </form>

            <div class="flex justify-end">
                <button id="showAddPatientForm" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition mt-5 mr-2">
                    + Add Doctor
                </button>
            </div>

            <div id="addPatientModal" class="hidden relative z-50">
                <div class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center">
                    <div class="bg-white rounded-lg shadow-2xl p-6 w-full max-w-2xl mx-4">
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">Add New Doctor</h3>
                        <form class="bg-white" action="doctors.php" method="POST">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
                                    <input name="firstName" type="text" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
                                    <input name="lastName" type="text" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Specialization</label>
                                    <select name="specialization" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                        <option value="" disabled selected>Select</option>
                                        <option value="cardiology">cardiology</option>
                                        <option value="pediatrics">pediatrics</option>
                                        <option value="neurology">neurology</option>
                                        <option value="orthopedics">orthopedics</option>
                                        <option value="oncology">oncology</option>
                                        <option value="gynecology">gynecology</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                    <input name="email" type="email" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                                    <input name="phoneNumber" type="tel" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </div>
                            </div> 
                            <div class="flex justify-end space-x-4 mt-6">
                                <button id="cancel_add" type="button" class="w-1/2 px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Cancel</button>
                                <button type="submit" class="w-1/2 px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition" name="addPatient">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto flex justify-center mt-5 px-6">
                <table class="display w-full md:mx-2 bg-white shadow-md rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 text-center font-semibold text-gray-600 border-b">Full Name</th>
                            <th class="py-3 px-4 text-center font-semibold text-gray-600 border-b">Specialization</th>
                            <th class="py-3 px-4 text-center font-semibold text-gray-600 border-b">Email</th>
                            <th class="py-3 px-4 text-center font-semibold text-gray-600 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php
                        if ($getAllDoctors && mysqli_num_rows($getAllDoctors) > 0):
                            while ($doctor = mysqli_fetch_assoc($getAllDoctors)):
                        ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 px-4 text-center"><?= $doctor['first_name']; ?> <?= $doctor['last_name']; ?></td>
                                    <td class="py-3 px-4 text-center"><?= $doctor['specialization']; ?></td>
                                    <td class="py-3 px-4 text-center"><?= $doctor['email']; ?></td>
                                    <td class="py-3 px-4 text-center space-x-2">
                                        <a class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-semibold transition" href="doctors.php?action=delete&id=<?= $doctor['doctor_id']; ?>">Delete</a>
                                        <a class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm font-semibold transition" href="doctors.php?action=edit&id=<?= $doctor['doctor_id']; ?>">Edit</a>
                                    </td>
                                </tr>
                            <?php endwhile;
                        else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">No doctor found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <footer class="bg-gray-800 text-white py-8 mt-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-400 text-sm">
                    <p>&copy; 2025 Unity Care Clinic. All rights reserved.</p>
                </div>
            </footer>
        </main>
    </div>
</body>
</html>