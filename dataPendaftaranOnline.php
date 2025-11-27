<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .action-buttons {
            display: flex;
            gap: .4rem;
            align-items: center;
            flex-wrap: nowrap;
            /* jangan wrap ke baris baru */
        }

        .action-buttons .btn {
            white-space: nowrap;
            /* teks tombol tidak terpotong ke baris baru */
        }
    </style>
</head>

<body style="padding-top: 100px;">
    <?php
    session_start();
    if (empty($_SESSION['username'])) {
        header("Location: login.php?pesan=belum_login");
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
                        <a class="nav-link active fw-bold text-success" href="dataPendaftaranOnline.php">Data Pendaftaran Pasien</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dataPesanKamar.php">Data Kamar Pasien</a>
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
            <h2>Data Pendaftaran Pasien</h2>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-success">
                            <tr>
                                <!-- <th>ID Kunjungan</th> -->
                                <th>No Antri</th>
                                <th>Nama Pasien</th>
                                <th>Poli Tujuan</th>
                                <th>Dokter</th>
                                <th>Tanggal Berobat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody> <?php
                                include 'connection.php';

                            $query = "SELECT k.id_kunjungan, k.nomor_antrian, 
                             p.nama AS nama_pasien, 
                             k.poli_tujuan, 
                             d.nama AS nama_dokter, 
                             k.tanggal_kunjungan,
                             CASE k.status
                                WHEN 1 THEN 'DARURAT'
                                WHEN 2 THEN 'SEGERA'
                                WHEN 3 THEN 'RUTIN'
                                ELSE 'TIDAK DIKETAHUI'
                             END AS status
                            FROM kunjungan k 
                            INNER JOIN jadwal_dokter j ON j.id_jadwal = k.id_jadwal
                            INNER JOIN dokter d ON j.id_dokter = d.id_dokter
                            INNER JOIN pasien p ON k.id_pasien = p.id_pasien
                            ORDER BY k.status";

                                $result = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <!-- <th><?= $row['id_kunjungan'] ?></th> -->
                                    <td><?= $row['nomor_antrian'] ?></td>

                                    <td><?= $row['nama_pasien'] ?></td>

                                    <td><?= $row['poli_tujuan'] ?></td>

                                    <td><?= $row['nama_dokter'] ?></td>

                                    <td><?= $row['tanggal_kunjungan'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <td>
                                        <div class="action-buttons" style="display: flex; gap: 0.4rem;">
                                            <a href="editDataPasien.php?id=<?= $row['id_kunjungan'] ?>" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="deleteDataPasien.php?id=<?= $row['id_kunjungan'] ?>" class="btn btn-danger btn-sm ms-1" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i> Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>