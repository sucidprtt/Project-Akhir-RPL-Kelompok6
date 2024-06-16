<?php
session_start();
include 'koneksi.php';

// Halaman ini hanya boleh diakses oleh pekerja
if ($_SESSION['role'] != 'pekerja') {
    header("Location: login.php");
    exit();
}

// Ambil id service motor yang dikirimkan via parameter GET
$id = $_GET['id'];

// Query untuk mengambil data service motor berdasarkan id
$query = "SELECT * FROM service_motor WHERE id=$id";
$result = mysqli_query($conn, $query);
$record = mysqli_fetch_assoc($result);

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data yang di-submit dari form
    $nama_pemilik = $_POST['nama_pemilik'];
    $jenis_motor = $_POST['jenis_motor'];
    $plat_motor = $_POST['plat_motor'];
    $jam_tgl_masuk = $_POST['jam_tgl_masuk'];
    $jam_tgl_keluar = $_POST['jam_tgl_keluar'];
    $nominal_jasa = $_POST['nominal_jasa'];
    $keluhan_service = $_POST['keluhan_service'];

    // Query untuk update data service motor ke database
    $update_query = "UPDATE service_motor SET 
                    nama_pemilik='$nama_pemilik', 
                    jenis_motor='$jenis_motor', 
                    plat_motor='$plat_motor', 
                    jam_tgl_masuk='$jam_tgl_masuk', 
                    jam_tgl_keluar='$jam_tgl_keluar', 
                    nominal_jasa=$nominal_jasa, 
                    keluhan_service='$keluhan_service' 
                    WHERE id=$id";

    if (mysqli_query($conn, $update_query)) {
        // Redirect kembali ke halaman daftar service motor setelah berhasil update
        header("Location: service_motor.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service Motor - PSPP</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for any additional styling */
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

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin: 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .button-container {
            margin-top: 20px;
        }

        button.btn-custom,
        a.btn-custom {
            background-color: #2c3e50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-right: 10px;
            text-decoration: none;
            display: inline-block;
        }

        button.btn-custom:hover,
        a.btn-custom:hover {
            background-color: #0056b3;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .content {
                margin-left: 0;
                width: 100%;
            }
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
            <li><a href="stok_sparepart.php">Stok Sparepart</a></li>
            <li><a href="pengaturan_akun.php">Pengaturan Akun</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header">
            <div class="welcome">Edit Service Motor</div>
            <div class="profile" onclick="window.location.href='pengaturan_akun_pekerja.php'">
                <span>Hi Pekerja!</span>
                <img src="https://ui-avatars.com/api/?name=Pekerja&background=2c3e50&color=fff" alt="Profile Image">
            </div>
        </div>
        <div class="main-content">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $record['id']; ?>">
                <div class="form-group">
                    <label for="nama_pemilik">Nama Pemilik Motor</label>
                    <input type="text" id="nama_pemilik" name="nama_pemilik" value="<?php echo $record['nama_pemilik']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="jenis_motor">Jenis Motor</label>
                    <input type="text" id="jenis_motor" name="jenis_motor" value="<?php echo $record['jenis_motor']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="plat_motor">Plat Motor</label>
                    <input type="text" id="plat_motor" name="plat_motor" value="<?php echo $record['plat_motor']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="jam_tgl_masuk">Jam/Tgl Masuk Kendaraan</label>
                    <input type="datetime-local" id="jam_tgl_masuk" name="jam_tgl_masuk" value="<?php echo date('Y-m-d\TH:i', strtotime($record['jam_tgl_masuk'])); ?>" required>
                </div>
                <div class="form-group">
                    <label for="jam_tgl_keluar">Jam/Tgl Keluar Kendaraan</label>
                    <input type="datetime-local" id="jam_tgl_keluar" name="jam_tgl_keluar" value="<?php echo date('Y-m-d\TH:i', strtotime($record['jam_tgl_keluar'])); ?>" required>
                </div>
                <div class="form-group">
                    <label for="nominal_jasa">Nominal Jasa</label>
                    <input type="number" id="nominal_jasa" name="nominal_jasa" value="<?php echo $record['nominal_jasa']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="keluhan_service">Keluhan Service</label>
                    <textarea id="keluhan_service" name="keluhan_service" rows="4" required><?php echo $record['keluhan_service']; ?></textarea>
                </div>
                <div class="button-container">
                    <button type="submit" class="btn btn-custom">Update</button>
                    <a href="daftar_service_motor.php" class="btn btn-custom">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
