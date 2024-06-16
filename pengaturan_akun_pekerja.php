<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'pekerja') {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';

$username = $_SESSION['username'];
$sql = "SELECT * FROM pengguna WHERE username='$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun Pekerja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
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
        }

        .header {
            background-color: #ecf0f1;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header .title {
            font-size: 18px;
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

        .header .welcome {
            font-size: 16px;
            color: #34495e;
            margin-right: 10px;
        }

        .main-content {
            padding: 20px;
        }
        
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
            border: 2px solid #2c3e50;
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            margin: auto;
            padding-top: 30px;
            padding-bottom: 30px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .profile-container:hover {
            transform: scale(1.05);
        }

        .profile-container img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 2px solid #2c3e50;
        }
        
        .profile-info {
            text-align: center;
            margin-top: 10px;
        }

        .profile-info p {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .logout-btn {
            padding: 10px 20px;
            background-color: #2c3e50;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 20px;
            transition: background-color 0.3s, color 0.3s;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #0056b3;
            color: #fff;
        }

        .logout-container {
            display: flex;
            justify-content: center;
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
            <div class="title">Pengaturan Akun</div>
            <div class="profile" onclick="window.location.href='pengaturan_akun_pekerja.php'">
                <span>Hi Pekerja!</span>
                <img src="https://ui-avatars.com/api/?name=Pekerja&background=2c3e50&color=fff" alt="Profile Image">
            </div>
        </div>
        <div class="main-content">
            <h1>Profile</h1>
            <div class="profile-container">
                <img src="https://ui-avatars.com/api/?name=Pekerja&background=2c3e50&color=fff" alt="Profile Picture">
                <div class="profile-info">
                    <p>Username: <?php echo htmlspecialchars($user['username']); ?></p>
                    <p>Password: <?php echo htmlspecialchars($user['password']); ?></p>
                </div>
                <div class="logout-container">
                    <a href="logout.php" class="logout-btn">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
