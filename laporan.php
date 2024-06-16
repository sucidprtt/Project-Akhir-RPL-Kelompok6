<?php
session_start();
if ($_SESSION['role'] != 'admin') {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Laporan Admin PSPP</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
      font-size: 24px;
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

    /* No more custom styles for the combobox or select element */
    .narrow-combobox {
    margin-top: 20px;
    padding-left: 2px;
    width: 150px; /* Adjust width as needed */
    }

    .narrow-combobox select {
    font-size: 20px;
    padding: 5px 10px; /* Reduce padding */
    border: none; /* Remove border */
    background-color: #2c3e50; /* Set background color */
    color: #fff; /* Set text color */
    border-radius: 4px;
    box-sizing: border-box; /* Ensure padding and border are included in width */
    }
    
      // Fungsi untuk mengarahkan langsung ke bagian pemilihan combobox
    function goToComboBox() {
    document.querySelector('.narrow-combobox select').focus(); // Fokuskan pada combobox
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <h2>PPSP</h2>
    <ul>
        <li><a href="admin_dashboard.php" onclick="goToComboBox()">Home</a></li>
        <li><a href="penambahan_sparepart.php" onclick="goToComboBox()">Penambahan Sparepart</a></li>
        <div class="narrow-combobox">
            <select class="form-control" style="font-size: 14px; padding: 5px;" onchange="window.location.href=this.value">
            <option value="">Pilih Laporan</option>
            <option value="stok_habis.php">Stock Barang Habis</option>
            <option value="pendapatan_harian.php">Pendapatan Harian</option>
            </select>
        </div>
        <li><a href="pengaturan_akun_admin.php" onclick="goToComboBox()">Pengaturan Akun</a></li>
    </ul>

  </div>
  <div class="content">
    <div class="header">
      <div class="welcome">Laporan</div>
      <div class="profile" onclick="window.location.href='pengaturan_akun_admin.php'">
        <span>Hi Admin!</span>
        <img src="img/Roronoa.png" alt="Profile Image">
      </div>
    </div>
    <div class="main-content">
      <h1>Selamat datang, Admin!</h1>
    </div>
  </div>
</body>
</html>
