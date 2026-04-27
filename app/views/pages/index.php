<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/webp" href="/assets/logo.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taman Salma Shofa</title>
    <meta name="description" content="Taman Salma Shofa Samarinda - Destinasi wisata keluarga dengan fasilitas lengkap, kolam renang, gazebo, dan banyak spot foto menarik di Samarinda.">
    <meta name="keywords" content="taman salma shofa, wisata samarinda, kolam renang samarinda, tempat liburan keluarga, sewa gazebo, taman wisata edukasi">
    <meta name="author" content="Taman Salma Shofa">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">
    <link rel="preload" as="image" href="/assets/hero.webp">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="text-gray-800 antialiased bg-[#FAFAFB] flex flex-col min-h-screen">

    <?php require_once dirname(__DIR__) . '/shared/includes/navbar.php'; ?>

   <section class="w-full h-[300px] md:h-[300px] lg:h-[450px] overflow-hidden bg-gray-100">
    <img src="/assets/hero.webp" 
         alt="Suasana Taman Salma Shofa" 
         class="w-full h-full object-cover object-center">
</section>
    <section class="max-w-4xl mx-auto px-6 pt-16 pb-12 text-center">
        <h1 class="text-[32px] md:text-[48px] font-semibold text-[#1a1a24] mb-4 tracking-tight">
            Selamat Datang di Taman Salma Shofa
        </h1>
        <p class="text-gray-500 text-[14px] md:text-[15px]">
            Jika bukan karena kasih sayang, bisakah kamu besar seperti sekarang?
        </p>
    </section>

    <section class="max-w-6xl mx-auto px-6 md:px-8 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            
            <div class="relative overflow-hidden h-[220px] md:h-[240px] shadow-lg group bg-gray-200 rounded-[20px]">
                <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-700" 
                     style="background-image: url('/assets/Card1.webp');">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#E88D57] via-[#E88D57]/90 to-transparent"></div>
                
                <div class="relative z-10 p-8 h-full flex flex-col justify-center w-[85%] md:w-[80%]">
                    <h3 class="text-white text-[24px] md:text-[28px] font-bold mb-2 leading-tight">Info Lengkap Wisata</h3>
                    <p class="text-white/90 text-[13px] mb-6">Temukan info lengkap tentang Taman Salma Shofa</p>
                    
                    <a href="/informasi" class="w-fit bg-transparent border border-white/80 hover:bg-white hover:text-[#E88D57] text-white text-[12px] font-bold px-6 py-2.5 rounded-none transition-colors">
                        Selengkapnya
                    </a>
                </div>
            </div>

            <div class="relative overflow-hidden h-[220px] md:h-[240px] shadow-lg group bg-gray-200 rounded-[20px]">
                <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-700" 
                     style="background-image: url('/assets/Card2.webp');">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#E88D57] via-[#E88D57]/90 to-transparent"></div>
                
                <div class="relative z-10 p-8 h-full flex flex-col justify-center w-[85%] md:w-[80%]">
                    <h3 class="text-white text-[24px] md:text-[28px] font-bold mb-2 leading-tight">Cek Ketersediaan<br>Gazebo</h3>
                    <p class="text-white/90 text-[13px] mb-6">Lihat ketersediaan gazebo secara real-time</p>
                    
                    <a href="/gazebo" class="w-fit bg-transparent border border-white/80 hover:bg-white hover:text-[#E88D57] text-white text-[12px] font-bold px-6 py-2.5 rounded-none transition-colors">
                        Cek Sekarang
                    </a>
                </div>
            </div>

        </div>
    </section>

    <div class="border-y border-gray-200 bg-white">
        <section class="max-w-6xl mx-auto px-6 py-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-0 md:divide-x divide-gray-300">
                
                <div class="flex gap-4 px-4 items-start">
                    <div class="mt-1 text-gray-700">
                        <i class="fa-regular fa-clock text-xl text-[#E88D57]"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-2 text-[#1a1a24]">Jam Operasional</h4>
                        <div class="text-[13px] text-gray-600 space-y-1.5">
                            <p class="flex justify-between w-40 font-medium"><span class="text-gray-800">Selasa - Minggu:</span> <span>08.00 - 17.00</span></p>
                            <p>Senin Tutup (kecuali tanggal merah)</p>
                            <p>Loket tiket tutup pukul 16.00</p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 px-4 md:px-8 items-start">
                    <div class="mt-1 text-gray-700">
                        <i class="fa-solid fa-rupiah-sign text-xl text-[#E88D57]"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-2 text-[#1a1a24]">Harga Tiket</h4>
                        <div class="text-[13px] text-gray-600 space-y-1.5">
                            <p class="font-medium text-gray-800">Rp 25.000 / orang</p>
                            <p>Berlaku untuk anak-anak dan dewasa.</p>
                            <p>Harga sewa alat renang opsional.</p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 px-4 md:px-8 items-start">
                    <div class="mt-1 text-gray-700">
                        <i class="fa-solid fa-circle-info text-xl text-[#E88D57]"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-2 text-[#1a1a24]">Ketentuan Pengunjung</h4>
                        <div class="text-[13px] text-gray-600 space-y-1.5">
                            <p>Tiket berlaku mulai usia 1,5 tahun.</p>
                            <p>Tiket sudah termasuk akses kolam renang.</p>
                            <p>Pengunjung boleh membawa makanan dari luar.</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <section class="max-w-6xl mx-auto px-6 py-20 w-full">
        <div class="flex items-center gap-3 mb-8">
            <i class="fa-solid fa-location-dot text-[#E88D57] text-[28px]"></i>
            <h2 class="text-[28px] md:text-[32px] font-bold text-[#1a1a24]">Lokasi Kami</h2>
        </div>

        <div class="border border-gray-200 rounded-[24px] overflow-hidden shadow-sm flex flex-col w-full bg-white">
            
            <div class="bg-[#F8F9FA] px-6 md:px-8 py-4 border-b border-gray-200">
                <span class="text-gray-500 text-[12px] md:text-[13px] font-bold tracking-wider uppercase">
                    JL. MELATI NO.123, MUGIREJO, KEC. SUNGAI PINANG, KOTA SAMARINDA
                </span>
            </div>

            <div class="relative bg-gray-100 w-full h-[280px] md:h-[350px] overflow-hidden flex items-center justify-center">
                
                <img src="/assets/map_bg.webp" alt="Peta Lokasi" loading="lazy"
                     class="absolute inset-0 w-full h-full object-cover object-center scale-[2] md:scale-100 pointer-events-none transition-transform duration-500">
                
                <div class="absolute top-4 left-4 md:top-6 md:left-6 z-10">
                    <a href="https://www.google.com/maps/dir/?api=1&destination=Taman+Salma+Shofa+Samarinda" target="_blank" 
                       class="bg-white border border-gray-200 px-4 py-2.5 rounded-xl shadow-sm text-[#3B82F6] hover:bg-gray-50 flex items-center gap-2 text-[13px] font-bold transition-all">
                        Open in Maps <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                    </a>
                </div>

            </div>

            <div class="bg-[#2B2B43] p-4 md:p-6 md:px-8 flex flex-row justify-between items-center gap-3 text-white relative z-20">
                <div class="overflow-hidden">
                    <h3 class="font-bold text-[16px] md:text-[18px] mb-0.5 md:mb-1 truncate">Taman Salma Shofa</h3>
                    <p class="text-[#A1A1AA] text-[11px] md:text-[14px] truncate">Samarinda, Kalimantan Timur</p>
                </div>
                <a href="https://www.google.com/maps/dir/?api=1&destination=Taman+Salma+Shofa+Samarinda" target="_blank" 
                   class="bg-[#E88D57] hover:bg-[#D97C45] text-white px-5 py-2.5 md:px-8 md:py-3 rounded-xl shadow-sm flex items-center gap-2 transition-all font-bold text-[13px] md:text-[14px] whitespace-nowrap shrink-0">
                    <i class="fa-solid fa-diamond-turn-right"></i> Rute
                </a>
            </div>
        </div>
    </section>

    <section class="bg-[#FAFAFB] py-20 border-t border-gray-200 overflow-hidden">
        <div class="max-w-6xl mx-auto px-6">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <span class="text-[#E88D57] text-[11px] font-bold tracking-[0.15em] uppercase flex items-center gap-2">
                        <i class="fa-brands fa-google text-[#4285F4] text-[14px]"></i> Testimoni Google
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold mt-2 text-[#1a1a24]">Ulasan Pengunjung</h2>
                </div>
                <div class="flex items-center gap-3 hidden md:flex">
                    <button id="btnPrevTesti" class="w-12 h-12 rounded-full border-2 border-gray-200 flex items-center justify-center text-gray-500 hover:bg-[#E88D57] hover:text-white hover:border-[#E88D57] transition-all focus:outline-none">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button id="btnNextTesti" class="w-12 h-12 rounded-full border-2 border-gray-200 flex items-center justify-center text-gray-500 hover:bg-[#E88D57] hover:text-white hover:border-[#E88D57] transition-all focus:outline-none">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <div id="testiCarousel" class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-8 -mx-6 px-6 md:mx-0 md:px-0 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                
                <!-- Card 1 -->
                <div class="snap-center shrink-0 w-[85vw] md:w-[400px] bg-white p-8 rounded-[24px] shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div>
                        <div class="text-[#F59E0B] text-[14px] mb-5 flex gap-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-gray-600 text-[14px] leading-[1.8] mb-8 line-clamp-6">
                            "Disini banyak spot foto yang instagram-able, menarik. Kolam renang yang berbagai ukuran kedalaman, ada untuk anak dan dewasa. Tempat istirahat/pondokan yang gratis di pinggir kolam. Tempat bilas yang banyak, tidak takut antri lama."
                        </p>
                    </div>
                    <div class="flex items-center gap-4 border-t border-gray-50 pt-5 mt-auto">
                        <img src="https://i.pravatar.cc/150?img=47" alt="User" class="w-11 h-11 rounded-full object-cover" loading="lazy">
                        <div>
                            <h4 class="font-bold text-[14px] text-[#1a1a24]">Dewi Minhajuhayati</h4>
                            <p class="text-[11px] text-gray-400">Local Guide</p>
                        </div>
                        <i class="fa-brands fa-google text-gray-200 text-[24px] ml-auto"></i>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="snap-center shrink-0 w-[85vw] md:w-[400px] bg-[#2B2B43] p-8 rounded-[24px] shadow-lg flex flex-col justify-between transform md:-translate-y-2">
                    <div>
                        <div class="text-[#F59E0B] text-[14px] mb-5 flex gap-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-gray-300 text-[14px] leading-[1.8] mb-8 line-clamp-6">
                            "Tempatnya lumayan bersih, ada banyak penjual makanan tapi bawa makanan dari luar juga boleh, ada kursi-kursi gratis untuk menaruh tas bawaan, ada juga gazebo yg disewakan perjam/perhari. Ada kamar mandi untuk pria dan wanita (tidak dicampur)."
                        </p>
                    </div>
                    <div class="flex items-center gap-4 border-t border-white/10 pt-5 mt-auto">
                        <img src="https://i.pravatar.cc/150?img=11" alt="User" class="w-11 h-11 rounded-full object-cover border-2 border-[#E88D57]" loading="lazy">
                        <div>
                            <h4 class="font-bold text-[14px] text-white">Frimita Sadi</h4>
                            <p class="text-[11px] text-gray-400">Pengunjung</p>
                        </div>
                        <i class="fa-brands fa-google text-white/10 text-[24px] ml-auto"></i>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="snap-center shrink-0 w-[85vw] md:w-[400px] bg-white p-8 rounded-[24px] shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div>
                        <div class="text-[#F59E0B] text-[14px] mb-5 flex gap-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <p class="text-gray-600 text-[14px] leading-[1.8] mb-8 line-clamp-6">
                            "Tempat yang menarik, cocok buat keluarga yang mempunyai anak kecil, ada pilihan makanan, dan juga tersedia gazebo sesuai dengan kebutuhan. Biaya masuk 25 ribu/orang. Parkir 5 ribu untuk mobil. Kedalaman kolam maksimal 140 cm."
                        </p>
                    </div>
                    <div class="flex items-center gap-4 border-t border-gray-50 pt-5 mt-auto">
                        <img src="https://i.pravatar.cc/150?img=68" alt="User" class="w-11 h-11 rounded-full object-cover" loading="lazy">
                        <div>
                            <h4 class="font-bold text-[14px] text-[#1a1a24]">Yusup Marwan</h4>
                            <p class="text-[11px] text-gray-400">Local Guide</p>
                        </div>
                        <i class="fa-brands fa-google text-gray-200 text-[24px] ml-auto"></i>
                    </div>
                </div>
                
                <!-- Card 4 -->
                <div class="snap-center shrink-0 w-[85vw] md:w-[400px] bg-[#2B2B43] p-8 rounded-[24px] shadow-lg flex flex-col justify-between transform md:-translate-y-2">
                    <div>
                        <div class="text-[#F59E0B] text-[14px] mb-5 flex gap-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-gray-300 text-[14px] leading-[1.8] mb-8 line-clamp-6">
                            "Wahana rekreasi murah meriah dan ramah untuk anak. Banyak pepohonan sehingga suasana adem asri. Kolam renangnya bersih dan airnya jernih. Cocok banget buat liburan akhir pekan bersama rombongan keluarga."
                        </p>
                    </div>
                    <div class="flex items-center gap-4 border-t border-white/10 pt-5 mt-auto">
                        <img src="https://i.pravatar.cc/150?img=32" alt="User" class="w-11 h-11 rounded-full object-cover border-2 border-[#E88D57]" loading="lazy">
                        <div>
                            <h4 class="font-bold text-[14px] text-white">Budi Santoso</h4>
                            <p class="text-[11px] text-gray-400">Pengunjung</p>
                        </div>
                        <i class="fa-brands fa-google text-white/10 text-[24px] ml-auto"></i>
                    </div>
                </div>

            </div>

            <div class="mt-8 flex justify-center">
                <a href="https://www.google.com/search?sca_esv=dca6e93b619ee7bb&sxsrf=ANbL-n6o0F6fy47m1iAYk7qs74DmaeVqqA:1777131519986&si=AL3DRZEsmMGCryMMFSHJ3StBhOdZ2-6yYkXd_doETEE1OR-qObXYWJMMmgR5_Qd9FD2VXG4XsCAiibOCwk4eVeerYC8qX7siYL5FYwiolpEHfBR2qlhMVv472NGiDUwnFiPJgwKy9T9jm8lGrJlgA1Ng6PFSlN5H0w%3D%3D&q=Taman+Salma+Shofa+Samarinda+Ulasan&sa=X" target="_blank" 
                   class="inline-flex items-center gap-2 bg-white border border-gray-200 hover:border-gray-300 shadow-[0_2px_10px_-3px_rgba(0,0,0,0.1)] hover:shadow-md px-6 py-3 rounded-full text-[13.5px] font-bold text-gray-700 hover:text-blue-600 transition-all">
                    <img src="https://www.gstatic.com/images/branding/googleg/1x/googleg_standard_color_128dp.png" alt="Google" class="w-5 h-5">
                    Lihat semua ulasan di Google Maps
                </a>
            </div>

        </div>
    </section>

    <script>
        // Carousel Logic
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('testiCarousel');
            const btnPrev = document.getElementById('btnPrevTesti');
            const btnNext = document.getElementById('btnNextTesti');
            
            if(carousel && btnPrev && btnNext) {
                const scrollAmount = 400 + 24; // Card width + gap
                
                btnNext.addEventListener('click', () => {
                    carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                });
                
                btnPrev.addEventListener('click', () => {
                    carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                });
            }
        });
    </script>

    <?php require_once dirname(__DIR__) . '/shared/includes/footer.php'; ?>

</body>
</html>