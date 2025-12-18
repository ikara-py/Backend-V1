<?php
include "../config/connection.php";

$doc = mysqli_query($connection, "select count(*) as c from doctors");
$pat = mysqli_query($connection, "select count(*) as c from patients");
$dep = mysqli_query($connection, "select count(*) as c from departments");

$doctorCount   = mysqli_fetch_assoc($doc)['c'];
$patientCount  = mysqli_fetch_assoc($pat)['c'];
$departmentCount = mysqli_fetch_assoc($dep)['c'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/app.js" defer></script>
    <script src="../assets/chart.umd.js"></script>
</head>

<body class="bg-gray-50 h-screen overflow-hidden">

    <aside class="bg-gray-800 text-white w-64 fixed h-full">
        <div class="p-4 gradient-bg">
            <i class="fas fa-hospital text-2xl mr-3"></i>
            <span class="text-xl font-bold">Unity Care</span>
        </div>
        <nav class="mt-6">
            <a href="dashboard.php" class="flex items-center px-6 py-3 bg-gray-900 border-l-4 border-blue-500">
                <span>Dashboard</span>
            </a>
            <a href="patients.php" class="flex items-center px-6 py-3 hover:bg-gray-700">
                <span>Patients</span>
            </a>
            <a href="doctors.php" class="flex items-center px-6 py-3 hover:bg-gray-700">
                <span>Doctors</span>
            </a>
            <a href="departments.php" class="flex items-center px-6 py-3 hover:bg-gray-700">
                <span>Departments</span>
            </a>
        </nav>
    </aside>

    <div class="ml-64 flex flex-col h-screen">
        <nav class="gradient-bg shadow-lg">
            <div class="max-w-7xl mx-auto px-4 h-16 flex items-center">
                <span class="text-white text-2xl font-bold">Dashboard</span>
            </div>
        </nav>

        <main class="flex-1 overflow-auto p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 max-w-5xl mx-auto">
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <i class="fas fa-user-md text-blue-500 text-3xl mb-2"></i>
                    <div class="text-3xl font-bold"><?= $doctorCount ?></div>
                    <div class="text-gray-600">Doctors</div>
                </div>
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <i class="fas fa-user-injured text-green-500 text-3xl mb-2"></i>
                    <div class="text-3xl font-bold"><?= $patientCount ?></div>
                    <div class="text-gray-600">Patients</div>
                </div>
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <i class="fas fa-building text-purple-500 text-3xl mb-2"></i>
                    <div class="text-3xl font-bold"><?= $departmentCount ?></div>
                    <div class="text-gray-600">Departments</div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow max-w-5xl mx-auto">
                <canvas id="myChart" style="max-height: 400px;"></canvas>
            </div>
        </main>
    </div> 

    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script>

        const doctorCount = <?= $doctorCount ?>;
        const patientCount = <?= $patientCount ?>;
        const departmentCount = <?= $departmentCount ?>

  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Doctor', 'Patients', 'Department'],
      datasets: [{
        label: 'Hospital Analytics',
        data: [doctorCount, patientCount, departmentCount],
        backgroundColor: [
            'rgba(59, 130, 246, 0.2)',
            'rgba(16, 185, 129, 0.2)',
            'rgba(139, 92, 246, 0.2)'
        ],
        borderColor: [
            'rgb(59, 130, 246)', 
            'rgb(16, 185, 129)', 
            'rgb(139, 92, 246)'
        ],
        borderWidth: 1
      }]
    },
    options: {
        responsive: true,
        scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

</body>

</html>