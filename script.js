// Menunggu hingga seluruh konten halaman dimuat sebelum menjalankan skrip
document.addEventListener('DOMContentLoaded', function () {

    /**
     * EFEK NAVIGASI SAAT SCROLL
     * Menambahkan bayangan (shadow) pada navbar ketika halaman di-scroll ke bawah.
     * Ini memberikan indikasi visual bahwa navbar tidak lagi berada di bagian paling atas halaman.
     */
    const navbar = document.querySelector('#navbarPuskesmas');
    if (navbar) {
        // Fungsi untuk menambahkan atau menghapus shadow
        const handleScroll = () => {
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-lg');
            } else {
                navbar.classList.remove('shadow-lg');
            }
        };

        // Tambahkan event listener saat halaman di-scroll
        window.addEventListener('scroll', handleScroll);
        
        // Panggil sekali saat memuat untuk memeriksa posisi awal
        handleScroll(); 
    }


    /**
     * NAVIGASI AKTIF SAAT SCROLL (SCROLLSPY)
     * Secara otomatis menyorot menu navigasi yang sesuai dengan bagian (section)
     * yang sedang ditampilkan di layar pada halaman utama.
     */
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    const sections = document.querySelectorAll('main section');

    // Hanya jalankan jika ada tautan navigasi dan sections di halaman
    if (navLinks.length > 0 && sections.length > 1) { // Lebih dari 1 section menandakan ini halaman utama
        const activateNavLink = () => {
            let currentSectionId = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100; // Offset agar aktivasi lebih pas
                const sectionHeight = section.clientHeight;
                if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                    currentSectionId = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                // Href di link (cth: '#layanan') harus cocok dengan id section
                if (link.getAttribute('href').substring(1) === currentSectionId) {
                    link.classList.add('active');
                }
            });
        };
        
        window.addEventListener('scroll', activateNavLink);
        activateNavLink(); // Panggil saat memuat untuk mengaktifkan link awal
    }


    /**
     * VALIDASI FORMULIR
     * Mengaktifkan validasi bawaan Bootstrap 5 pada formulir pendaftaran dan pemesanan kamar.
     * Formulir akan menampilkan umpan balik visual (hijau jika valid, merah jika tidak) setelah pengguna
     * mencoba mengirimkan data.
     */
    const forms = document.querySelectorAll('form');

    // Lakukan loop pada setiap formulir dan cegah pengiriman default
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });


    /**
     * KALKULASI DINAMIS BIAYA KAMAR
     * Menghitung dan memperbarui ringkasan transaksi secara real-time
     * berdasarkan pilihan kelas kamar dan status kepemilikan BPJS.
     */
    const formPemesanan = document.getElementById('formPemesanan');

    // Hanya jalankan skrip ini jika formulir pemesanan ada di halaman
    if (formPemesanan) {

        const hargaKamar = {
            "Kelas 1": 500000,
            "Kelas 2": 300000,
            "Kelas 3": 150000,
            "VIP/VVIP": 1000000,
        };
        const BIAYA_ADMIN = 5500;

        const poliSelect = document.getElementById('poli');
        const bpjsInput = document.getElementById('bpjs');
        const biayaKamarDisplay = document.getElementById('biayaKamarDisplay');
        const biayaAdminDisplay = document.getElementById('biayaAdminDisplay');
        const totalTagihanDisplay = document.getElementById('totalTagihanDisplay');

        const formatRupiah = (angka) => {
            return 'Rp' + new Intl.NumberFormat('id-ID').format(angka);
        }

        const updateRingkasan = () => {
            const selectedKamar = poliSelect.value;
            const hasBPJS = bpjsInput.value.trim() !== '';

            let biayaKamar = hargaKamar[selectedKamar] || 0;
            let biayaKamarText = formatRupiah(biayaKamar);

            const isKelas2or3 = (selectedKamar === 'Kelas 2' || selectedKamar === 'Kelas 3');
            
            if (hasBPJS && isKelas2or3) {
                biayaKamar = 0;
                biayaKamarText = 'Gratis (Ditanggung BPJS)';
            }

            const totalTagihan = biayaKamar + BIAYA_ADMIN;

            biayaKamarDisplay.textContent = biayaKamarText;
            biayaAdminDisplay.textContent = formatRupiah(BIAYA_ADMIN);
            totalTagihanDisplay.textContent = formatRupiah(totalTagihan);
        };

        poliSelect.addEventListener('change', updateRingkasan);
        bpjsInput.addEventListener('input', updateRingkasan);

        updateRingkasan();
    }

});