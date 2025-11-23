<?php
include 'connection.php';

$showSuccess = false;
$showError = false;
$errorMsg = "";
$dataDisplay = [];

$nama = trim($_POST['nama'] ?? '');
$nik = trim($_POST['nik'] ?? '');
$bpjs = trim($_POST['bpjs'] ?? '');
$poli = trim($_POST['poli'] ?? '');
$input_date = trim($_POST['tanggal_berobat'] ?? '');
$status = 'Menunggu';

if ($nama === '' || $nik === '' || $poli === '' || $input_date === '') {
    $showError = true;
    $errorMsg = "Data form tidak lengkap.";
} else {
    $dt = DateTime::createFromFormat('Y-m-d', $input_date) ?: (new DateTime())->setTimestamp(strtotime($input_date));
    if (!$dt) {
        $showError = true;
        $errorMsg = "Format tanggal tidak valid.";
    } else {
        $tanggal_berobat = $dt->format('Y-m-d');

        $day_en = $dt->format('l');
        $map = [
            'Sunday'    => 'Minggu', 'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa', 'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis', 'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu'
        ];
        $hari_praktik = $map[$day_en] ?? $day_en;

        $stmt = mysqli_prepare($connect,
            "SELECT j.id_jadwal, d.nama as nama_dokter
             FROM jadwal_dokter j
             INNER JOIN dokter d ON j.id_dokter = d.id_dokter
             WHERE d.poli = ? AND j.hari_praktik = ?
             LIMIT 1");
             
        if (!$stmt) {
            $showError = true;
            $errorMsg = "Database Error: " . mysqli_error($connect);
        } else {
            mysqli_stmt_bind_param($stmt, 'ss', $poli, $hari_praktik);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            
            if ($row = mysqli_fetch_assoc($res)) {
                $id_jadwal = $row['id_jadwal'];
                $nama_dokter = $row['nama_dokter'];
                mysqli_stmt_close($stmt);

                mysqli_begin_transaction($connect);
                try {
                    $cek_pasien = mysqli_query($connect, "SELECT id_pasien FROM pasien WHERE nik = '$nik'");
                    if(mysqli_num_rows($cek_pasien) > 0) {
                        $p = mysqli_fetch_assoc($cek_pasien);
                        $id_pasien = $p['id_pasien'];
                    } else {
                        $ins1 = mysqli_prepare($connect, "INSERT INTO pasien (nama, nik, bpjs) VALUES (?, ?, ?)");
                        mysqli_stmt_bind_param($ins1, 'sss', $nama, $nik, $bpjs);
                        mysqli_stmt_execute($ins1);
                        $id_pasien = mysqli_insert_id($connect);
                        mysqli_stmt_close($ins1);
                    }

                    $q_antrian = mysqli_query($connect, "SELECT COUNT(*) as total FROM kunjungan WHERE id_jadwal = '$id_jadwal' AND tanggal_kunjungan = '$tanggal_berobat'");
                    $r_antrian = mysqli_fetch_assoc($q_antrian);
                    $nomor_antrian = $r_antrian['total'] + 1;
                    $ins2 = mysqli_prepare($connect, "INSERT INTO kunjungan (id_pasien, id_jadwal, poli_tujuan, tanggal_kunjungan, nomor_antrian, status) VALUES (?, ?, ?, ?, ?, ?)");
                    

                    mysqli_stmt_bind_param($ins2, 'iissis', $id_pasien, $id_jadwal, $poli, $tanggal_berobat, $nomor_antrian, $status);
                    
                    if (!mysqli_stmt_execute($ins2)) {
                         throw new Exception("Gagal insert kunjungan: " . mysqli_stmt_error($ins2));
                    }
                    mysqli_stmt_close($ins2);

                    mysqli_commit($connect);
                    
                    $showSuccess = true;
                    $dataDisplay = [
                        'nama' => $nama,
                        'poli' => $poli,
                        'dokter' => $nama_dokter,
                        'hari' => $hari_praktik . ", " . date('d-m-Y', strtotime($tanggal_berobat)),
                        'antrian' => $nomor_antrian
                    ];

                } catch (Exception $e) {
                    mysqli_rollback($connect);
                    $showError = true;
                    $errorMsg = "Gagal memproses pendaftaran: " . $e->getMessage();
                }
            } else {
                mysqli_stmt_close($stmt);
                $showError = true;
                $errorMsg = "Jadwal dokter tidak ditemukan untuk poli $poli pada hari $hari_praktik.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #e6fffa; font-family: sans-serif; }
        .ticket-card {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 450px;
            margin: 60px auto;
            position: relative;
        }
        .ticket-header {
            background-color: #0f766e;
            color: white;
            padding: 30px;
            text-align: center;
            border-bottom: 5px solid #134e4a;
        }
        .queue-number {
            font-size: 4rem;
            font-weight: 800;
            color: #0f766e;
            line-height: 1;
        }
        .queue-label {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.8rem;
            color: #64748b;
        }
        .info-list {
            padding: 20px 40px;
        }
        .info-item {
            margin-bottom: 15px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 5px;
        }
        .info-label {
            font-size: 0.85rem;
            color: #94a3b8;
        }
        .info-value {
            font-weight: 600;
            color: #334155;
            font-size: 1.1rem;
        }
        .cut-line {
            border-top: 2px dashed #cbd5e1;
            margin: 20px 0;
            position: relative;
        }
        .cut-line::before, .cut-line::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: #e6fffa;
            border-radius: 50%;
            top: -12px;
        }
        .cut-line::before { left: -10px; }
        .cut-line::after { right: -10px; }
    </style>
</head>
<body>
    
    <div class="container">
        <?php if ($showSuccess): ?>
            <div class="ticket-card">
                <div class="ticket-header">
                    <img src="logo puskesmas nusantara.png" width="50" class="mb-2 bg-white rounded-circle p-1">
                    <h5 class="fw-bold mb-0">PUSKESMAS NUSANTARA</h5>
                    <small>Bukti Pendaftaran Online</small>
                </div>
                
                <div class="text-center pt-4">
                    <p class="queue-label mb-1">Nomor Antrian Anda</p>
                    <div class="queue-number"><?= sprintf("%03d", $dataDisplay['antrian']) ?></div>
                </div>

                <div class="info-list">
                    <div class="info-item">
                        <div class="info-label">Nama Pasien</div>
                        <div class="info-value"><?= htmlspecialchars($dataDisplay['nama']) ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Poli Tujuan</div>
                        <div class="info-value"><?= htmlspecialchars($dataDisplay['poli']) ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Dokter</div>
                        <div class="info-value"><?= htmlspecialchars($dataDisplay['dokter']) ?></div>
                    </div>
                    <div class="info-item" style="border: none;">
                        <div class="info-label">Jadwal</div>
                        <div class="info-value"><?= htmlspecialchars($dataDisplay['hari']) ?></div>
                    </div>
                </div>

                <div class="cut-line"></div>

                <div class="p-4 pt-0">
                    <a href="TA_PUSKESMAS.php" class="btn w-100 text-white fw-bold mb-2" style="background-color: #0f766e; border-radius: 50px;">Selesai & Kembali</a>
                    <button onclick="window.print()" class="btn btn-outline-secondary w-100 fw-bold" style="border-radius: 50px;">
                        <i class="bi bi-printer me-2"></i> Cetak / Simpan
                    </button>
                    <p class="text-center text-muted small mt-3">Harap datang 30 menit sebelum jadwal.</p>
                </div>
            </div>
        <?php elseif ($showError): ?>
            <div class="ticket-card text-center pb-4">
                <div class="ticket-header bg-danger">
                    <h4 class="fw-bold mb-0">Pendaftaran Gagal</h4>
                </div>
                <div class="p-5">
                    <i class="bi bi-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                    <p class="mt-3"><?= $errorMsg ?></p>
                    <a href="pendaftaranPuskesmas.php" class="btn btn-danger rounded-pill px-4">Kembali ke Form</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>