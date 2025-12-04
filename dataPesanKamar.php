<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kamar Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body style="padding-top: 100px;">
    <?php
    session_start();
    if (empty($_SESSION['username'])) {
        header("Location: login.php?pesan=belum_login");
        exit();
    }
    ?>
    <nav id="navbarPuskesmas" class="navbar navbar-expand-lg navbar-light bg-white shadow-lg fixed-top">
        <div class="container">
            <img style="padding-left: 2%;" width="90" src="logo puskesmas nusantara.png" alt="Logo">
            <a class="navbar-brand" href="#" style="font-weight: bold; padding-left: 10px;">Admin Puskesmas Nusantara</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPuskesmas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarPuskesmas">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dataPendaftaranOnline.php">Data Pendaftaran Pasien</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold text-success" href="dataPesanKamar.php">Data Kamar Pasien</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Data Ketersediaan Kamar</h2>
        </div>

<?php
include 'connection.php';
$classes = ['VIP', 'Kelas 1', 'Kelas 2', 'Kelas 3'];

foreach ($classes as $className) {
    $sql = "SELECT pk.id, kf.id_kamar, kf.nomor_kamar, kk.nama_kelas AS kelas, kf.status_kamar AS status,
                   p.nama, pk.tanggal_masuk, pk.id_pasien
            FROM kamar_fisik kf
            JOIN kelas_kamar kk ON kf.id_kelas = kk.id_kelas
            LEFT JOIN pesankamar pk ON kf.id_kamar = pk.id_kamar
            LEFT JOIN pasien p ON pk.id_pasien = p.id_pasien
            WHERE kk.nama_kelas = ?
            ORDER BY kf.nomor_kamar ASC";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, 's', $className);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="mb-0"><?= htmlspecialchars($className) ?></h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered mb-0">
                    <thead class="table-success">
                        <tr>
                            <th>No Kamar</th>
                            <th>Kelas</th>
                            <th>Status</th>
                            <th>Nama Penghuni</th>
                            <th>Tanggal Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) {
                       
                        if (empty($row['id_pasien'])) { ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nomor_kamar']) ?></td>
                                <td><?= htmlspecialchars($row['kelas']) ?></td>
                                <td>
                                    <span class="badge <?= ($row['status'] === 'Terisi') ? 'bg-danger' : 'bg-success' ?>">
                                        <?= htmlspecialchars($row['status']) ?>
                                    </span>
                                </td>
                                <td colspan="3" class="text-muted" style="text-align: center;">Kamar kosong</td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nomor_kamar']) ?></td>
                                <td><?= htmlspecialchars($row['kelas']) ?></td>
                                <td>
                                    <span class="badge <?= ($row['status'] === 'Terisi') ? 'bg-danger' : 'bg-success' ?>">
                                        <?= htmlspecialchars($row['status']) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= htmlspecialchars($row['tanggal_masuk']) ?></td>
                                <td>
                                    <a href="editDataKamar.php?id=<?= (int)$row['id'] ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="deleteDataKamar.php?id=<?= (int)$row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    mysqli_stmt_close($stmt); 
}
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>