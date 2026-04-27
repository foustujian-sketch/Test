<?php
// Data dikirim dari PageController
$baju = $baju ?? null;
$fasilitas_utama = $fasilitas_utama ?? [];
$fasilitas_pendukung = $fasilitas_pendukung ?? [];

// Fungsi untuk membatasi jumlah kata pada deskripsi
if (!function_exists('batasi_kata')) {
    function batasi_kata($string, $batas_kata) {
        if (empty($string)) return '';
        $string = trim(strip_tags($string)); 
        $kata = explode(" ", $string);
        if (count($kata) > $batas_kata) {
            return implode(" ", array_slice($kata, 0, $batas_kata)) . "...";
        }
        return $string;
    }
}

// Data khusus untuk Sewa Baju
$harga_baju = $baju ? ($baju['harga'] ?? 30000) : 30000;
$desk_baju = (!empty($baju['deskripsi'])) ? $baju['deskripsi'] : 'Abadikan momen tak terlupakan dengan mengenakan busana tradisional mancanegara.';

$local_placeholder = 'assets/homepage.jpg';

// --- GAMBAR SEWA BAJU (STATIS) ---
$gambar_baju = [
    'image_tss/1776034851_0_yukata.webp',
    'image_tss/1776034851_1_hanbok.webp',
    'image_tss/1776034851_2_belanda.webp'
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="icon" type="image/webp" href="/assets/logo.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas & Layanan - Taman Salma Shofa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="bg-[#FAFAFB] text-gray-800 flex flex-col min-h-screen overflow-x-hidden">

    <?php include __DIR__ . '/../shared/includes/navbar.php'; ?>

    <main class="max-w-[1240px] mx-auto px-6 md:px-12 py-12 w-full flex-grow">

        <section class="mb-20">
            <div class="border-l-[4px] border-[#E88D57] pl-5 mb-10">
                <h1 class="text-[32px] md:text-[36px] font-bold text-[#1a1a24] leading-tight mb-2">Fasilitas Kami</h1>
                <p class="text-gray-500 text-[15px] max-w-3xl leading-relaxed">
                    Nikmati berbagai fasilitas menarik untuk rekreasi dan bersantai bersama keluarga.
                </p>
            </div>

            <div class="relative group">
                <button onclick="geserKiri('slider-utama')" class="absolute left-0 top-[40%] -translate-y-1/2 -translate-x-1/2 z-10 bg-white text-[#E88D57] w-12 h-12 rounded-full shadow-lg border border-gray-100 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity focus:outline-none hidden md:flex hover:bg-gray-50">
                    <i class="fa-solid fa-chevron-left text-xl"></i>
                </button>

                <div id="slider-utama" class="flex overflow-x-auto gap-6 md:gap-8 pb-8 snap-x snap-mandatory hide-scroll scroll-smooth relative">
                    <?php
                    if (!empty($fasilitas_utama)) {
                        $counter = 0;
                        foreach ($fasilitas_utama as $utama):
                            $counter++;

                            // Menampilkan semua fasilitas (tidak menyembunyikan yang ke-2)


                            $img_db = $utama['gambar'] ?? '';
                            $nama_f = $utama['nama'] ?? 'Fasilitas';
                            $img_final = !empty($img_db) ? 'image_tss/' . rawurlencode(basename($img_db)) : ltrim($local_placeholder, '/');
                    ?>
                            <div class="flex flex-col rounded-3xl overflow-hidden shadow-md group/card shrink-0 w-[300px] md:w-[360px] snap-start">
                                <div class="h-[250px] w-full overflow-hidden bg-gray-200 relative">
                                    <img src="<?= $img_final ?>" 
                                         alt="<?= htmlspecialchars($nama_f) ?>" 
                                         class="w-full h-full object-cover group-hover/card:scale-105 transition-transform duration-700">
                                </div>
                                <div class="bg-[#E88D57] p-8 flex-grow">
                                    <h3 class="text-white text-[22px] font-bold mb-4"><?= htmlspecialchars($nama_f) ?></h3>
                                    <div class="text-white/90 text-[14px] leading-relaxed">
                                        <?= htmlspecialchars(batasi_kata($utama['deskripsi'] ?? '', 15)) ?>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endforeach;
                    }
                    ?>
                </div>

                <button onclick="geserKanan('slider-utama')" class="absolute right-0 top-[40%] -translate-y-1/2 translate-x-1/2 z-10 bg-white text-[#E88D57] w-12 h-12 rounded-full shadow-lg border border-gray-100 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity focus:outline-none hidden md:flex hover:bg-gray-50">
                    <i class="fa-solid fa-chevron-right text-xl"></i>
                </button>
            </div>
        </section>

        <section class="mb-20">
            <div class="border-l-[4px] border-[#E88D57] pl-5 mb-10">
                <h2 class="text-[28px] md:text-[32px] font-bold text-[#1a1a24] leading-tight">Fasilitas Lainnya</h2>
            </div>
            <div class="relative group">
                <button onclick="geserKiri('slider-pendukung')" class="absolute left-0 top-[40%] -translate-y-1/2 -translate-x-1/2 z-10 bg-white text-[#E88D57] w-12 h-12 rounded-full shadow-lg border border-gray-100 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity focus:outline-none hidden md:flex hover:bg-gray-50">
                    <i class="fa-solid fa-chevron-left text-xl"></i>
                </button>

                <div id="slider-pendukung" class="flex overflow-x-auto gap-6 pb-8 snap-x snap-mandatory hide-scroll scroll-smooth relative">
                    <?php foreach ($fasilitas_pendukung as $pendukung): 
                        $img_p = !empty($pendukung['gambar']) ? 'image_tss/' . rawurlencode(basename($pendukung['gambar'])) : ltrim($local_placeholder, '/');
                    ?>
                        <div class="text-center shrink-0 w-[200px] md:w-[260px] snap-start">
                            <img src="<?= $img_p ?>" class="w-full h-[180px] object-cover rounded-[20px] mb-4 bg-gray-200 shadow-sm border border-gray-100">
                            <h4 class="font-bold text-[#1a1a24] text-[15px] mb-1 truncate px-2"><?= htmlspecialchars($pendukung['nama'] ?? '') ?></h4>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button onclick="geserKanan('slider-pendukung')" class="absolute right-0 top-[40%] -translate-y-1/2 translate-x-1/2 z-10 bg-white text-[#E88D57] w-12 h-12 rounded-full shadow-lg border border-gray-100 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity focus:outline-none hidden md:flex hover:bg-gray-50">
                    <i class="fa-solid fa-chevron-right text-xl"></i>
                </button>
            </div>
        </section>

        <section class="bg-[#2B2B43] rounded-[40px] p-8 md:p-14 relative overflow-hidden flex flex-col lg:flex-row gap-12 items-center mb-16 shadow-xl">
            <div class="absolute -right-10 -top-20 text-[400px] font-bold text-white/[0.03] select-none pointer-events-none leading-none font-serif">S</div>
            <div class="w-full lg:w-1/2 relative z-10">
                <span class="text-[#E88D57] text-[11px] font-bold uppercase tracking-widest mb-3 inline-block">Layanan Spesial</span>
                <h2 class="text-white text-[36px] md:text-[46px] font-bold leading-[1.1] mb-6"><?= htmlspecialchars($baju['nama'] ?? "Sewa Baju Tradisional") ?></h2>
                <p class="text-gray-300 text-[15px] leading-relaxed mb-10 max-w-md"><?= htmlspecialchars($desk_baju) ?></p>
                <div class="bg-[#363650] border border-white/10 rounded-2xl p-5 inline-block">
                    <p class="text-gray-400 text-[12px] mb-1">Harga Sewa Flat</p>
                    <div class="flex items-end gap-2">
                        <span class="text-white text-[28px] font-bold leading-none">Rp <?= number_format((float)$harga_baju, 0, ',', '.') ?></span>
                        <span class="text-gray-400 text-[14px] mb-1">/ kostum</span>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/2 relative z-10 flex gap-4 h-[380px]">
                <div class="flex flex-col gap-4 w-1/2 h-full">
                    <div class="relative w-full h-[182px] rounded-[20px] overflow-hidden bg-gray-200 group">
                        <img src="<?= htmlspecialchars($gambar_baju[0]) ?>" onerror="this.src='assets/homepage.jpg'" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="relative w-full h-[182px] rounded-[20px] overflow-hidden bg-gray-200 group">
                        <img src="<?= htmlspecialchars($gambar_baju[1]) ?>" onerror="this.src='assets/homepage.jpg'" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-700">
                    </div>
                </div>
                <div class="w-1/2 h-full">
                    <div class="relative w-full h-[380px] rounded-[20px] overflow-hidden bg-gray-200 group">
                        <img src="<?= htmlspecialchars($gambar_baju[2]) ?>" onerror="this.src='assets/homepage.jpg'" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-700">
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include __DIR__ . '/../shared/includes/footer.php'; ?>
    
    <script>
        function geserKiri(sliderId) { document.getElementById(sliderId).scrollBy({ left: -350, behavior: 'smooth' }); }
        function geserKanan(sliderId) { document.getElementById(sliderId).scrollBy({ left: 350, behavior: 'smooth' }); }
    </script>
</body>
</html>