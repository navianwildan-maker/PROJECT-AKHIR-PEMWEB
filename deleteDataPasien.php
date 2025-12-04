<?php
include 'connection.php';
session_start();

$id = $_GET['id'];
$cekPesanKamarRes = mysqli_query($connect, "SELECT id_pasien FROM kunjungan WHERE id_kunjungan = '$id'");
if ($cekPesanKamarRes && mysqli_num_rows($cekPesanKamarRes) > 0) {
    $row = mysqli_fetch_assoc($cekPesanKamarRes);
    $id_pasien_linked = $row['id_pasien'];
    $cekKamar = mysqli_query($connect, "SELECT * FROM pesankamar WHERE id_pasien = '$id_pasien_linked'");
} else {
    // no linked pasien found -> ensure cekKamar is a valid empty result
    $cekKamar = mysqli_query($connect, "SELECT * FROM pesankamar WHERE 1=0");
}
if (mysqli_num_rows($cekKamar) > 0) {
    echo "<script>alert('Data Pasien tidak dapat dihapus karena masih memiliki kamar yang dipesan.'); window.location.href='dataPesanKamar.php';</script>";
    exit;
}
$pasien = mysqli_query($connect, "SELECT id_pasien from kunjungan WHERE id_kunjungan = '$id'");
$query = "DELETE FROM kunjungan WHERE id_kunjungan = '$id'";
$result  = mysqli_query($connect, $query);

if (mysqli_affected_rows($connect) > 0) {
    header("Location: dataPendaftaranOnline.php?pesan=hapus_berhasil");
} else {
    header("Location: dataPendaftaranOnline.php?pesan=id_tidak_ditemukan");
}
?>
