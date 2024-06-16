<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);

    // Query to delete the sales record
    $sql = "DELETE FROM penjualan WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Pendapatan berhasil dihapus";
    } else {
        $_SESSION['error_message'] = "Terjadi kesalahan saat menghapus pendapatan";
    }

    $stmt->close();
    $conn->close();

    header("Location: pendapatan_harian.php");
    exit();
} else {
    header("Location: pendapatan_harian.php");
    exit();
}
?>
