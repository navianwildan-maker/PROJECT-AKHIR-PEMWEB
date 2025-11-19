<?php
include 'connection.php';
$nama = $_POST['nama'];
$nik = $_POST['nik'];
$bpjs = $_POST['bpjs'];
$poli = $_POST['poli'];
$tanggal_berobat = $_POST['tanggal_berobat'];
$status = 'Menunggu';

$query = "INSERT INTO pasien (nama, nik, bpjs) VALUES ('$nama', '$nik', '$bpjs')";
mysqli_query($connect, $query);
$id_pasien = mysqli_insert_id($connect);
$jadwal = "SELECT d.id_dokter FROM jadwal_dokter j INNER JOIN dokter d ON j.id_dokter = d.id_dokter WHERE d.poli = '$poli' AND j.hari_praktik = DAYNAME('$tanggal_berobat') LIMIT 1";
$id_result = mysqli_query($connect, $jadwal);
var_dump($id_result);
$query2 = "INSERT INTO kunjungan (id_pasien,id_jadwal, poli_tujuan, tanggal_kunjungan, status) VALUES ('$id_pasien', '$id_jadwal','$poli', '$tanggal_berobat', '$status')";
mysqli_query($connect, $query2);
if (mysqli_affected_rows($connect) > 0) {
    header("location: TA_PUSKESMAS.php");
} else {
    echo "<script>alert('Pendaftaran gagal. Silakan coba lagi.'); window.location.href='pendaftaranPuskesmas.php';</script>";
}
?>