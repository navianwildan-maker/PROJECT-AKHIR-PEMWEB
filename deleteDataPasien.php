<?php
include 'connection.php';
session_start();

$id = $_GET['id'];
$pasien = mysqli_query($connect, "SELECT id_pasien from kunjungan WHERE id_kunjungan = $id");
$query = "DELETE FROM kunjungan WHERE id_kunjungan = $id";
$result  = mysqli_query($connect, $query);
$deletePasien = mysqli_query($connect, "DELETE FROM pasien WHERE id_pasien = " . mysqli_fetch_assoc($pasien)['id_pasien']);

if ($result && $deletePasien) {
    header("Location: dataPendaftaranOnline.php?pesan=hapus_berhasil");
} else {
    header("Location: dataPendaftaranOnline.php?pesan=id_tidak_ditemukan");
}
?>
