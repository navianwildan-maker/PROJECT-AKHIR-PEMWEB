<?php
include 'connection.php';

$nama = trim($_POST['nama'] ?? '');
$nik   = trim($_POST['nik'] ?? '');
$bpjs  = trim($_POST['bpjs'] ?? '');
$kamar = trim($_POST['kamar'] ?? '');
$tanggal = trim($_POST['tanggal'] ?? '');
$isSuccess = false;
$errorMessage = "";

// basic validation
if (empty($nama) || empty($nik) || empty($kamar) || empty($tanggal)) {
    $errorMessage = "Data tidak lengkap.";
} else {
    // 1) cari pasien (prepared)
    if ($bpjs === '') {
        $stmt = mysqli_prepare($connect, "SELECT id_pasien FROM pasien WHERE nik = ?");
        mysqli_stmt_bind_param($stmt, 's', $nik);
    } else {
        $stmt = mysqli_prepare($connect, "SELECT id_pasien FROM pasien WHERE nik = ? AND bpjs = ?");
        mysqli_stmt_bind_param($stmt, 'ss', $nik, $bpjs);
    }
    if (! $stmt) {
        $errorMessage = "Query Error: " . mysqli_error($connect);
    } else {
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        if ($res === false) {
            $errorMessage = "Query Error: " . mysqli_error($connect);
        } else if (mysqli_num_rows($res) == 0) {
            $errorMessage = "Gagal: Pasien belum terdaftar. Silahkan daftar pasien terlebih dahulu.";
        } else {
            $row = mysqli_fetch_assoc($res);
            $id_pasien = (int)$row['id_pasien'];

            // 2) ambil id_kelas dan harga dari kelas_kamar
            $stmt = mysqli_prepare($connect, "SELECT id_kelas, tarif FROM kelas_kamar WHERE nama_kelas = ?");
            if (! $stmt) {
                $errorMessage = "Query Error: " . mysqli_error($connect);
            } else {
                mysqli_stmt_bind_param($stmt, 's', $kamar);
                mysqli_stmt_execute($stmt);
                $res2 = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);

                if ($res2 === false || mysqli_num_rows($res2) == 0) {
                    $errorMessage = "Kelas kamar tidak ditemukan.";
                } else {
                    $kelasRow = mysqli_fetch_assoc($res2);
                    $id_kelas = (int)$kelasRow['id_kelas'];
                    $harga = (int)$kelasRow['tarif'];

                    // business rule: BPJS covers Kelas 2 & 3
                    if (!empty($bpjs) && ($kamar === "Kelas 2" || $kamar === "Kelas 3")) {
                        $harga = 0;
                    }

                    // total harga (jangan ubah perhitungan ini)
                    $total = $harga + 5500;

                    // 3) pilih kamar fisik yang kosong untuk id_kelas ini
                    $stmt = mysqli_prepare($connect, "SELECT id_kamar FROM kamar_fisik WHERE id_kelas = ? AND status_kamar = 'Tersedia' LIMIT 1");
                    if (! $stmt) {
                        $errorMessage = "Query Error: " . mysqli_error($connect);
                    } else {
                        mysqli_stmt_bind_param($stmt, 'i', $id_kelas);
                        mysqli_stmt_execute($stmt);
                        $res3 = mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);

                        if ($res3 === false || mysqli_num_rows($res3) == 0) {
                            $errorMessage = "Tidak ada kamar kosong untuk kelas ini.";
                        } else {
                            $kamarRow = mysqli_fetch_assoc($res3);
                            $id_kamar = (int)$kamarRow['id_kamar'];

                            // 4) insert pesankamar dan update status kamar dalam transaksi
                            mysqli_begin_transaction($connect);
                            try {
                                $ins = mysqli_prepare($connect, "INSERT INTO pesankamar (id_pasien, id_kamar, tanggal_masuk) VALUES (?, ?, ?)");
                                if (! $ins) throw new Exception(mysqli_error($connect));
                                mysqli_stmt_bind_param($ins, 'iis', $id_pasien, $id_kamar, $tanggal);
                                if (! mysqli_stmt_execute($ins)) {
                                    throw new Exception(mysqli_stmt_error($ins));
                                }
                                mysqli_stmt_close($ins);

                                $upd = mysqli_prepare($connect, "UPDATE kamar_fisik SET status_kamar = 'Terisi' WHERE id_kamar = ?");
                                if (! $upd) throw new Exception(mysqli_error($connect));
                                mysqli_stmt_bind_param($upd, 'i', $id_kamar);
                                if (! mysqli_stmt_execute($upd)) {
                                    throw new Exception(mysqli_stmt_error($upd));
                                }
                                mysqli_stmt_close($upd);

                                mysqli_commit($connect);
                                $isSuccess = true;
                            } catch (Exception $e) {
                                mysqli_rollback($connect);
                                // handle duplicate or other DB errors
                                if (strpos($e->getMessage(), 'Duplicate') !== false || mysqli_errno($connect) == 1062) {
                                    $errorMessage = "Gagal: Pasien dengan NIK/BPJS ini sudah memesan kamar (Data Duplikat).";
                                } else {
                                    $errorMessage = "Gagal menyimpan data: " . $e->getMessage();
                                }
                            }
                        }
                    }
                }
            }
        }
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
            <p class="mb-0 opacity-75">Data tersimpan di sistem Puskesmas</p>
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
                <span class="detail-label">Nomor Kamar</span>
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