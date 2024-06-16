<?php
session_start();
if ($_SESSION['role'] != 'pekerja') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['nama']) && isset($_GET['jumlah']) && isset($_GET['harga']) && isset($_GET['tanggal'])) {
    $nama = $_GET['nama'];
    $jumlah = intval($_GET['jumlah']);
    $harga_satuan = floatval($_GET['harga']);
    $tanggal = $_GET['tanggal'];
    $total_harga = $jumlah * $harga_satuan;

    $purchase_details = [
        'nama' => $nama,
        'jumlah' => $jumlah,
        'harga_satuan' => number_format($harga_satuan, 0, ',', '.'),
        'total_harga' => number_format($total_harga, 0, ',', '.'),
        'tanggal' => date('d F Y H:i:s', strtotime($tanggal))
    ];
} else {
    $purchase_details = null;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f1f1f1;
        }
        .checkout-box {
            width: 350px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .logo {
            margin-bottom: 20px;
        }
        .contact-info {
            margin-top: 35px;
            font-size: 12px;
            color: #666;
        }
        .btn-back {
            margin-top: 20px;
            background-color: #2c3e50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .btn-back:hover {
            background-color: #3498db;
            color: #fff;
        }
        .receipt-details {
            text-align: left;
            margin-top: 20px;
        }
        .receipt-details p {
            margin: 5px 0;
        }
        .receipt-details p span {
            float: right;
        }
    </style>
</head>
<body>
    <div class="checkout-box">
        <div class="logo">
            <h1>PPSP</h1>
        </div>
        <h4>~ ~ ~ Detail Pembelian ~ ~ ~</h4>
        <?php if (isset($purchase_details)) : ?>
            <div class="receipt-details">
                <p><strong>Sparepart:</strong> <span><?php echo $purchase_details['nama']; ?></span></p>
                <p><strong>Jumlah:</strong> <span><?php echo $purchase_details['jumlah']; ?></span></p>
                <p><strong>Harga Satuan:</strong> <span>Rp <?php echo $purchase_details['harga_satuan']; ?>,-</span></p>
                <p><strong>Total Harga:</strong> <span>Rp <?php echo $purchase_details['total_harga']; ?>,-</span></p>
                <p><strong>Tgl & Jam:</strong> <span><?php echo $purchase_details['tanggal']; ?></span></p>
            </div>
        <?php else : ?>
            <p>Terjadi kesalahan saat memproses pembelian.</p>
        <?php endif; ?>
        <div class="contact-info">
            <p>Jl. Cerdas No. 10, Kota Ceria</p>
            <p>Telepon: 0812-3456-7890</p>
            <p>Email: info@ppspbengkel.com</p>
        </div>
        <button class="btn btn-primary btn-back" onclick="window.history.back()">Kembali</button>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
