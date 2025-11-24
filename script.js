// Menunggu hingga seluruh konten halaman dimuat sebelum menjalankan skrip
document.addEventListener('DOMContentLoaded', function () {

    const navbar = document.querySelector('#navbarPuskesmas');
    if (navbar) {
        const handleScroll = () => {
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-lg');
            } else {
                navbar.classList.remove('shadow-lg');
            }
        };
        window.addEventListener('scroll', handleScroll);
        
        handleScroll(); 
    }

    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    const sections = document.querySelectorAll('main section');

    if (navLinks.length > 0 && sections.length > 1) { 
        const activateNavLink = () => {
            let currentSectionId = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100; 
                const sectionHeight = section.clientHeight;
                if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                    currentSectionId = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').substring(1) === currentSectionId) {
                    link.classList.add('active');
                }
            });
        };
        
        window.addEventListener('scroll', activateNavLink);
        activateNavLink(); 
    }

    const forms = document.querySelectorAll('form');

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });


    const formPemesanan = document.getElementById('formPemesanan');

    if (formPemesanan) {

        const hargaKamar = {
            "Kelas 1": 500000,
            "Kelas 2": 300000,
            "Kelas 3": 150000,
            "VIP/VVIP": 1000000,
        };
        const BIAYA_ADMIN = 5500;

        const kamarSelect = document.getElementById('kamar');
        const bpjsInput = document.getElementById('bpjs');
        const biayaKamarDisplay = document.getElementById('biayaKamarDisplay');
        const biayaAdminDisplay = document.getElementById('biayaAdminDisplay');
        const totalTagihanDisplay = document.getElementById('totalTagihanDisplay');

        if (!kamarSelect || !bpjsInput || !biayaKamarDisplay || !biayaAdminDisplay || !totalTagihanDisplay) {
            console.error('Elemen form pemesanan tidak ditemukan.');
            return;
        }

        const formatRupiah = (angka) => {
            return 'Rp' + new Intl.NumberFormat('id-ID').format(angka);
        }

        const updateRingkasan = () => {
            const selectedKamar = kamarSelect.value;
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

        kamarSelect.addEventListener('change', updateRingkasan);
        bpjsInput.addEventListener('input', updateRingkasan);

        updateRingkasan();
    }

});