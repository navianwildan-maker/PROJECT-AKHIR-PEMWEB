<?php
include 'connection.php';
session_start();
$id = $_GET['id'] ?? null;
if ($id === null) {
    echo "<script>alert('ID Kamar tidak ditemukan!'); window.location.href='dataPesanKamar.php';</script>";
    exit;
}
$query = "DELETE FROM pesankamar WHERE id = $id";
$result  = mysqli_query($connect, $query);
if ($result && $deletePasien) {
    echo "<script>alert('Data Kamar berhasil dihapus!'); window.location.href='dataPesanKamar.php';</script>";
} else {
    echo "<script>alert('Data Kamar Tidak Ditemukan'); window.location.href='dataPesanKamar.php';</script>";
}
?>