<!DOCTYPE html>
<html>
<head>
  <title>Interface Pekerja PSPP</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      background-color: #f0f0f0;
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
      color: #fff;
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
      color: #2c3e50;
      margin-right: 10px;
    }

    .main-content {
      padding: 20px;
    }

    .tasks {
      background-color: #ecf0f1;
      padding: 20px;
      border-radius: 10px;
      margin-top: 20px;
    }

    .task-item {
      background-color: #fff;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 10px;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    }

    .task-item:hover {
      transform: translateY(-3px);
      transition: transform 0.3s ease;
    }

    .task-item .task-title {
      font-size: 18px;
      color: #34495e;
      margin-bottom: 5px;
    }

    .task-item .task-description {
      font-size: 14px;
      color: #7f8c8d;
    }

    .task-item .task-info {
      font-size: 14px;
      color: #95a5a6;
      margin-top: 5px;
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
      <div class="welcome">Dashboard Pekerja</div>
      <div class="profile" onclick="window.location.href='pengaturan_akun_pekerja.php'">
        <span>Hi Pekerja!</span>
        <img src="https://ui-avatars.com/api/?name=Pekerja&background=2c3e50&color=fff" alt="Profile Image">
      </div>
    </div>
    <div class="main-content">
      <h1>Selamat datang, Pekerja!</h1>
      <div class="tasks">
        <h2>Tugas Hari Ini</h2>
        <div class="task-item">
          <div class="task-title">Menyelesaikan Rapat Koordinasi</div>
          <div class="task-description">Rapat dengan manajemen untuk koordinasi proyek terbaru.</div>
          <div class="task-info">Batas Waktu: 15 Juni 2024</div>
        </div>
        <div class="task-item">
          <div class="task-title">Persiapan Presentasi Proyek</div>
          <div class="task-description">Persiapkan materi presentasi untuk pertemuan dengan klien.</div>
          <div class="task-info">Batas Waktu: 18 Juni 2024</div>
        </div>
        <div class="task-item">
          <div class="task-title">Pembaruan Laporan Harian</div>
          <div class="task-description">Lengkapi laporan harian untuk proyek ABC.</div>
          <div class="task-info">Batas Waktu: 20 Juni 2024</div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
