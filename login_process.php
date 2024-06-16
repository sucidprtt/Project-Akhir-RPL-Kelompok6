<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM pengguna WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $row['role'];
    if ($row['role'] == 'admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: pekerja_dashboard.php");
    }
} else {
    $_SESSION['error'] = "Username atau password salah";
    header("Location: index.php");
}
$conn->close();
?>
