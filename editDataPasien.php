<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pendaftaran - Admin Puskesmas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body style="padding-top: 100px;">
    <?php
    session_start();
    include 'connection.php';

    if (empty($_SESSION['username'])) {
        header("Location: login.php?pesan=belum_login");
        exit();
    }

    $id_kunjungan = $_GET['id'];

    if (isset($_POST['update'])) {
        $poli_tujuan = $_POST['poli_tujuan'];
        $tanggal_kunjungan = $_POST['tanggal_kunjungan'];
        $query_update = "UPDATE kunjungan SET 
                         poli_tujuan = '$poli_tujuan', 
                         tanggal_kunjungan = '$tanggal_kunjungan'
                         WHERE id_kunjungan = '$id_kunjungan'";

        if (mysqli_query($connect, $query_update)) {
            echo "<script>alert('Data berhasil diupdate!'); window.location.href='dataPendaftaranOnline.php';</script>";
        } else {
            echo "<script>alert('Gagal mengupdate data: " . mysqli_error($connect) . "');</script>";
        }
    }
    $query = "SELECT k.*, p.nama AS nama_pasien, d.nama AS nama_dokter 
              FROM kunjungan k 
              INNER JOIN jadwal_dokter j ON j.id_jadwal = k.id_jadwal
              INNER JOIN dokter d ON j.id_dokter = d.id_dokter
              INNER JOIN pasien p ON k.id_pasien = p.id_pasien
              WHERE k.id_kunjungan = '$id_kunjungan'";
    
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_array($result);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='dataPendaftaranOnline.php';</script>";
        exit;
    }
    ?>

    <nav id="navbarPuskesmas" class="navbar navbar-expand-lg navbar-light bg-white shadow-lg fixed-top">
        <div class="container">
            <img style="padding-left: 2%;" width="90" src="logo puskesmas nusantara.png" alt="Logo">
            <a class="navbar-brand" href="#" style="font-weight: bold; padding-left: 10px;">Admin Puskesmas Nusantara</a>
            
            <div class="collapse navbar-collapse" id="navbarPuskesmas">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold text-success" href="dataPendaftaranOnline.php">Kembali</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Data Pendaftaran</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">ID Kunjungan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $data['id_kunjungan'] ?>" disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Nama Pasien</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $data['nama_pasien'] ?>" disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Dokter Saat Ini</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $data['nama_dokter'] ?>" disabled>
                                    <small class="text-muted">*Dokter bergantung pada jadwal, edit jadwal jika ingin mengubah dokter.</small>
                                </div>
                            </div>

                            <hr>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Poli Tujuan</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="poli_tujuan" required>
                                        <option value="Poli Umum" <?= ($data['poli_tujuan'] == 'Poli Umum') ? 'selected' : '' ?>>Poli Umum</option>
                                        <option value="Poli Gigi" <?= ($data['poli_tujuan'] == 'Poli Gigi') ? 'selected' : '' ?>>Poli Gigi</option>
                                        <option value="Poli Anak" <?= ($data['poli_tujuan'] == 'Poli Anak') ? 'selected' : '' ?>>Poli Anak</option>
                                        <option value="Poli Kandungan" <?= ($data['poli_tujuan'] == 'Poli Kandungan') ? 'selected' : '' ?>>Poli Kandungan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Tanggal Berobat</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="tanggal_kunjungan" value="<?= $data['tanggal_kunjungan'] ?>" required>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="dataPendaftaranOnline.php" class="btn btn-secondary me-md-2">Batal</a>
                                <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>