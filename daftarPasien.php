<?php
include 'connection.php';
$nama = $_POST['nama'];
$nik = $_POST['nik'];
$bpjs = $_POST['bpjs'];
$poli = $_POST['poli'];
$tanggal_berobat = $_POST['tanggal_berobat'];

$query = "INSERT INTO pasien (nama, nik, bpjs, poli, tanggal_berobat) VALUES ('$nama', '$nik', '$bpjs', '$poli', '$tanggal_berobat')";
mysqli_query($connect, $query);
if (mysqli_affected_rows($connect) > 0) {
    header("location: TA_PUSKESMAS.php");
} else {
    echo "<script>alert('Pendaftaran gagal. Silakan coba lagi.'); window.location.href='pendaftaranPuskesmas.php';</script>";
}
?>