<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/webp" href="/assets/logo.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Taman Salma Shofa</title>
    <meta name="description" content="Temukan jawaban untuk pertanyaan umum seputar kunjungan Anda di Taman Salma Shofa Samarinda. Harga tiket, jam buka, dan aturan pengunjung.">
    <meta name="keywords" content="faq taman salma shofa, pertanyaan umum taman salma shofa, jam buka taman salma shofa, aturan taman salma shofa">
    <meta name="author" content="Taman Salma Shofa">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
                            navy: '#2B2B43',        
                            card: '#37374F',        
                            orange: '#e88d57',      
                            orangeLight: '#FFF7ED', 
                            greyText: '#D4D4D8',    
                            greyDark: '#4a4a5a'     
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Sembunyikan marker default (segitiga hitam) pada elemen detail */
        details > summary {
            list-style: none;
        }
        details > summary::-webkit-details-marker {
            display: none;
        }
        /* Transisi untuk animasi rotasi ikon caret */
        details[open] summary ~ * {
            animation: sweep .3s ease-in-out;
        }
        @keyframes sweep {
            0%    {opacity: 0; transform: translateY(-10px)}
            100%  {opacity: 1; transform: translateY(0)}
        }
    </style>
</head>
<body class="font-sans antialiased bg-[#FCFCFD] text-gray-800">

    <?php require_once dirname(__DIR__) . '/shared/includes/navbar.php'; ?>

    <section class="relative h-[320px] w-full flex items-center justify-center overflow-hidden mt-[72px]">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('image_tss/faq.webp');"></div>
        
        <div class="absolute inset-0 bg-gradient-to-r from-[#e88d57]/90 to-[#f5b871]/80 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-brand-orange/70"></div>

        <div class="relative z-10 text-center px-6 max-w-3xl mx-auto flex flex-col items-center">
            <h1 class="text-[34px] md:text-[42px] font-bold text-white mb-4 leading-tight drop-shadow-md">FAQ – Taman Salma Shofa</h1>
            <p class="text-[13.5px] md:text-[15px] text-white/95 mb-8 leading-relaxed max-w-xl font-medium drop-shadow-sm">
                Temukan jawaban untuk pertanyaan umum seputar kunjungan Anda di taman rekreasi keluarga kami.
            </p>
        </div>
    </section>

    <main class="max-w-[850px] mx-auto px-6 py-16">
        
        <div class="space-y-4 mb-16">
            
            <details class="group bg-white border border-gray-100 rounded-[14px] shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] overflow-hidden" open>
                <summary class="flex justify-between items-center font-semibold cursor-pointer p-6 text-[14px] text-[#1a1a24] select-none hover:bg-gray-50/50 transition-colors">
                    Berapa harga tiket masuk?
                    <span class="transition-transform duration-300 group-open:rotate-180 text-brand-orange ml-4 shrink-0">
                        <i class="fa-solid fa-chevron-down text-[12px]"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 pt-0 text-[13px] text-gray-500 leading-relaxed">
                    Harga tiket masuk adalah <span class="text-brand-orange font-medium">Rp 25.000 per orang</span> untuk pengunjung dengan usia di atas 1,5 tahun.
                </div>
            </details>

            <details class="group bg-white border border-gray-100 rounded-[14px] shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] overflow-hidden">
                <summary class="flex justify-between items-center font-semibold cursor-pointer p-6 text-[14px] text-[#1a1a24] select-none hover:bg-gray-50/50 transition-colors">
                    Fasilitas apa saja yang sudah termasuk?
                    <span class="transition-transform duration-300 group-open:rotate-180 text-brand-orange/70 ml-4 shrink-0">
                        <i class="fa-solid fa-chevron-down text-[12px]"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 pt-0 text-[13px] text-gray-500 leading-relaxed">
                    Tiket masuk sudah termasuk akses ke seluruh area taman, kolam renang dengan berbagai kedalaman, tempat bilas, kamar ganti, toilet, dan kursi-kursi di area umum secara gratis.
                </div>
            </details>

            <details class="group bg-white border border-gray-100 rounded-[14px] shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] overflow-hidden">
                <summary class="flex justify-between items-center font-semibold cursor-pointer p-6 text-[14px] text-[#1a1a24] select-none hover:bg-gray-50/50 transition-colors">
                    Bolehkah membawa makanan dari luar?
                    <span class="transition-transform duration-300 group-open:rotate-180 text-brand-orange/70 ml-4 shrink-0">
                        <i class="fa-solid fa-chevron-down text-[12px]"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 pt-0 text-[13px] text-gray-500 leading-relaxed">
                    Tentu saja! Pengunjung diperbolehkan membawa makanan dan minuman dari luar untuk dinikmati bersama keluarga di area taman yang telah disediakan.
                </div>
            </details>

            <details class="group bg-white border border-gray-100 rounded-[14px] shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] overflow-hidden">
                <summary class="flex justify-between items-center font-semibold cursor-pointer p-6 text-[14px] text-[#1a1a24] select-none hover:bg-gray-50/50 transition-colors">
                    Kapan jam operasionalnya?
                    <span class="transition-transform duration-300 group-open:rotate-180 text-brand-orange/70 ml-4 shrink-0">
                        <i class="fa-solid fa-chevron-down text-[12px]"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 pt-0 text-[13px] text-gray-500 leading-relaxed">
                    Taman Salma Shofa beroperasi dari pukul 08.00 hingga 17.00 WITA. Namun perlu diperhatikan bahwa loket tiket akan ditutup pada pukul 16.00 WITA.
                </div>
            </details>

            <details class="group bg-white border border-gray-100 rounded-[14px] shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] overflow-hidden">
                <summary class="flex justify-between items-center font-semibold cursor-pointer p-6 text-[14px] text-[#1a1a24] select-none hover:bg-gray-50/50 transition-colors">
                    Hari apa saja Taman Salma Shofa buka?
                    <span class="transition-transform duration-300 group-open:rotate-180 text-brand-orange/70 ml-4 shrink-0">
                        <i class="fa-solid fa-chevron-down text-[12px]"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 pt-0 text-[13px] text-gray-500 leading-relaxed">
                    Kami buka setiap hari Selasa hingga Minggu. Taman Salma Shofa tutup setiap hari Senin untuk keperluan pemeliharaan (maintenance), kecuali jika hari Senin tersebut bertepatan dengan tanggal merah/hari libur nasional.
                </div>
            </details>

            <details class="group bg-white border border-gray-100 rounded-[14px] shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] overflow-hidden">
                <summary class="flex justify-between items-center font-semibold cursor-pointer p-6 text-[14px] text-[#1a1a24] select-none hover:bg-gray-50/50 transition-colors">
                    Apakah perlu reservasi sebelum datang?
                    <span class="transition-transform duration-300 group-open:rotate-180 text-brand-orange/70 ml-4 shrink-0">
                        <i class="fa-solid fa-chevron-down text-[12px]"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 pt-0 text-[13px] text-gray-500 leading-relaxed">
                    Untuk kunjungan umum dan pembelian tiket reguler, Anda tidak perlu melakukan reservasi dan dapat langsung membeli di loket. Namun, untuk penyewaan Gazebo atau paket khusus seperti Camping, kami menyarankan reservasi jauh hari.
                </div>
            </details>

            <details class="group bg-white border border-gray-100 rounded-[14px] shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] overflow-hidden">
                <summary class="flex justify-between items-center font-semibold cursor-pointer p-6 text-[14px] text-[#1a1a24] select-none hover:bg-gray-50/50 transition-colors">
                    Bagaimana cara cek ketersediaan Gazebo?
                    <span class="transition-transform duration-300 group-open:rotate-180 text-brand-orange/70 ml-4 shrink-0">
                        <i class="fa-solid fa-chevron-down text-[12px]"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 pt-0 text-[13px] text-gray-500 leading-relaxed">
                    Anda dapat melihat ketersediaan Gazebo secara langsung pada halaman <strong>"Gazebo"</strong> di website ini, atau langsung menghubungi admin kami melalui WhatsApp.
                </div>
            </details>

            <details class="group bg-white border border-gray-100 rounded-[14px] shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] overflow-hidden">
                <summary class="flex justify-between items-center font-semibold cursor-pointer p-6 text-[14px] text-[#1a1a24] select-none hover:bg-gray-50/50 transition-colors">
                    Apakah tersedia tempat parkir?
                    <span class="transition-transform duration-300 group-open:rotate-180 text-brand-orange/70 ml-4 shrink-0">
                        <i class="fa-solid fa-chevron-down text-[12px]"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 pt-0 text-[13px] text-gray-500 leading-relaxed">
                    Ya, kami memiliki area parkir yang sangat luas yang dapat menampung hingga 30 mobil dan lebih dari 100 sepeda motor, dengan biaya parkir terjangkau dan penjagaan yang aman.
                </div>
            </details>

            <details class="group bg-white border border-gray-100 rounded-[14px] shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] overflow-hidden">
                <summary class="flex justify-between items-center font-semibold cursor-pointer p-6 text-[14px] text-[#1a1a24] select-none hover:bg-gray-50/50 transition-colors">
                    Kegiatan apa saja yang cocok dilakukan di sini?
                    <span class="transition-transform duration-300 group-open:rotate-180 text-brand-orange/70 ml-4 shrink-0">
                        <i class="fa-solid fa-chevron-down text-[12px]"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 pt-0 text-[13px] text-gray-500 leading-relaxed">
                    Taman Salma Shofa sangat cocok untuk kegiatan rekreasi keluarga (berenang dan piknik), gathering komunitas atau perusahaan, kegiatan outbond, foto pre-wedding, hingga menyewa baju tradisional mancanegara.
                </div>
            </details>

            <details class="group bg-white border border-gray-100 rounded-[14px] shadow-[0_2px_15px_-5px_rgba(0,0,0,0.05)] overflow-hidden">
                <summary class="flex justify-between items-center font-semibold cursor-pointer p-6 text-[14px] text-[#1a1a24] select-none hover:bg-gray-50/50 transition-colors">
                    Bagaimana cara menghubungi pengelola?
                    <span class="transition-transform duration-300 group-open:rotate-180 text-brand-orange/70 ml-4 shrink-0">
                        <i class="fa-solid fa-chevron-down text-[12px]"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 pt-0 text-[13px] text-gray-500 leading-relaxed">
                    Anda dapat menghubungi kami melalui pesan WhatsApp di nomor kontak admin yang tertera pada bagian paling bawah (footer) website ini.
                </div>
            </details>

        </div>

        <div class="bg-brand-orangeLight rounded-[20px] p-8 md:p-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 shadow-sm border border-[#FBE6D3]">
            <div>
                <h3 class="font-bold text-[18px] text-[#1a1a24] mb-2">Masih punya pertanyaan lain?</h3>
                <p class="text-[13px] text-gray-500 max-w-md leading-relaxed">
                    Hubungi tim kami melalui WhatsApp untuk respon cepat mengenai rencana kunjungan Anda.
                </p>
            </div>
            
            <a href="https://wa.me/6285705996170" target="_blank" class="bg-[#10B981] hover:bg-[#059669] text-white font-bold text-[13.5px] px-8 py-3.5 rounded-xl transition-colors shadow-md inline-flex items-center gap-2.5 shrink-0">
                <i class="fa-brands fa-whatsapp text-[18px]"></i>
                Chat WhatsApp
            </a>
            
        </div>

    </main>

    <?php require_once dirname(__DIR__) . '/shared/includes/footer.php'; ?>

</body>
</html>