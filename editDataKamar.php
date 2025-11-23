<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kamar - Admin Puskesmas</title>
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

    $id = $_GET['id'];

    if (isset($_POST['update'])) {
        $nama_pasien = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $status = $_POST['status'];
        $tanggal_masuk = $_POST['tanggal_masuk'];

        $query_update = "UPDATE pesankamar SET 
                         nama = '$nama_pasien', 
                         kelas = '$kelas', 
                         status = '$status',
                         tanggal_masuk = '$tanggal_masuk'
                         WHERE id = '$id'";

        if (mysqli_query($connect, $query_update)) {
            echo "<script>alert('Data Kamar berhasil diupdate!'); window.location.href='dataPesanKamar.php';</script>";
        } else {
            echo "<script>alert('Gagal update: " . mysqli_error($connect) . "');</script>";
        }
    }

    $query = "SELECT * FROM pesankamar WHERE id = '$id'";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_array($result);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='dataPesanKamar.php';</script>";
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
                        <a class="nav-link active fw-bold text-success" href="dataPesanKamar.php">Kembali</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Data Kamar</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Nama Pasien</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Kelas Kamar</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="kelas" required>
                                        <option value="Kelas 1" <?= ($data['kelas'] == 'Kelas 1') ? 'selected' : '' ?>>Kelas 1</option>
                                        <option value="Kelas 2" <?= ($data['kelas'] == 'Kelas 2') ? 'selected' : '' ?>>Kelas 2</option>
                                        <option value="Kelas 3" <?= ($data['kelas'] == 'Kelas 3') ? 'selected' : '' ?>>Kelas 3</option>
                                        <option value="VIP" <?= ($data['kelas'] == 'VIP') ? 'selected' : '' ?>>VIP</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Status Kamar</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="status" required>
                                        <option value="Terisi" <?= ($data['status'] == 'Terisi') ? 'selected' : '' ?>>Terisi</option>
                                        <option value="Kosong" <?= ($data['status'] == 'Kosong') ? 'selected' : '' ?>>Kosong</option>
                                        <option value="Dibersihkan" <?= ($data['status'] == 'Dibersihkan') ? 'selected' : '' ?>>Dibersihkan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Tanggal Masuk</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="tanggal_masuk" value="<?= $data['tanggal_masuk'] ?>" required>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="dataPesanKamar.php" class="btn btn-secondary me-md-2">Batal</a>
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