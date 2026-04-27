<?php
// Data passed from PageController

// Build project-aware asset URL (works on localhost and subfolder deployment)
$script_dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$base_path = ($script_dir === '/' || $script_dir === '.') ? '' : rtrim($script_dir, '/');
$homepage_asset = ($base_path ?: '') . '/assets/homepage.webp';

$galeri_files = [
    '1776647661_0_1776331109_0_1775453706_k.renang_anak_60cm.webp',
    '1775452715_gazebo 7-20.webp',
    '1775453181_gazebo 21.webp',
    '1775453508_mushola.webp',
    '1775453583_kantin.webp',
    '1775453018_aula.webp'
];

$galeri_fasilitas = array_map(static function ($file) use ($base_path) {
    return ($base_path ?: '') . '/image_tss/' . rawurlencode($file);
}, $galeri_files);

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="icon" type="image/webp" href="/assets/logo.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Umum - Taman Salma Shofa</title>
    <meta name="description" content="Informasi umum, sejarah, visi misi, dan galeri foto Taman Salma Shofa Samarinda. Tempat rekreasi keluarga pilihan sejak 2006.">
    <meta name="keywords" content="sejarah taman salma shofa, info wisata samarinda, galeri taman salma shofa, taman wisata keluarga">
    <meta name="author" content="Taman Salma Shofa">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-[#FAFAFB] text-gray-800 flex flex-col min-h-screen">

    <?php require_once dirname(__DIR__) . '/shared/includes/navbar.php'; ?>

    <section class="max-w-[1200px] mx-auto pt-[100px] pb-16 md:pb-24">
        <div class="flex flex-col lg:flex-row items-center gap-16">

            <div class="w-full lg:w-1/2">
                <span class="inline-block bg-[#FEF0E6] text-[#E88D57] px-4 py-1.5 rounded-full text-[11px] font-bold uppercase tracking-widest mb-6">
                    Sejarah & Rekreasi
                </span>
                <h1 class="text-[36px] md:text-[44px] font-extrabold text-[#1a1a24] leading-tight mb-6">
                    Tentang Taman Salma Shofa
                </h1>
                <div class="text-gray-600 text-[15px] leading-[1.8] space-y-4 mb-8">
                    <p>
                        Taman Salma Shofa merupakan tempat rekreasi keluarga yang telah beroperasi sejak tahun 2006. Awalnya tempat ini merupakan area kebun dan ruang pamer tanaman hias yang kemudian berkembang menjadi tempat rekreasi kolam renang dan tempat berkumpul bagi masyarakat pada tahun 2010.
                    </p>
                    <p>
                        Tempat ini terletak sekitar 4,5 km dari gerbang Mugirejo dan terus berkembang menjadi salah satu alternatif wisata keluarga di Samarinda.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-6 text-[14px] font-semibold text-[#1a1a24]">
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-[#E88D57] text-[18px]"></i>
                        Beroperasi Sejak 2006
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-people-roof text-[#E88D57] text-[18px]"></i>
                        Ramah Keluarga
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 relative">
                <div class="absolute inset-0 bg-[#E88D57] blur-[60px] opacity-30 rounded-[30px] transform scale-95"></div>

                <img src="<?= htmlspecialchars($homepage_asset, ENT_QUOTES, 'UTF-8') ?>"
                    onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80'"
                    alt="Tentang Taman Salma Shofa"
                    class="relative z-10 w-full h-[350px] md:h-[450px] object-cover rounded-[30px] shadow-xl">
            </div>

        </div>
    </section>

    <section class="max-w-[1200px] mx-auto pb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="bg-white rounded-2xl p-8 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.08)] border-t-[5px] border-[#E88D57] flex gap-5 items-start">
                <div class="w-14 h-14 shrink-0 bg-[#FEF0E6] rounded-xl flex items-center justify-center text-[#E88D57] text-[24px]">
                    <i class="fa-regular fa-lightbulb"></i>
                </div>
                <div>
                    <h3 class="text-[20px] font-bold text-[#1a1a24] mb-3">Visi Kami</h3>
                    <p class="text-gray-500 text-[14px] leading-relaxed">
                        Menjadi rahim lahirnya ide-ide produktif, kreatif & inovatif demi kemajuan kota Samarinda dengan menyediakan ruang yang menginspirasi setiap pengunjung.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.08)] border-t-[5px] border-[#2B2B43] flex gap-5 items-start">
                <div class="w-14 h-14 shrink-0 bg-[#F4F4F6] rounded-xl flex items-center justify-center text-[#2B2B43] text-[20px]">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <h3 class="text-[20px] font-bold text-[#1a1a24] mb-3">Nilai Kami</h3>
                    <p class="text-gray-500 text-[14px] leading-relaxed">
                        Dibangun di atas semangat kekeluargaan, gotong royong, dan rasa memiliki kolektif yang menjadi motor penggerak utama dalam melayani masyarakat.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <div class="max-w-[1400px] mx-auto px-12 md:px-24 pb-24">
        <div class="mb-8 flex items-center gap-3">
            <div class="w-2 h-6 bg-[#E88D57] rounded-full"></div>
            <h3 class="text-[20px] font-bold text-[#1a1a24]">Galeri</h3>
        </div>

        <div id="galeriCarousel" class="overflow-hidden rounded-2xl shadow-md bg-gray-100 border border-gray-100">
            <div id="galeriTrack" class="flex transition-transform duration-700 ease-in-out">
                <?php foreach ($galeri_fasilitas as $index => $src): ?>
                    <figure class="galeri-slide m-0 w-full shrink-0 basis-full">
                        <img src="<?= htmlspecialchars($src, ENT_QUOTES, 'UTF-8') ?>"
                            alt="Galeri Fasilitas <?= $index + 1 ?>"
                            loading="lazy"
                            class="w-full h-[220px] md:h-[540px] object-cover">
                    </figure>
                <?php endforeach; ?>
            </div>
        </div>

        <div id="galeriDots" class="flex items-center justify-center gap-2 mt-5">
            <?php foreach ($galeri_fasilitas as $index => $src): ?>
                <button type="button"
                    class="galeri-dot w-2.5 h-2.5 rounded-full transition-all <?= $index === 0 ? 'bg-[#E88D57] scale-110' : 'bg-gray-300 hover:bg-gray-400' ?>"
                    data-slide="<?= $index ?>"
                    aria-label="Pindah ke slide <?= $index + 1 ?>"></button>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            const carousel = document.getElementById('galeriCarousel');
            const track = document.getElementById('galeriTrack');
            const dots = Array.from(document.querySelectorAll('.galeri-dot'));
            if (!carousel || !track) {
                return;
            }

            const slides = Array.from(track.querySelectorAll('.galeri-slide'));
            if (slides.length <= 1) {
                return;
            }

            let currentIndex = 0;
            let timerId = 10;

            function updateDots() {
                dots.forEach(function(dot, index) {
                    const active = index === currentIndex;
                    dot.classList.toggle('bg-[#E88D57]', active);
                    dot.classList.toggle('scale-110', active);
                    dot.classList.toggle('bg-gray-300', !active);
                    dot.classList.toggle('hover:bg-gray-400', !active);
                });
            }

            function goToSlide(index) {
                currentIndex = (index + slides.length) % slides.length;
                track.style.transform = `translateX(-${currentIndex * 100}%)`;
                updateDots();
            }

            function startAutoSlide() {
                if (timerId) {
                    window.clearInterval(timerId);
                }

                timerId = window.setInterval(function() {
                    goToSlide(currentIndex + 1);
                }, 3000);
            }

            function updatePosition() {
                goToSlide(currentIndex);
            }

            dots.forEach(function(dot) {
                dot.addEventListener('click', function() {
                    const target = Number(dot.dataset.slide || 0);
                    goToSlide(target);
                    startAutoSlide();
                });
            });

            carousel.addEventListener('mouseenter', function() {
                if (timerId) {
                    window.clearInterval(timerId);
                    timerId = null;
                }
            });

            carousel.addEventListener('mouseleave', function() {
                startAutoSlide();
            });

            window.addEventListener('resize', updatePosition);
            goToSlide(0);
            updatePosition();
            startAutoSlide();
        });
    </script>

    <section class="bg-white border-y border-gray-200 py-20 px-6 md:px-12 w-full">
        <div class="max-w-[1200px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24">

            <div>
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-10 h-1 bg-[#E88D57] rounded-full"></div>
                    <h2 class="text-[#1a1a24] text-[18px] font-bold tracking-widest uppercase">Keunggulan Kami</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="bg-[#2B2B43] p-6 rounded-[16px] hover:-translate-y-1 transition-transform shadow-lg">
                        <i class="fa-regular fa-face-smile text-white text-[24px] mb-4"></i>
                        <h4 class="text-white font-bold text-[15px] mb-2">Ramah Semua Usia</h4>
                        <p class="text-white/80 text-[13px] leading-relaxed">Fasilitas yang dirancang aman dan nyaman untuk anak-anak hingga lansia.</p>
                    </div>
                    <div class="bg-[#2B2B43] p-6 rounded-[16px] hover:-translate-y-1 transition-transform shadow-lg">
                        <i class="fa-solid fa-utensils text-white text-[24px] mb-4"></i>
                        <h4 class="text-white font-bold text-[15px] mb-2">Bawa Makanan Luar</h4>
                        <p class="text-white/80 text-[13px] leading-relaxed">Kebebasan membawa bekal favorit keluarga untuk dinikmati di area taman.</p>
                    </div>
                    <div class="bg-[#2B2B43] p-6 rounded-[16px] hover:-translate-y-1 transition-transform shadow-lg">
                        <i class="fa-solid fa-graduation-cap text-white text-[24px] mb-4"></i>
                        <h4 class="text-white font-bold text-[15px] mb-2">Rekreasi & Edukasi</h4>
                        <p class="text-white/80 text-[13px] leading-relaxed">Paduan sempurna antara hiburan dan pembelajaran di lingkungan alam.</p>
                    </div>
                    <div class="bg-[#2B2B43] p-6 rounded-[16px] hover:-translate-y-1 transition-transform shadow-lg">
                        <i class="fa-solid fa-tree text-white text-[24px] mb-4"></i>
                        <h4 class="text-white font-bold text-[15px] mb-2">Lingkungan Asri</h4>
                        <p class="text-white/80 text-[13px] leading-relaxed">Suasana alami yang rimbun dan tenang, jauh dari hiruk-pikuk kota.</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-10 h-1 bg-[#E88D57] rounded-full"></div>
                    <h2 class="text-[#1a1a24] text-[18px] font-bold tracking-widest uppercase">Aktivitas & Pengalaman</h2>
                </div>

                <div class="bg-[#2B2B43] rounded-[16px] p-8 flex flex-col gap-8 shadow-lg">
                    <div class="flex items-center gap-5">
                        <div class="w-[45px] h-[45px] rounded-full bg-white/25 flex items-center justify-center text-white text-[18px] shrink-0">
                            <i class="fa-solid fa-person-swimming"></i>
                        </div>
                        <span class="text-white text-[15px] font-medium">Berenang di berbagai jenis kolam</span>
                    </div>
                    <div class="flex items-center gap-5">
                        <div class="w-[45px] h-[45px] rounded-full bg-white/25 flex items-center justify-center text-white text-[18px] shrink-0">
                            <i class="fa-solid fa-people-group"></i>
                        </div>
                        <span class="text-white text-[15px] font-medium">Berkumpul bersama keluarga tercinta</span>
                    </div>
                    <div class="flex items-center gap-5">
                        <div class="w-[45px] h-[45px] rounded-full bg-white/25 flex items-center justify-center text-white text-[18px] shrink-0">
                            <i class="fa-regular fa-calendar-check"></i>
                        </div>
                        <span class="text-white text-[15px] font-medium">Mengadakan acara atau gathering komunitas</span>
                    </div>
                    <div class="flex items-center gap-5">
                        <div class="w-[45px] h-[45px] rounded-full bg-white/25 flex items-center justify-center text-white text-[18px] shrink-0">
                            <i class="fa-solid fa-person-hiking"></i>
                        </div>
                        <span class="text-white text-[15px] font-medium">Outbond dan kegiatan kelompok seru</span>
                    </div>
                    <div class="flex items-center gap-5">
                        <div class="w-[45px] h-[45px] rounded-full bg-white/25 flex items-center justify-center text-white text-[18px] shrink-0">
                            <i class="fa-solid fa-camera-retro"></i>
                        </div>
                        <span class="text-white text-[15px] font-medium">Berfoto di berbagai spot estetik & menarik</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <?php require_once dirname(__DIR__) . '/shared/includes/footer.php'; ?>

</body>

</html>