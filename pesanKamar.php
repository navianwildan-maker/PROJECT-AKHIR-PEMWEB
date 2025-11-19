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
        body {
            background-color: white;
        }
        .warna-bg {
            background-color: #0f766e;
            background-image: linear-gradient(135deg, #14b8a6 0%, #097168 100%);
        }
        .section-padding {
            padding: 10rem 0;
            padding-bottom: 5rem; 
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
        .list-group-item-action {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>

</head>
<body>

    <nav id="navbarPuskesmas"
        class="navbar navbar-expand-lg navbar-light bg-white shadow-lg fixed-top"
        aria-label="Puskesmas Navbar">
        <div class="container">
            <img style="padding-left: 2%;" width="90"
                src="logo puskesmas nusantara.png" alt="Logo Puskesmas">
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
                    <a href="pendaftaranPuskesmas.php" class="btn nav-link"
                        style="background-color: #0f766e; border-color: #0f766e; color: white; border-radius: 100px; padding: 1%">Pendaftaran
                        Online</a>
                </div>
            </div>
        </div>
    </nav>

    <section id="pesanKamar" class="section-padding bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Pesan Kamar Online</h2>
                <p class="text-muted">Pesan kamar lebih mudah dan
                    cepat, tanpa antre lama.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    
                    <div class="card shadow-lg border-0 p-4 p-md-5 rounded-5">
                        <form class="row g-3" id="formPemesanan">
                            <div class="col-md-12">
                                <label for="nama"
                                    class="form-label">Nama
                                    Lengkap</label>
                                <input type="text"
                                    class="form-control form-control-lg"
                                    id="nama"
                                    placeholder="Masukkan nama lengkap Anda"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="nik" class="form-label">NIK
                                    (No. KTP)</label>
                                <input type="text"
                                    class="form-control form-control-lg"
                                    id="nik" placeholder="16 digit NIK"
                                    required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="bpjs" class="form-label">No.
                                    BPJS (jika ada)</label>
                                <input type="text"
                                    class="form-control form-control-lg"
                                    id="bpjs"
                                    placeholder="Nomor kartu BPJS">
                            </div>

                            <div class="col-md-6">
                                <label for="poli"
                                    class="form-label">Pilih Kelas Kamar</label>
                                <select id="poli"
                                    class="form-select form-select-lg"
                                    required>
                                    <option value="" selected disabled>-- Pilih Kamar --</option>
                                    <option value="Kelas 1">Kelas 1 (Rp500.000/hari)</option>
                                    <option value="Kelas 2">Kelas 2 (Rp300.000/hari)</option>
                                    <option value="Kelas 3">Kelas 3 (Rp150.000/hari)</option>
                                    <option value="VIP/VVIP">VIP/VVIP (Rp1.000.000/hari)</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="tanggal"
                                    class="form-label">Tanggal
                                    Pemesanan</label>
                                <input type="date"
                                    class="form-control form-control-lg"
                                    id="tanggal" required>
                            </div>
                        
                            <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
                            <h5 class="mb-0 fw-bold">Metode Pembayaran</h5>
                        </div>
                
                        <div class="card shadow-sm border-0 rounded-5">
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush">
                                    
                                    <label for="mandiriVA" class="list-group-item list-group-item-action py-3 px-3">
                                        <div class="d-flex align-items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/1200px-Bank_Mandiri_logo_2016.svg.png" alt="Mandiri" style="width: 50px;" class="me-3">
                                            <span class="fw-medium">Mandiri Virtual Account</span>
                                        </div>
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="mandiriVA">
                                    </label>
                
                                    <label for="bcaVA" class="list-group-item list-group-item-action py-3 px-3">
                                        <div class="d-flex align-items-center">
                                            <img src="Logo-BCA-PNG.png" alt="BCA" style="width: 50px;" class="me-3">
                                            <span class="fw-medium">BCA Virtual Account</span>
                                        </div>
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="bcaVA" checked>
                                    </label>
                
                                    <label for="alfamart" class="list-group-item list-group-item-action py-3 px-3">
                                        <div class="d-flex align-items-center">
                                            <img src="BRI_2020.svg.png" alt="BRI" style="width: 50px;" class="me-3">
                                            <span class="fw-medium">BRI Virtual Account</span>
                                        </div>
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="briVA">
                                    </label>
                                </div>
                            </div>
                        </div>
                

                        <div class="card shadow-sm border-0 rounded-5 mt-3">
                            <div class="card-body p-4">
                                <h5 class="fw-bold small mb-2">Cek ringkasan transaksi</h5>
                                
                                <div class="d-flex justify-content-between text-muted">
                                    <span>Biaya Kamar</span>
                                    <span id="biayaKamarDisplay">Rp0</span>
                                </div>
                                <div class="d-flex justify-content-between text-muted">
                                    <span>Biaya Admin</span>
                                    <span id="biayaAdminDisplay">Rp5.500</span>
                                </div>
                    
                                <hr class="my-2">
                    
                                <div class="d-flex justify-content-between align-items-center fw-bold fs-5 mb-2">
                                    <span>Total Tagihan</span>
                                    <span id="totalTagihanDisplay">Rp5.500</span>
                                </div>
                    
                                <button type="submit"
                                    class="btn btn-lg w-100 fw-bold d-flex align-items-center justify-content-center py-2"
                                    style="background-color: #0f766e; border-color: #0f766e; color: white;">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    <span>Bayar Sekarang</span>
                                </button>
                    
                                <div class="text-center text-muted mt-2" style="font-size: 0.8rem;">
                                    Dengan melanjutkan pembayaran, kamu menyetujui S&K
                                    <a href="#" class="text-success fw-bold text-decoration-none">Layanan Puskesmas</a>.
                                </div>
                            </div>
                        </div>
                        </form> </div>
            </div>
        </div>
    </section>

        <footer class="bg-dark text-white py-4">
            <div class="container text-center">
                <p class="mb-0">&copy; 2025 Puskesmas Nusantara. Semua Hak
                    Cipta Dilindungi.</p>
                <p class="text-white-50 small mb-0">Website ini dibuat untuk
                    tujuan tugas akhir.</p>
            </div>
        </footer>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>
    
    <script src="script.js"></script>

</body>
</html>