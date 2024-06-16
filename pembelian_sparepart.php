<?php
session_start();

// Memeriksa apakah pengguna telah login dan memiliki peran pekerja
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pekerja') {
    header("Location: login.php");
    exit();
}

// Menghubungkan ke file koneksi.php
include 'koneksi.php';

// Menangani pengiriman form jika metode adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan nilai dari form
    $sparepart_id = $_POST['sparepart_id'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal']; // Ambil nilai tanggal dari form

    // Memeriksa stok sparepart sebelum melakukan penjualan
    $sql = "SELECT harga, stok, gambar, nama FROM sparepart WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $sparepart_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $sparepart = $result->fetch_assoc();
        
        // Jika stok cukup, lanjutkan proses penjualan
        if ($sparepart['stok'] >= $jumlah) {
            // Menghitung total harga berdasarkan jumlah yang dibeli
            $total_harga = $sparepart['harga'] * $jumlah;

            // Memulai transaksi
            $conn->begin_transaction();

            try {
                // Menyimpan data penjualan ke dalam database
                $sql_insert_penjualan = "INSERT INTO penjualan (sparepart_id, jumlah, total_harga, tanggal) 
                                        VALUES (?, ?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert_penjualan);
                $stmt_insert->bind_param("iids", $sparepart_id, $jumlah, $total_harga, $tanggal);
                $stmt_insert->execute();

                // Mengurangi stok sparepart yang terjual dari database
                $sql_update_stok = "UPDATE sparepart SET stok = stok - ? WHERE id = ?";
                $stmt_update = $conn->prepare($sql_update_stok);
                $stmt_update->bind_param("ii", $jumlah, $sparepart_id);
                $stmt_update->execute();

                // Commit transaksi
                $conn->commit();

                // Redirect untuk mencegah form resubmission
                header("Location: checkout.php?nama=" . urlencode($sparepart['nama']) . "&jumlah=$jumlah&harga=" . urlencode($sparepart['harga']) . "&tanggal=" . urlencode($tanggal));
                exit();
            } catch (Exception $e) {
                // Rollback transaksi jika terjadi kesalahan
                $conn->rollback();
                $checkout_message = "Terjadi kesalahan: " . $e->getMessage();
            }
        } else {
            $checkout_message = "Stok tidak mencukupi untuk melakukan pembelian sejumlah $jumlah.";
        }
    } else {
        $checkout_message = "Sparepart dengan ID $sparepart_id tidak ditemukan.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pembelian Sparepart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; }
        .sidebar { width: 200px; background-color: #2c3e50; height: 100vh; padding-top: 20px; position: fixed; }
        .sidebar h2 { color: #fff; text-align: center; margin-bottom: 30px; }
        .sidebar ul { list-style-type: none; padding: 0; }
        .sidebar ul li { margin: 20px 0; text-align: start; padding-left: 10px; }
        .sidebar ul li a { color: #fff; text-decoration: none; font-size: 18px; }
        .content { margin-left: 200px; width: calc(100% - 200px); }
        .header { background-color: #ecf0f1; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); }
        .header .welcome { font-size: 16px; color: #34495e; }
        .header .profile { display: flex; align-items: center; cursor: pointer; }
        .header .profile img { width: 40px; height: 40px; border-radius: 50%; margin-left: 10px; }
        .main-content { padding: 20px; }
        .card { margin-bottom: 20px; }
        .btn-custom { background-color: #2c3e50; color: #fff; border: none; }
        .btn-custom:hover { background-color: #0056b3; }
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
            <div class="welcome">Pembelian Sparepart</div>
            <div class="profile" onclick="window.location.href='pengaturan_akun_pekerja.php'">
                <span>Hi Pekerja!</span>
                <img src="https://ui-avatars.com/api/?name=Pekerja&background=2c3e50&color=fff" alt="Profile Image">
            </div>
        </div>
        <div class="main-content">
            <div class="container">
                <!-- Menampilkan Gambar Sparepart dalam Card -->
                <div class="row">
                    <?php
                    // Menampilkan data sparepart yang tersedia dalam kartu
                    $sql_select_sparepart = "SELECT id, nama, stok, gambar, harga, deskripsi FROM sparepart WHERE stok > 0";
                    $result = $conn->query($sql_select_sparepart);
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4'>";
                        echo "<div class='card'>";
                        echo "<img src='" . $row['gambar'] . "' class='card-img-top' alt='Gambar Sparepart'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . $row['nama'] . "</h5>";
                        echo "<p class='card-text'>Deskripsi: " . $row['deskripsi'] . "</p>";
                        echo "<p class='card-text'>Stok: " . $row['stok'] . "</p>";
                        echo "<p class='card-text'>Harga: Rp " . number_format($row['harga'], 0, ',', '.') . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>

                <hr>

                <!-- Form Pembelian -->
                <form method="post">
                    <div class="form-group">
                        <label for="sparepart_id">Pilih Sparepart:</label>
                        <select class="form-control" id="sparepart_id" name="sparepart_id" required>
                            <?php
                            // Menampilkan opsi pilihan sparepart yang tersedia
                            $result = $conn->query($sql_select_sparepart);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nama'] . " - Stok: " . $row['stok'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah:</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal dan Waktu Pembelian:</label>
                        <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <button type="submit" class="btn btn-custom">Beli Sparepart</button>
                </form>
                
                <!-- Menampilkan pesan jika ada kesalahan atau berhasil -->
                <?php if (isset($checkout_message)): ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?php echo $checkout_message; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
