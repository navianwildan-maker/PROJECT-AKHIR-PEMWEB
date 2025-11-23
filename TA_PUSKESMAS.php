<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-R">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puskesmas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/x-icon" href="logo puskesmas nusantara.png">
    <style>
        body {
            background-color: white;
        }

        .warna-bg {
            background-color: #0f766e;
            background-image: linear-gradient(135deg, #14b8a6 0%, #097168 100%);
        }

        .section-padding {
            padding: 6rem 0;
        }

        body {
            padding-top: 70px;
        }

        .icon {
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
    <!--navbarrr-->
    <nav id="navbarPuskesmas" class="navbar navbar-expand-lg navbar-light bg-white shadow-lg fixed-top"
        aria-label="Puskesmas Navbar">
        <div class="container">
            <img style="padding-left: 2%;" width="90" src="logo puskesmas nusantara.png">
            <a class="navbar-brand" href="#"
                style="font-weight: bold; padding-top: 1%; padding-bottom: 1%; padding-left: 1%;">Puskesmas
                Nusantara</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPuskesmas"
                aria-controls="navbarPuskesmas" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Mobile Menu -->
            <div class="collapse navbar-collapse" id="navbarPuskesmas">

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#profil-pks">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#jadwal" aria-disabled="true">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak" aria-expanded="false">Kontak</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pesanKamar" aria-expanded="false">Pesan kamar</a>
                    </li>
                </ul>

                <div class="btn btn-light rounded-pill px-1 py-1 me-1">
                    <a href="pendaftaranPuskesmas.php" class="btn nav-link"
                        style="background-color: #0f766e; border-color: #0f766e; color: white; border-radius: 100px; padding: 1%;">Pendaftaran
                        Online</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <!--beranda-->
        <section id="beranda" class="warna-bg text-white">
            <div class="container text-center py-5">
                <h1 class="tdisplay-4 fw-bold mb-3" style="padding-top: 10%;">Melayani Masyarakat, Untuk Hidup Lebih
                    Sehat</h1>
                <p class="fs-5 text-white-50 mb-4 mx-auto" style="max-width: 700px; padding: 2%;">Kami berkomitmen
                    memberikan pelayanan kesehatan terbaik untuk Anda dan keluarga, mulai dari upaya menjaga agar tetap
                    sehat, mencegah penyakit, mengobati, hingga pemulihan.</p>
                <div style="padding-bottom: 6%;">
                    <a href="pendaftaranPuskesmas.php" class="btn btn-light btn-lg rounded-pill px-5 py-3 me-3">Daftar
                        Berobat</a>
                    <a href="#layanan" class="btn btn-outline-light btn-lg rounded-pill px-5 py-3">Lihat Layanan</a>
                </div>
            </div>
        </section>

        <!--profil puskesmas-->
        <section id="profil-pks" class="section-padding">
            <div class="container">
                <div class="text-center mb-5">
                    <h1 class="fw-bold text-teal-900">Profil Puskesmas Nusantara</h1>
                    <p class="text-muted">Mengenal Lebih Dekat Tentang Puskesmas</p>
                </div>
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <img src="puskusmas1.jpeg" alt="Gedung Puskesmas" class="img-fluid rounded-5 shadow-lg ">
                    </div>
                    <div class="col-lg-6">
                        <h3 class="fw-semibold mb-3">Visi & Misi</h3>
                        <p class="text-muted"><strong class="text-dark">Visi:</strong> Menjadi pusat kesehatan
                            masyarakat yang efektif, efisien, dan berkualitas untuk mewujudkan derajat kesehatan
                            masyarakat yang setinggi-tingginya.
                        </p>
                        <p class="text-muted mb-3"><strong class="text-dark">Misi:</strong></p>
                        <ul>
                            <p class="mb-2 text-muted"><img width="15" src="point.png"></i> Memberikan pelayanan
                                kesehatan yang bermutu.</p>
                            <p class="mb-2 text-muted"><img width="15" src="point.png"></i> Menggerakkan pembangunan
                                berwawasan kesehatan.</p>
                            <p class="mb-2 text-muted"><img width="15" src="point.png"></i> Mendorong masyarakat untuk
                                berperilaku hidup bersih dan sehat, serta meningkatkan kemandirian melalui pemberdayaan.
                            </p>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!--LAYANAN UNGGULAN-->
        <section id="layanan" class="section-padding bg-white">
            <a></a>
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Layanan Unggulan</h2>
                    <p class="text-muted">Berbagai layanan kesehatan untuk memenuhi kebutuhan Anda.</p>
                </div>
                <div class="row g-4">
                    <!--1-->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-lg border-0 text-center p-4 rounded-5">
                            <div class="icon mx-auto mb-3">
                                <i class="bi bi-file-earmark-medical"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-semibold">Poli Umum</h5>
                                <p class="card-text text-muted">Pemeriksaan dan pengobatan penyakit umum untuk semua
                                    usia oleh dokter berpengalaman.</p>
                            </div>
                        </div>
                    </div>
                    <!--2-->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-lg border-0 text-center p-4 rounded-5">
                            <div class="icon mx-auto mb-3">
                                <i class="bi bi-file-earmark-medical"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-semibold">Poli Gigi</h5>
                                <p class="card-text text-muted">Perawatan kesehatan gigi dan mulut, mulai dari
                                    pemeriksaan, penambalan, hingga pencabutan gigi.</p>
                            </div>
                        </div>
                    </div>
                    <!--3-->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-lg border-0 text-center p-4 rounded-5">
                            <div class="icon mx-auto mb-3">
                                <i class="bi bi-heart-pulse"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-semibold">Kesehatan Ibu & Anak</h5>
                                <p class="card-text text-muted">Layanan komprehensif untuk ibu hamil, nifas, serta
                                    tumbuh kembang balita dan imunisasi.</p>
                            </div>
                        </div>
                    </div>
                    <!-- 4 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-lg border-0 text-center p-4 rounded-5">
                            <div class="icon mx-auto mb-3">
                                <i class="bi bi-eyedropper"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-semibold">Laboratorium</h5>
                                <p class="card-text text-muted">Pemeriksaan penunjang seperti tes darah, urin, dan
                                    lainnya untuk membantu diagnosis penyakit.</p>
                            </div>
                        </div>
                    </div>
                    <!-- 5 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-lg border-0 text-center p-4 rounded-5">
                            <div class="icon mx-auto mb-3">
                                <i class="bi bi-shield-plus"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-semibold">Vaksinasi & Imunisasi</h5>
                                <p class="card-text text-muted">Menyediakan layanan imunisasi dasar lengkap untuk bayi
                                    dan balita serta vaksinasi dewasa.</p>
                            </div>
                        </div>
                    </div>
                    <!--6-->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-lg border-0 text-center p-4 rounded-5">
                            <div class="icon mx-auto mb-3">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-semibold">Konseling Kesehatan</h5>
                                <p class="card-text text-muted">konsultasi gizi, sanitasi, dan masalah kesehatan lainnya
                                    bersama tenaga ahli kami.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!--JADWAL DOKTER-->
        <section id="jadwal" class="section-padding">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Jadwal Pelayanan Dokter</h2>
                    <p class="text-muted">Rencanakan kunjungan Anda sesuai jadwal praktik dokter kami.</p>
                </div>
                <div class="table-responsive shadow-lg rounded-4">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="p-3">Nama Dokter</th>
                                <th scope="col" class="p-3">Poli</th>
                                <th scope="col" class="p-3">Hari</th>
                                <th scope="col" class="p-3">Jam Praktik</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <?php
                        include 'connection.php';
                        $sql = "SELECT
                        D.nama, D.poli, GROUP_CONCAT(J.hari_praktik ORDER BY FIELD
                        (J.hari_praktik, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')
                            SEPARATOR ',') AS Daftar_Hari_Mentah,
                        CONCAT(
                            TIME_FORMAT(MIN(J.jam_mulai), '%H:%i'), ' - ', 
                            TIME_FORMAT(MAX(J.jam_selesai), '%H:%i'),' WITA' 
                        ) AS jam_praktik FROM Dokter D JOIN Jadwal_Dokter J  ON D.id_dokter = J.id_dokter 
                        GROUP BY D.id_dokter, D.nama, D.poli ORDER BY D.id_dokter;";

                        function formatJadwalHari(string $dayList): string
                        {
                            
                            $dayMap = [
                                'Senin' => 1,
                                'Selasa' => 2,
                                'Rabu' => 3,
                                'Kamis' => 4,
                                'Jumat' => 5,
                                'Sabtu' => 6,
                                'Minggu' => 7
                            ];

                            // Pisahkan string menjadi array
                            $days = explode(',', $dayList);
                            $count = count($days);

                            // Hanya ada 1 atau 2 hari, tidak mungkin jadi rentang.
                            if ($count <= 2) {
                                return implode(' & ', $days);
                            }

                            //Cek Urutan
                            $isSequential = true;
                            $prevIndex = 0; 
                        
                            for ($i = 0; $i < $count; $i++) {
                                $currentIndex = $dayMap[$days[$i]] ?? 0; // Ambil indeks numerik hari saat ini
                        
                                if ($i > 0) {
                                    // Cek apakah selisih antara hari saat ini dan sebelumnya adalah 1
                                    if ($currentIndex - $prevIndex != 1) {
                                        $isSequential = false;
                                        break; 
                                    }
                                }
                                $prevIndex = $currentIndex;
                            }

                            //Format Output
                            if ($isSequential) {
                                $firstDay = $days[0];
                                $lastDay = $days[$count - 1];

                                return "$firstDay - $lastDay";

                            } else {
                                return implode(' & ', $days);
                            }
                        }

                        $result = mysqli_query($connect, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $formattedDay = formatJadwalHari($row['Daftar_Hari_Mentah']);
                                ?>
                                
                                <tr>
                                <td class='p-3'><?=$row['nama'] ?></td>
                                <td class='p-3'><?=$row['poli'] ?></td>
                                <td class='p-3'><?=$formattedDay ?></td>
                                <td class='p-3'><?=$row['jam_praktik'] ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        <?php
                        } else {
                            echo "<tbody><tr><td colspan='4' class='p-3 text-center'>Tidak ada jadwal dokter tersedia.</td></tr></tbody>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </section>
        <!--pesan kamar-->
        <section id="pesanKamar" class="section-padding">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Kamar Rawat Inap</h2>
                    <p class="text-muted">Untuk orang-orang yang memiliki keluhan/penyakit khusus.</p>
                </div>
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <img src="KamarPuskesmas.jpg" alt="Pesan Kamar" class="img-fluid rounded-5 shadow-lg ">
                    </div>
                    <div class="col-lg-6">
                        <p class="text-muted">Kami menyediakan kamar rawat inap sesuai kategori 1-3 dengan fasilitas
                            yang berbeda.
                        </p>
                        <a href="pesanKamar.php"
                            class="btn btn-outline-success btn-lg rounded-pill px-sm-5 py-3 me-3">Pesan Kamar</a>
                    </div>
                </div>
            </div>
        </section>

        <!--KONTAK-->
        <section id="kontak" class="section-padding">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Hubungi Kami</h2>
                    <p class="text-muted">Kami siap membantu Anda kapan pun.</p>
                </div>
                <div class="row g-5">
                    <div class="col-lg-6">
                        <div class="card shadow-lg border-0 h-100 p-4 rounded-5">
                            <h3 class="fw-semibold mb-4">Informasi Kontak</h3>
                            <ul class="list-unstyled text-muted">
                                <li class="d-flex align-items-start mb-3">
                                    <i class="bi bi-geo-alt-fill fs-4 icon me-3"></i>
                                    <div>
                                        <strong>Alamat:</strong><br>2MFX+J29, Pemaluan, Kec. Sepaku, Kabupaten Penajam
                                        Paser Utara, Kalimantan Timur
                                    </div>
                                </li>
                                <li class="d-flex align-items-start mb-3">
                                    <i class="bi bi-telephone-fill fs-4 icon me-3"></i>
                                    <div>
                                        <strong>Telepon:</strong><br>
                                        (029) 123-240244
                                    </div>
                                </li>
                                <li class="d-flex align-items-start mb-3">
                                    <i class="bi bi-envelope-fill fs-4 icon me-3"></i>
                                    <div>
                                        <strong>Email:</strong><br>
                                        info@puskesmas-nusantara.go.id
                                    </div>
                                </li>
                                <li class="d-flex align-items-start mb-3">
                                    <i class="bi bi-clock-fill fs-4 icon me-3"></i>
                                    <div>
                                        <strong>Jam Pelayanan:</strong><br>
                                        Senin - Sabtu: 07:30 - 15:00 WITA<br>
                                        Unit Gawat Darurat (UGD): 24 Jam
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shadow-lg rounded-5 overflow-hidden h-100">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.2395232747176!2d116.69760819999999!3d-0.9759542999999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df6cf0037d87f37%3A0x607cf86ca51d4aeb!2sPuskesmas%20Nusantara!5e0!3m2!1sid!2sid!4v1762149950472!5m2!1sid!2sid"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 Puskesmas Nusantara. Semua Hak
                Cipta Dilindungi.</p>
            <p class="text-white-50 small mb-0">Website ini dibuat untuk
                tujuan demonstrasi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"
        xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">

        </script>
</body>

</html>