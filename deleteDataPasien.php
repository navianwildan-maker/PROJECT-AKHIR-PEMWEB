<?php
include 'connection.php';
session_start();

$id = $_GET['id'];
$query = "DELETE FROM kunjungan WHERE id_kunjungan = $id";
$result  = mysqli_query($connect, $query);
if ($result) {
    header("Location: dataPendaftaranOnline.php?pesan=hapus_berhasil");
} else {
    header("Location: dataPendaftaranOnline.php?pesan=id_tidak_ditemukan");
}
?>
