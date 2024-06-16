<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pendapatan Harian</title>
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
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>PPSP</h2>
        <ul>
            <li><a href="admin_dashboard.php">Home</a></li>
            <li><a href="penambahan_sparepart.php">Penambahan Sparepart</a></li>
            <li><a href="pendapatan_harian.php">Pendapatan Harian</a></li>
            <li><a href="pengaturan_akun_admin.php">Pengaturan Akun</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header">
            <div class="welcome">Pendapatan Harian</div>
            <div class="profile" onclick="window.location.href='pengaturan_akun_admin.php'">
                <span>Hi Admin!</span>
                <img src="https://ui-avatars.com/api/?name=Admin&background=2c3e50&color=fff" alt="Profile Image">
            </div>
        </div>
        <div class="main-content">
            <h2>Laporan Pendapatan Harian</h2>
            <?php
            // Query to fetch today's sales records
            $sql = "SELECT p.id, p.tanggal, s.nama as nama_sparepart, p.jumlah, s.harga, p.total_harga
                    FROM penjualan p
                    JOIN sparepart s ON p.sparepart_id = s.id
                    WHERE DATE(p.tanggal) = CURDATE()
                    ORDER BY p.id DESC"; // Ubah dari GROUP BY menjadi ORDER BY untuk menghindari duplikasi
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<table class='table table-bordered'><thead><tr><th>No</th><th>ID</th><th>Tanggal</th><th>Jam</th><th>Nama Sparepart</th><th>Jumlah Sparepart</th><th>Harga Satuan</th><th>Total Harga</th><th>Aksi</th></tr></thead><tbody>";
                $no = 1; // Initialize a counter for the rows
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>"; // Display the row number
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . date('Y-m-d', strtotime($row["tanggal"])) . "</td>";
                    echo "<td>" . date('H:i:s', strtotime($row["tanggal"])) . "</td>";
                    echo "<td>" . $row["nama_sparepart"] . "</td>";
                    echo "<td>" . $row["jumlah"] . "</td>";
                    echo "<td>Rp " . number_format($row["harga"], 0, ',', '.') . ",-</td>";
                    echo "<td>Rp " . number_format($row["total_harga"], 0, ',', '.') . ",-</td>";
                    echo "<td>";
                    echo "<form method='post' action='delete_pendapatan.php' style='display:inline-block; margin-left: 5px;'>";
                    echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                    echo "<button type='submit' name='delete' class='btn btn-danger'>Hapus</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>Tidak ada data untuk hari ini.</p>";
            }
            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
