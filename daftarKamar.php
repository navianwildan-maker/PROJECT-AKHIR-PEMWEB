<?php
include 'connection.php';
$nama = trim($_POST['nama'] ?? '');
$nik = trim($_POST['nik'] ?? '');
$bpjs = trim($_POST['bpjs'] ?? '');
$kamar = trim($_POST['kamar'] ?? '');
$tanggal = trim($_POST['tanggal'] ?? '');
$status = "Assign";

$query = "INSERT INTO pesankamar (nama, nik, bpjs, kelas, tanggal_masuk, status) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($connect, $query);
if (!$stmt) {
	die("Prepare failed: " . mysqli_error($connect));
}
mysqli_stmt_bind_param($stmt, "ssssss", $nama, $nik, $bpjs, $kamar, $tanggal, $status);
if (!mysqli_stmt_execute($stmt)) {
	die("Execute failed: " . mysqli_stmt_error($stmt));
}
mysqli_stmt_close($stmt);
mysqli_close($connect);

header("Location: pesanKamar.php?pesan=pemesanan_berhasil");
exit();

?>