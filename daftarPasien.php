<?php
include 'connection.php';

// ambil dan validasi input
$nama = trim($_POST['nama'] ?? '');
$nik = trim($_POST['nik'] ?? '');
$bpjs = trim($_POST['bpjs'] ?? '');
$poli = trim($_POST['poli'] ?? '');
$input_date = trim($_POST['tanggal_berobat'] ?? '');
$status = 'Menunggu';

if ($nama === '' || $nik === '' || $poli === '' || $input_date === '') {
    echo "<script>alert('Data tidak lengkap.'); window.location.href='pendaftaranPuskesmas.php';</script>";
    exit;
}

// parsing tanggal (form type=date -> format ISO Y-m-d). fallback dengan strtotime
$dt = DateTime::createFromFormat('Y-m-d', $input_date) ?: (new DateTime())->setTimestamp(strtotime($input_date));
if (!$dt) {
    echo "<script>alert('Format tanggal tidak valid.'); window.location.href='pendaftaranPuskesmas.php';</script>";
    exit;
}
$tanggal_berobat = $dt->format('Y-m-d');

// buat nama hari dalam Bahasa Indonesia
$day_en = $dt->format('l');
$map = [
    'Sunday'    => 'Minggu', 'Monday'    => 'Senin',
    'Tuesday'   => 'Selasa', 'Wednesday' => 'Rabu',
    'Thursday'  => 'Kamis', 'Friday'    => 'Jumat',
    'Saturday'  => 'Sabtu'
];
$hari_praktik = $map[$day_en] ?? $day_en;

// cari jadwal berdasarkan poli + hari (gunakan prepared statement)
$stmt = mysqli_prepare($connect,
    "SELECT j.id_jadwal
     FROM jadwal_dokter j
     INNER JOIN dokter d ON j.id_dokter = d.id_dokter
     WHERE d.poli = ? AND j.hari_praktik = ?
     LIMIT 1");
if (!$stmt) {
    error_log("Prepare failed: " . mysqli_error($connect));
    echo "<script>alert('Terjadi kesalahan server.'); window.location.href='pendaftaranPuskesmas.php';</script>";
    exit;
}
mysqli_stmt_bind_param($stmt, 'ss', $poli, $hari_praktik);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
if (mysqli_stmt_num_rows($stmt) === 0) {
    mysqli_stmt_close($stmt);
    echo "<script>alert('Jadwal dokter tidak ditemukan untuk poli dan tanggal yang dipilih. Silakan coba lagi.'); window.location.href='pendaftaranPuskesmas.php';</script>";
    exit();
}
mysqli_stmt_bind_result($stmt, $id_jadwal);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// mulai transaksi: insert pasien lalu kunjungan
mysqli_begin_transaction($connect);
try {
    // insert pasien
    $ins1 = mysqli_prepare($connect, "INSERT INTO pasien (nama, nik, bpjs) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($ins1, 'sss', $nama, $nik, $bpjs);
    mysqli_stmt_execute($ins1);
    mysqli_stmt_close($ins1);

    $id_pasien = mysqli_insert_id($connect);
    if (!$id_pasien) {
        throw new Exception('Gagal mendapatkan id pasien.');
    }

    // insert kunjungan
    $ins2 = mysqli_prepare($connect, "INSERT INTO kunjungan (id_pasien, id_jadwal, poli_tujuan, tanggal_kunjungan, status) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($ins2, 'iisss', $id_pasien, $id_jadwal, $poli, $tanggal_berobat, $status);
    mysqli_stmt_execute($ins2);
    mysqli_stmt_close($ins2);

    mysqli_commit($connect);
    header("Location: TA_PUSKESMAS.php");
    exit;
} catch (Exception $e) {
    mysqli_rollback($connect);
    error_log("Pendaftaran gagal: " . $e->getMessage());
    echo "<script>alert('Pendaftaran gagal. Silakan coba lagi.'); window.location.href='pendaftaranPuskesmas.php';</script>";
    exit;
}