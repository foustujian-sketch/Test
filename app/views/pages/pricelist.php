<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/webp" href="/assets/logo.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricelist - Taman Salma Shofa</title>
    <meta name="description" content="Daftar harga tiket masuk, paket camping, dan sewa gazebo di Taman Salma Shofa Samarinda. Harga terjangkau untuk rekreasi keluarga.">
    <meta name="keywords" content="harga tiket taman salma shofa, sewa gazebo, paket camping samarinda, pricelist taman salma shofa">
    <meta name="author" content="Taman Salma Shofa">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            navy: '#2B2B43',        // Basic Navy
                            card: '#37374F',        // Card background (Navy blended slightly lighter)
                            orange: '#e88d57',      // Primary Orange matching the design
                            orangeLight: '#FFF7ED', // Primary 0 (Light cream background)
                            greyText: '#D4D4D8',    // Light grey text for dark backgrounds
                            greyDark: '#4a4a5a'     // Dark grey text
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased bg-white text-gray-800">

    <?php require_once dirname(__DIR__) . '/shared/includes/navbar.php'; ?>

    <!-- HEADER TITLE -->
    <div class="max-w-7xl mx-auto px-6 pt-12 pb-10 mt-[72px]">
        <h1 class="text-[32px] font-bold text-[#1a1a24] mb-3">Pricelist</h1>
        <p class="text-brand-greyDark text-[13.5px] leading-relaxed max-w-3xl">
            Rencanakan hari yang sempurna dengan harga yang transparan dan terjangkau.<br>
            Mulai dari kunjungan santai hingga acara perayaan besar, kami menyediakan tempat untuk Anda.
        </p>
    </div>

    <!-- MAIN CONTENT -->
    <main class="max-w-7xl mx-auto px-6 pb-20 space-y-16">

        <!-- SECTION 1: TIKET MASUK -->
        <section>
            <!-- Section Header -->
            <div class="flex items-center gap-3 mb-6">
                <i class="fa-solid fa-ticket-simple text-brand-orange text-[22px]"></i>
                <h2 class="text-[20px] font-bold text-[#1a1a24]">Tiket Masuk</h2>
            </div>
            
            <!-- Alert Info -->
            <div class="bg-[#FFF9E6] border-l-[3px] border-[#F59E0B] p-4 mb-8 rounded-r-lg flex items-start gap-3 text-[12px] text-amber-900 font-medium">
                <i class="fa-solid fa-circle-info mt-[3px] text-[#D97706]"></i>
                <p>Pembelian tiket dilakukan secara langsung di loket (On-site only). Kami tidak melayani pemesanan tiket online.</p>
            </div>

            <!-- Tiket Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card 1 -->
                <div class="bg-brand-orangeLight rounded-2xl p-8 lg:p-10 border border-[#FBE6D3]">
                    <p class="text-brand-orange text-[10px] font-bold tracking-[0.15em] uppercase mb-2">Usia 1,5+ Tahun</p>
                    <h3 class="text-[24px] font-bold text-[#1a1a24] mb-4">Tiket Masuk Umum</h3>
                    <p class="text-brand-greyDark text-[13px] leading-relaxed mb-10 max-w-sm">
                        Dapatkan akses ke area taman yang indah, fasilitas umum termasuk kolam renang.
                    </p>
                    <div class="flex items-baseline gap-1.5 mt-auto">
                        <span class="text-brand-orange text-[38px] font-bold leading-none tracking-tight">Rp 25.000</span>
                        <span class="text-brand-greyDark text-[13px] font-medium">/ orang</span>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-brand-orangeLight rounded-2xl p-8 lg:p-10 border border-[#FBE6D3]">
                    <p class="text-brand-orange text-[10px] font-bold tracking-[0.15em] uppercase mb-2">Usia 1,5+ Tahun</p>
                    <h3 class="text-[24px] font-bold text-[#1a1a24] mb-4 leading-tight">Tiket Masuk Taman + Beranda Salma Shofa</h3>
                    <p class="text-brand-greyDark text-[13px] leading-relaxed mb-10 max-w-sm">
                        Dapatkan akses ke area taman yang indah, fasilitas umum termasuk kolam renang.
                    </p>
                    <div class="flex items-baseline gap-1.5 mt-auto">
                        <span class="text-brand-orange text-[38px] font-bold leading-none tracking-tight">Rp 55.000</span>
                        <span class="text-brand-greyDark text-[13px] font-medium">/ orang</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2: PAKET CAMPING -->
        <section>
            <!-- Section Header -->
            <div class="flex items-center gap-3 mb-8">
                <i class="fa-solid fa-tent text-brand-orange text-[20px]"></i>
                <h2 class="text-[20px] font-bold text-[#1a1a24]">Paket Camping</h2>
            </div>
            
            <!-- Paket Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 items-center">
                
                <!-- Card 1 -->
                <div class="bg-white rounded-[20px] p-8 border border-gray-100 shadow-[0_4px_25px_-5px_rgba(0,0,0,0.04)]">
                    <h3 class="text-[18px] font-bold text-[#1a1a24] mb-1">Package 01</h3>
                    <div class="flex items-baseline gap-1.5 mb-10">
                        <span class="text-brand-orange text-[32px] font-bold leading-none tracking-tight">Rp 60k</span>
                        <span class="text-gray-400 text-[11px] font-medium">/ Orang</span>
                    </div>
                    
                    <ul class="space-y-4 text-[13px] text-gray-500 font-medium">
                        <li class="flex items-center gap-3">
                            <i class="fa-regular fa-circle-check text-emerald-500 text-[18px]"></i> 
                            Tiket Masuk
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-regular fa-circle-check text-emerald-500 text-[18px]"></i> 
                            Lapangan Camp
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-regular fa-circle-check text-emerald-500 text-[18px]"></i> 
                            Kamar Ganti & Toilet
                        </li>
                    </ul>
                </div>

                <!-- Card 2 (Highlighted/Most Popular) -->
                <div class="bg-white rounded-[20px] p-8 lg:p-10 border-2 border-brand-orange shadow-[0_8px_30px_-5px_rgba(232,141,87,0.15)] relative transform md:-translate-y-2">
                    <!-- Badge -->
                    <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-brand-orange text-white text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-wider shadow-sm">
                        Most Popular
                    </div>
                    
                    <h3 class="text-[18px] font-bold text-[#1a1a24] mb-1">Package 02</h3>
                    <div class="flex items-baseline gap-1.5 mb-10">
                        <span class="text-brand-orange text-[32px] font-bold leading-none tracking-tight">Rp 100k</span>
                        <span class="text-gray-400 text-[11px] font-medium">/ Orang</span>
                    </div>
                    
                    <ul class="space-y-4 text-[13px] text-[#1a1a24] font-semibold">
                        <li class="flex items-center gap-3">
                            <i class="fa-regular fa-circle-check text-emerald-500 text-[18px]"></i> 
                            Semua fasilitas di Paket 01
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-circle-minus text-brand-orange text-[18px]"></i> 
                            Termasuk Tenda
                        </li>
                    </ul>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-[20px] p-8 border border-gray-100 shadow-[0_4px_25px_-5px_rgba(0,0,0,0.04)]">
                    <h3 class="text-[18px] font-bold text-[#1a1a24] mb-1">Package 03</h3>
                    <div class="flex items-baseline gap-1.5 mb-10">
                        <span class="text-brand-orange text-[32px] font-bold leading-none tracking-tight">Rp 150k</span>
                        <span class="text-gray-400 text-[11px] font-medium">/ Orang</span>
                    </div>
                    
                    <ul class="space-y-4 text-[13px] text-gray-800 font-semibold">
                        <li class="flex items-center gap-3">
                            <i class="fa-regular fa-circle-check text-emerald-500 text-[18px]"></i> 
                            Semua fasilitas di Paket 02
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-circle-minus text-brand-orange text-[18px]"></i> 
                            Makan Malam
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-circle-minus text-brand-orange text-[18px]"></i> 
                            Snack Pagi
                        </li>
                    </ul>
                </div>

            </div>
        </section>

        <!-- SECTION 3: SEWA GAZEBO -->
        <section>
            <!-- Section Header -->
            <div class="flex items-center gap-3 mb-8">
                <i class="fa-solid fa-house-chimney text-brand-orange text-[20px]"></i>
                <h2 class="text-[20px] font-bold text-[#1a1a24]">Sewa Gazebo</h2>
            </div>

            <!-- Gazebo Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                
                <!-- Card 1 -->
                <div class="rounded-2xl overflow-hidden shadow-[0_4px_20px_-5px_rgba(0,0,0,0.04)] border border-gray-100 flex flex-col">
                    <!-- Top / Orange Header -->
                    <div class="bg-[#F0A266] text-white py-5 text-center">
                        <h3 class="text-[15px] font-bold tracking-wide mb-1">Gazebo 1-6</h3>
                        <p class="text-[11px] text-white/90 font-medium">Kapasitas: 12 orang</p>
                    </div>
                    <!-- Bottom / White Body -->
                    <div class="bg-white p-7 flex flex-col gap-5 text-[13px]">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">< 4 Jam</span>
                            <span class="font-bold text-[#1a1a24]">Rp 100k</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">> 4 Jam</span>
                            <span class="font-bold text-[#1a1a24]">Rp 200k</span>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="rounded-2xl overflow-hidden shadow-[0_4px_20px_-5px_rgba(0,0,0,0.04)] border border-gray-100 flex flex-col">
                    <!-- Top / Orange Header -->
                    <div class="bg-[#F0A266] text-white py-5 text-center">
                        <h3 class="text-[15px] font-bold tracking-wide mb-1">Gazebo 7-20</h3>
                        <p class="text-[11px] text-white/90 font-medium">Kapasitas: 9 orang</p>
                    </div>
                    <!-- Bottom / White Body -->
                    <div class="bg-white p-7 flex flex-col gap-5 text-[13px]">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">< 4 Jam</span>
                            <span class="font-bold text-[#1a1a24]">Rp 75k</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">> 4 Jam</span>
                            <span class="font-bold text-[#1a1a24]">Rp 150k</span>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="rounded-2xl overflow-hidden shadow-[0_4px_20px_-5px_rgba(0,0,0,0.04)] border border-gray-100 flex flex-col">
                    <!-- Top / Orange Header -->
                    <div class="bg-[#F0A266] text-white py-5 text-center">
                        <h3 class="text-[15px] font-bold tracking-wide mb-1">Gazebo 21</h3>
                        <p class="text-[11px] text-white/90 font-medium">Kapasitas: 30 orang</p>
                    </div>
                    <!-- Bottom / White Body -->
                    <div class="bg-white p-7 flex flex-col gap-5 text-[13px]">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">< 4 Jam</span>
                            <span class="font-bold text-[#1a1a24]">Rp 300k</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">> 4 Jam</span>
                            <span class="font-bold text-[#1a1a24]">Rp 500k</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <?php require_once dirname(__DIR__) . '/shared/includes/footer.php'; ?>

</body>
</html>