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

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">No Kamar</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Status</th>
                                <th scope="col">Nama Penghuni</th>
                                <th scope="col">Tanggal Masuk</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'connection.php';
                            $result = mysqli_query($connect, "SELECT * FROM pesankamar");
                            
                            $no = 1; 
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th> <td><?= $row['kelas'] ?></td>
                                <td>
                                    <span class="badge <?= ($row['status'] == 'Terisi') ? 'bg-danger' : 'bg-success' ?>">
                                        <?= $row['status'] ?>
                                    </span>
                                </td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['tanggal_masuk'] ?></td>
                                <td>
                                    <a href="editDataKamar.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
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