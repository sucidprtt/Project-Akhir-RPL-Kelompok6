<!DOCTYPE html>
<html>
<head>
    <title>Daftar Service Motor - PSPP</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
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

        .form-group input,
        .form-group textarea {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 0;
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
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .text-center {
            text-align: center;
        }

        /* Custom CSS for positioning buttons */
        .button-container {
            text-align: right;
        }

        .button-container .btn-custom {
            margin-left: 10px;
        }

        @media (max-width: 768px) {
            .button-container {
                text-align: center;
            }
            .btn-custom {
                margin-left: 0;
                margin-top: 10px;
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
            <li><a href="pengaturan_akun_pekerja.php">Pengaturan Akun</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header">
            <div class="welcome">Service Motor</div>
            <div class="profile" onclick="window.location.href='pengaturan_akun_pekerja.php'">
                <span>Hi Pekerja!</span>
                <img src="https://ui-avatars.com/api/?name=Pekerja&background=2c3e50&color=fff" alt="Profile Image">
            </div>
        </div>
        <div class="main-content">
            <form action="proses_service_motor.php" method="post">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="nama_pemilik">Nama Pemilik Motor</label>
                    <input type="text" id="nama_pemilik" name="nama_pemilik" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jenis_motor">Jenis Motor</label>
                    <input type="text" id="jenis_motor" name="jenis_motor" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="plat_motor">Plat Motor</label>
                    <input type="text" id="plat_motor" name="plat_motor" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jam_tgl_masuk">Jam/Tgl Masuk Kendaraan</label>
                    <input type="datetime-local" id="jam_tgl_masuk" name="jam_tgl_masuk" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jam_tgl_keluar">Jam/Tgl Keluar Kendaraan</label>
                    <input type="datetime-local" id="jam_tgl_keluar" name="jam_tgl_keluar" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nominal_jasa">Nominal Jasa</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" id="nominal_jasa" name="nominal_jasa" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="keluhan_service">Keluhan Service</label>
                    <textarea id="keluhan_service" name="keluhan_service" class="form-control" rows="4" required></textarea>
                </div>
                <div class="button-container">
                    <a href="daftar_service_motor.php" class="btn btn-custom">List Service</a>
                    <button type="submit" class="btn btn-custom">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
