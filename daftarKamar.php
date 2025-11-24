<?php
include 'connection.php';

$nama = trim($_POST['nama'] ?? '');
$nik = trim($_POST['nik'] ?? '');
$bpjs = trim($_POST['bpjs'] ?? '');
$kamar = trim($_POST['kamar'] ?? '');
$tanggal = trim($_POST['tanggal'] ?? '');
$status = "Booking"; 

$isSuccess = false;
$errorMessage = "";

if(empty($nama) || empty($kamar) || empty($tanggal)) {
    $errorMessage = "Data tidak lengkap.";
} else {
    // Hitung harga untuk tampilan (TIDAK DISIMPAN KE DB KARENA KOLOM TIDAK ADA)
    $harga = 0;
    if($kamar == "Kelas 1") $harga = 500000;
    elseif($kamar == "Kelas 2") $harga = 300000;
    elseif($kamar == "Kelas 3") $harga = 150000;
    elseif($kamar == "VIP/VVIP") $harga = 1000000;

    if (!empty($bpjs) && ($kamar === "Kelas 2" || $kamar === "Kelas 3")) {
        $harga = 0;
    } 
    
    $total = $harga + 5500; 
    $id_pasien = 0;
    $cekPasien = mysqli_query($connect, "SELECT id_pasien FROM pasien WHERE nik = '$nik'");
    if($row = mysqli_fetch_assoc($cekPasien)){
        $id_pasien = $row['id_pasien'];
    }

    $sql = "INSERT INTO pesankamar (id_pasien, nama, nik, bpjs, kelas, tanggal_masuk, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($connect, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "issssss", $id_pasien, $nama, $nik, $bpjs, $kamar, $tanggal, $status);
        
        try {
            if (mysqli_stmt_execute($stmt)) {
                $isSuccess = true;
            } else {
                if(mysqli_errno($connect) == 1062){
                     $errorMessage = "Gagal: Pasien dengan NIK/BPJS ini sudah memesan kamar (Data Duplikat).";
                } else {
                     $errorMessage = "Gagal menyimpan data: " . mysqli_stmt_error($stmt);
                }
            }
        } catch (Exception $e) {
            $errorMessage = "Terjadi kesalahan: " . $e->getMessage();
        }
        mysqli_stmt_close($stmt);
    } else {
        $errorMessage = "Query Error: " . mysqli_error($connect);
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f0fdfa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card-receipt {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(15, 118, 110, 0.15);
            overflow: hidden;
            background: white;
            max-width: 500px;
            margin: 50px auto;
        }
        .receipt-header {
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
        }
        .icon-circle {
            width: 80px;
            height: 80px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            backdrop-filter: blur(5px);
        }
        .receipt-body {
            padding: 30px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            border-bottom: 1px dashed #e2e8f0;
            padding-bottom: 15px;
        }
        .detail-label { color: #64748b; font-size: 0.9rem; }
        .detail-value { font-weight: 600; color: #1e293b; text-align: right; }
        .btn-home {
            background-color: #0f766e; color: white; border-radius: 50px;
            padding: 12px 30px; width: 100%; font-weight: 600; transition: all 0.3s;
        }
        .btn-home:hover { background-color: #14b8a6; color: white; transform: translateY(-2px); }
    </style>
</head>
<body>

<div class="container">
    <?php if ($isSuccess): ?>
    <div class="card-receipt">
        <div class="receipt-header">
            <div class="icon-circle"><i class="bi bi-check-lg" style="font-size: 40px;"></i></div>
            <h3 class="fw-bold mb-1">Pemesanan Berhasil!</h3>
            <p class="mb-0 opacity-75">Data tersimpan di sistem RS</p>
        </div>
        <div class="receipt-body">
            <div class="text-center mb-4">
                <p class="text-muted small mb-1">Estimasi Tagihan</p>
                <h2 class="fw-bold text-success">Rp<?= number_format($total, 0, ',', '.') ?></h2>
            </div>

            <div class="detail-row">
                <span class="detail-label">Nama Pasien</span>
                <span class="detail-value"><?= htmlspecialchars($nama) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">NIK</span>
                <span class="detail-value"><?= htmlspecialchars($nik) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Kelas Kamar</span>
                <span class="detail-value"><?= htmlspecialchars($kamar) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Tanggal Masuk</span>
                <span class="detail-value"><?= date('d F Y', strtotime($tanggal)) ?></span>
            </div>
            
            <div class="mt-4">
                <a href="TA_PUSKESMAS.php" class="btn btn-home">Kembali ke Beranda</a>
                <a href="pesanKamar.php" class="btn btn-outline-secondary rounded-pill w-100 mt-2">Pesan Lagi</a>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="card-receipt">
        <div class="receipt-header" style="background: #ef4444;">
            <div class="icon-circle"><i class="bi bi-x-lg" style="font-size: 40px;"></i></div>
            <h3 class="fw-bold mb-1">Pemesanan Gagal</h3>
        </div>
        <div class="receipt-body text-center">
            <p class="text-danger mb-4"><?= $errorMessage ?></p>
            <a href="pesanKamar.php" class="btn btn-home" style="background-color: #ef4444;">Coba Lagi</a>
        </div>
    </div>
    <?php endif; ?>
</div>
</body>
</html>