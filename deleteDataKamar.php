<?php
include 'connection.php';
session_start();
$id = $_GET['id'] ?? null;
if ($id === null) {
    echo "<script>alert('ID Kamar tidak ditemukan!'); window.location.href='dataPesanKamar.php';</script>";
    exit;
}
$id = intval($id);

// get id_kamar from pesankamar
$resultSelect = mysqli_query($connect, "SELECT id_kamar FROM pesankamar WHERE id = $id");
if ($resultSelect && mysqli_num_rows($resultSelect) > 0) {
    $row = mysqli_fetch_assoc($resultSelect);
    $id_kamar = intval($row['id_kamar']);

    // update kamar_fisik status using the fetched id_kamar
    $statusRefresh = "UPDATE kamar_fisik SET status_kamar = 'Tersedia' WHERE id_kamar = $id_kamar AND status_kamar != 'Tersedia'";
    mysqli_query($connect, $statusRefresh);
}

$query = "DELETE FROM pesankamar WHERE id = $id";
$result  = mysqli_query($connect, $query);
if (mysqli_affected_rows($connect) > 0) {
    echo "<script>alert('Data Kamar berhasil dihapus!'); window.location.href='dataPesanKamar.php';</script>";
} else {
    echo "<script>alert('Data Kamar Tidak Ditemukan'); window.location.href='dataPesanKamar.php';</script>";
}
?>