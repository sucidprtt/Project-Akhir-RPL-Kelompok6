<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pemilik = $_POST['nama_pemilik'];
    $jenis_motor = $_POST['jenis_motor'];
    $plat_motor = $_POST['plat_motor'];
    $jam_tgl_masuk = $_POST['jam_tgl_masuk'];
    $jam_tgl_keluar = $_POST['jam_tgl_keluar'];
    $nominal_jasa = $_POST['nominal_jasa'];
    $keluhan_service = $_POST['keluhan_service'];

    $query = "INSERT INTO service_motor (nama_pemilik, jenis_motor, plat_motor, jam_tgl_masuk, jam_tgl_keluar, nominal_jasa, keluhan_service) VALUES ('$nama_pemilik', '$jenis_motor', '$plat_motor', '$jam_tgl_masuk', '$jam_tgl_keluar', '$nominal_jasa', '$keluhan_service')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: daftar_service_motor.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
