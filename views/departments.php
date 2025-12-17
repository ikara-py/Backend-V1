<?php
include "../config/connection.php";

function addDepartment($connection){
    $departmentName = $_POST['departmentName'];
    $location       = $_POST['location'];

    $query = "insert into departments (department_name, location)
              values ('$departmentName', '$location')";
    
    mysqli_query($connection, $query);
    header('location:departments.php');
    exit;
}

if (isset($_POST['updateDepartment'])) {
    $id = $_POST['department_id'];
    $departmentName = $_POST['departmentName'];
    $location = $_POST['location'];

    $query = "update departments set department_name='$departmentName', location='$location' where department_id=$id";
    mysqli_query($connection, $query);
    header('location:departments.php');
    exit;
}

$search = isset($_GET['search_department']) ? trim($_GET['search_department']) : '';

if (!empty($search)) {
    $query = "select * from departments where department_name like '%$search%' OR location like '%$search%'";
    $getAllDepartments = mysqli_query($connection, $query);
} else {
    $query = "select * from departments";
    $getAllDepartments = mysqli_query($connection, $query);
}

function edit_dept($connection)
{
    if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
        echo "Invalid department ID for editing.";
        return;
    }

    $id = $_GET["id"];
    $query = "select * from departments where department_id = $id";
    $query_run = mysqli_query($connection, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $raw) {
?>
            <script src="https://cdn.tailwindcss.com"></script>
            <div id="editDepartmentModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-2xl p-6 w-full max-w-lg mx-4">
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Edit Department</h3>
                    <form class="bg-white" action="departments.php" method="POST">
                        <div class="grid grid-cols-1 gap-4">
                            <input type="text" name="department_id" value="<?= $raw["department_id"]; ?>" class="hidden">
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Department Name</label>
                                <input name="departmentName" type="text" value="<?= $raw["department_name"]; ?>" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                                <input name="location" type="text" value="<?= $raw["location"]; ?>" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4 mt-6">
                            <a href="departments.php" class="w-1/2 px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-center">
                                Cancel
                            </a>
                            <button type="submit" class="w-1/2 px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition" name="updateDepartment">
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

function delete_dept($connection)
{
    if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
        header('location:departments.php');
        exit;
    }

    $id = $_GET["id"];
    $deleteQuery = $connection->prepare("DELETE FROM departments WHERE department_id = ?");
    $deleteQuery->bind_param('i', $id);
    $deleteQuery->execute();
    $deleteQuery->close();
    header('location:departments.php');
    exit;
}

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case "delete":
        delete_dept($connection);
        break;
    case "edit":
        edit_dept($connection);
        break;
    default:
}

if(isset($_POST['addDepartment'])){
    addDepartment($connection);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unity Care - Departments</title>
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
            <a href="dashboard.php" class="flex items-center px-6 py-3 hover:bg-gray-700 transition">
                <span>Dashboard</span>
            </a>
            <a href="patients.php" class="flex items-center px-6 py-3 hover:bg-gray-700 transition">
                <span>Patients</span>
            </a>
            <a href="doctors.php" class="flex items-center px-6 py-3 hover:bg-gray-700 transition">
                <span>Doctors</span>
            </a>
            <a href="departments.php" class="flex items-center px-6 py-3 bg-gray-900 border-l-4 border-blue-500">
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
                        <span class="text-white text-2xl font-bold hidden md:block">Departments Management</span>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">

            <form method="GET" action="departments.php" class="mt-5 mr-2 flex justify-end">
                <input type="text" name="search_department" placeholder="Search departments..." value="<?= htmlspecialchars($_GET['search_department'] ?? '') ?>" class="border border-gray-300 rounded-lg px-4 py-2">
                <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
            </form>

            <div class="flex justify-end">
                <button id="showAddPatientForm" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition mt-5 mr-2">
                    + Add Department
                </button>
            </div>

            <div id="addPatientModal" class="hidden relative z-50">
                <div class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center">
                    <div class="bg-white rounded-lg shadow-2xl p-6 w-full max-w-lg mx-4">
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">Add New Department</h3>
                        <form class="bg-white" action="departments.php" method="POST">
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Department Name</label>
                                    <input name="departmentName" type="text" placeholder="e.g. Cardiology" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                                    <input name="location" type="text" placeholder="e.g. Building A, Floor 2" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </div>
                            </div> 
                            <div class="flex justify-end space-x-4 mt-6">
                                <button id="cancel_add" type="button" class="w-1/2 px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Cancel</button>
                                <button type="submit" class="w-1/2 px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition" name="addDepartment">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto flex justify-center mt-5 px-6">
                <table class="display w-full md:mx-2 bg-white shadow-md rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 text-center font-semibold text-gray-600 border-b">ID</th>
                            <th class="py-3 px-4 text-center font-semibold text-gray-600 border-b">Department Name</th>
                            <th class="py-3 px-4 text-center font-semibold text-gray-600 border-b">Location</th>
                            <th class="py-3 px-4 text-center font-semibold text-gray-600 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php
                        if ($getAllDepartments && mysqli_num_rows($getAllDepartments) > 0):
                            while ($dept = mysqli_fetch_assoc($getAllDepartments)):
                        ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 px-4 text-center text-gray-500">#<?= $dept['department_id']; ?></td>
                                    <td class="py-3 px-4 text-center font-medium text-gray-800"><?= $dept['department_name']; ?></td>
                                    <td class="py-3 px-4 text-center text-gray-600"><?= $dept['location']; ?></td>
                                    <td class="py-3 px-4 text-center space-x-2">
                                        <a class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-semibold transition" href="departments.php?action=delete&id=<?= $dept['department_id']; ?>" onclick="return confirm('Are you sure you want to delete this department?');">Delete</a>
                                        <a class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm font-semibold transition" href="departments.php?action=edit&id=<?= $dept['department_id']; ?>">Edit</a>
                                    </td>
                                </tr>
                            <?php endwhile;
                        else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">No departments found.</td>
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