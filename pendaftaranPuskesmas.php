<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pendaftaran Online</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="icon" type="image/x-icon" href="logo puskesmas nusantara.png">
        <style>
            body{
                background-color: white;
            }
            .warna-bg{
                background-color: #0f766e;
                background-image: linear-gradient(135deg, #14b8a6 0%, #097168 100%);
            }
            .section-padding{
                padding: 10rem 0;
            }
            .icon{
                width: 64px;
                height: 64px;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #97ded6;
                border-radius: 50%;
                font-size: 2rem;
                color: #097168;
            }
        </style>

    </head>
    <body>

        <!--navbar-->
        <nav id="navbarPuskesmas"
            class="navbar navbar-expand-lg navbar-light bg-white shadow-lg fixed-top"
            aria-label="Puskesmas Navbar">
            <div class="container">
                <img style="padding-left: 2%;" width="90"
                    src="logo puskesmas nusantara.png">
                <a class="navbar-brand" href="TA_PUSKESMAS.php"
                    style="font-weight: bold; padding-top: 1%; padding-bottom: 1%; padding-left: 1%;">Puskesmas
                    Nusantara</a>

                <button class="navbar-toggler"
                    type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarPuskesmas"
                    aria-controls="navbarPuskesmas" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Mobile Menu -->
                <div class="collapse navbar-collapse" id="navbarPuskesmas">

                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active"
                                aria-current="page"
                                href="TA_PUSKESMAS.php#profil-pks">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="TA_PUSKESMAS.php#layanan">Layanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="TA_PUSKESMAS.php#jadwal"
                                aria-disabled="true">Jadwal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="TA_PUSKESMAS.php#kontak"
                                aria-expanded="false">Kontak</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="TA_PUSKESMAS.php#pesanKamar"
                                aria-expanded="false">Pesan kamar</a>
                        </li>
                    </ul>

                    <div class="btn btn-light rounded-pill px-1 py-1 me-1">
                        <a href="#" class="btn nav-link"
                            style="background-color: #0f766e; border-color: #0f766e; color: white; border-radius: 100px; padding: 1%">Pendaftaran
                            Online</a>
                    </div>
                </div>
            </div>
        </nav>

        <!--pendaftaran-->
        <section id="pendaftaran" class="section-padding bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Pendaftaran Online</h2>
                    <p class="text-muted">Daftar berobat lebih mudah dan
                        cepat, tanpa antre lama.</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0 p-4 p-md-5">
                            <form class="row g-3" action="daftarPasien.php" method="post">
                                <div class="col-md-12">
                                    <label for="nama"
                                        class="form-label">Nama
                                        Lengkap</label>
                                    <input type="text"
                                        class="form-control form-control-lg"
                                        id="nama" name="nama"
                                        placeholder="Masukkan nama lengkap Anda"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nik" class="form-label">NIK
                                        (No. KTP)</label>
                                    <input type="text"
                                        class="form-control form-control-lg"
                                        id="nik" name="nik" placeholder="16 digit NIK"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="bpjs" class="form-label">No.
                                        BPJS (jika ada)</label>
                                    <input type="text"
                                        class="form-control form-control-lg"
                                        id="bpjs" name="bpjs"
                                        placeholder="Nomor kartu BPJS">
                                </div>
                                <div class="col-md-6">
                                    <label for="poli"
                                        class="form-label">Pilih Poli
                                        Tujuan</label>
                                    <select id="poli" name="poli"
                                        class="form-select form-select-lg"
                                        required>
                                        <option value selected disabled>--
                                            Pilih Poli --</option>
                                            <?php
                                            include 'connection.php';
                                            $query = "SELECT poli FROM dokter GROUP BY poli";
                                            $result = $connect->query($query);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <option><?=$row['poli']?></option>
                                                <?php
                                                }
                                            } else {
                                                echo "<option>Tidak ada poli tersedia</option>";
                                            }   
                                            ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal"
                                        class="form-label">Tanggal
                                        Berobat</label>
                                    <input type="date"
                                        class="form-control form-control-lg"
                                        id="tanggal" name="tanggal_berobat" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Prioritas</label>
                                        <div class="d-flex gap-4 align-items-center flex-wrap">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="emergencyDarurat" name="status" value="Emergency">
                                                <label class="form-check-label" for="emergencyDarurat">Darurat</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="emergencyUrgent" name="status" value="Urgent">
                                                <label class="form-check-label" for="emergencyUrgent">Segera</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="emergencyRutin" name="status" value="Rutin" checked>
                                                <label class="form-check-label" for="emergencyRutin">Rutin</label>
                                            </div>
                                        </div>
                                </div>

                                <div class="col-12 text-center mt-4">
                                    <button type="submit"
                                        class="btn" style="background-color: #0f766e; border-color: #0f766e; color: white; border-radius: 100px;";>Daftar
                                        Sekarang</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
    </body>
</html>
