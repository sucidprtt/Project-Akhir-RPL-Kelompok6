<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

// Periksa koneksi database
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $conn->real_escape_string($_POST['nama']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $harga = floatval($_POST['harga']);
    $stok = intval($_POST['stok']);
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);
    $tanggal = date('Y-m-d H:i:s'); // Tanggal sekarang untuk insert data

    // Pastikan direktori uploads ada dan dapat ditulisi
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Cek apakah file gambar adalah gambar asli
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            // Simpan data ke dalam tabel sparepart
            $sql = "INSERT INTO sparepart (nama, deskripsi, harga, stok, gambar) 
                    VALUES ('$nama', '$deskripsi', $harga, $stok, '$target_file')";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['success_message'] = "Sparepart berhasil ditambahkan";
                header("Location: penambahan_sparepart.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Penambahan Sparepart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
            <div class="welcome">Penambahan Sparepart</div>
            <div class="profile" onclick="window.location.href='pengaturan_akun_admin.php'">
                <span>Hi Admin!</span>
                <img src="https://ui-avatars.com/api/?name=Admin&background=2c3e50&color=fff" alt="Profile Image">
            </div>
        </div>
        <div class="main-content">
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success_message']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>
            
            <form method="post" enctype="multipart/form-data" action="">
                <div class="form-group">
                    <label for="nama">Nama Sparepart:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                </div>
                <div class="form-group">
                    <label for="harga">Harga:</label>
                    <input type="number" class="form-control" id="harga" name="harga" required>
                </div>
                <div class="form-group">
                    <label for="stok">Stok:</label>
                    <input type="number" class="form-control" id="stok" name="stok" required>
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar:</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar" name="gambar" required>
                        <label class="custom-file-label" for="gambar">Pilih file...</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Stok Baru</button>
            </form>
            
            <!-- Menampilkan Gambar Sparepart dalam Card -->
            <div class="row mt-4">
                <?php
                $sql = "SELECT id, nama, deskripsi, stok, gambar, harga FROM sparepart WHERE stok > 0";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4'>";
                    echo "<div class='card'>";
                    echo "<img src='" . $row['gambar'] . "' class='card-img-top' alt='" . $row['nama'] . "'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>" . $row['nama'] . "</h5>";
    echo "<p class='card-text'>Deskripsi: " . $row['deskripsi'] . "</p>";
    echo "<p class='card-text'>Stok: " . $row['stok'] . "</p>";
    echo "<p class='card-text'>Harga: Rp " . number_format($row['harga'], 0, ',', '.') . ",-</p>";
    // Removed the detail button
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
?>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            // Update the label of the file input with the selected file name
            $('#gambar').on('change', function(){
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });
        });
    </script>
</body>
</html>
