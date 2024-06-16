<?php
session_start();
if ($_SESSION['role'] != 'pekerja') {
    header("Location: login.php");
    exit();
}
include 'koneksi.php';

$id = $_GET['id'];
$query = "DELETE FROM service_motor WHERE id=$id";

if (mysqli_query($conn, $query)) {
    header("Location: service_motor.php");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>
