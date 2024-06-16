<?php
session_start();
if ($_SESSION['role'] != 'pekerja') {
    header("Location: login.php");
    exit();
}
include 'koneksi.php'; // Include the database connection

// Fetch all records from service_motor table
$query = "SELECT * FROM service_motor";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Service Motor - PSPP</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            width: 200px;
            background-color: #2c3e50;
            height: 100vh;
            padding-top: 20px;
            position: fixed;
        }

        .sidebar h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 20px 0;
            text-align: start;
            padding-left: 10px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
        }

        .content {
            margin-left: 200px;
            width: calc(100% - 200px);
            overflow-x: auto; /* Untuk pengguliran horizontal */
        }

        .header {
            background-color: #ecf0f1;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header .welcome {
            font-size: 16px;
            color: #34495e;
        }

        .header .profile {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .header .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-left: 10px;
        }

        .main-content {
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table-wrapper {
            overflow-x: auto; /* Untuk pengguliran horizontal */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            white-space: nowrap; /* Hindari teks wrap */
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
            white-space: nowrap; /* Hindari teks wrap */
        }

        .btn-custom {
            background-color: #2c3e50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-bottom: 20px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .btn-warning {
            display: inline-flex;
            align-items:center;
            background-color: #f39c12;
            color: #fff;
            border: none;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 3px;
            text-decoration: none;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 3px;
            text-decoration: none;
        }

        .btn-warning:hover, .btn-danger:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>PPSP</h2>
        <ul> 
            <li><a href="pekerja_dashboard.php">Home</a></li>
            <li><a href="service_motor.php">Service Motor</a></li>
            <li><a href="pembelian_sparepart.php">Pembelian Sparepart</a></li>
            <li><a href="pengaturan_akun_pekerja.php">Pengaturan Akun</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header">
            <div class="welcome">Daftar Service Motor</div>
            <div class="profile" onclick="window.location.href='pengaturan_akun_pekerja.php'">
                <span>Hi Pekerja!</span>
                <img src="https://ui-avatars.com/api/?name=Pekerja&background=2c3e50&color=fff" alt="Profile Image">
            </div>
        </div>
        <div class="main-content">
            <a href="service_motor.php" class="btn btn-custom">Service Motor</a>
            <div class="table-wrapper">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pemilik Motor</th>
                            <th>Jenis Motor</th>
                            <th>Plat Motor</th>
                            <th>Jam/Tgl Masuk Kendaraan</th>
                            <th>Jam/Tgl Keluar Kendaraan</th>
                            <th>Nominal Jasa</th>
                            <th>Keluhan Service</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['nama_pemilik'] . "</td>";
                            echo "<td>" . $row['jenis_motor'] . "</td>";
                            echo "<td>" . $row['plat_motor'] . "</td>";
                            echo "<td>" . $row['jam_tgl_masuk'] . "</td>";
                            echo "<td>" . $row['jam_tgl_keluar'] . "</td>";
                            echo "<td>Rp " . number_format($row['nominal_jasa'], 0, ',', '.') . "</td>";
                            echo "<td>" . $row['keluhan_service'] . "</td>";
                            
                            // Tombol Edit dengan teks Edit
                            
                            echo "<td>";
                            echo "<a href='edit_service_motor.php?id=" . $row['id'] . "' class='btn-warning'><i class='fas fa-edit'></i></a>";
                            
                            // Tombol Delete dengan teks Delete
                            echo " <a href='delete_service_motor.php?id=" . $row['id'] . "' class='btn-danger' onclick=\"return confirm('Are you sure?')\"><i class='fas fa-trash'></i></a>";
                            echo "</td>";
                            
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
