<?php
// Data is passed from AdminController
date_default_timezone_set('Asia/Makassar');

$settingsFile = __DIR__ . '/../../config/settings.json';
$admin_wa = '628125814305';
if (file_exists($settingsFile)) {
    $settings = json_decode(file_get_contents($settingsFile), true);
    $admin_wa = $settings['admin_wa_pengingat'] ?? $admin_wa;
}

$hari_inggris = date('l');
$bulan_angka = date('n');

$daftar_hari = [
    'Sunday' => 'Minggu',
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu'
];
$daftar_bulan = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
];

$hari_ini = $daftar_hari[$hari_inggris];
$tanggal_ini = date('d');
$bulan_ini = $daftar_bulan[$bulan_angka];
$tahun_ini = date('Y');
$tanggal_realtime = "$hari_ini, $tanggal_ini $bulan_ini $tahun_ini";

// Use data from controller
$total_gazebo = $total_gazebo ?? 0;
$gazebo_terisi = $gazebo_terisi ?? 0;
$gazebo_tersedia = $gazebo_tersedia ?? 0;
$jadwal = $jadwal ?? [];
$keyword = $search_keyword ?? '';

$persentase_okupansi = ($total_gazebo > 0) ? round(($gazebo_terisi / $total_gazebo) * 100) : 0;

// --- LOGIKA NOTIFIKASI GAZEBO HABIS WAKTU ---
$notifikasi_habis = [];
$current_time = time();
$today_date = date('Y-m-d');

if (is_array($jadwal)) {
    foreach ($jadwal as $booking) {
        if (!empty($booking['jam_selesai'])) {
            $booking_date = $booking['tanggal_booking'] ?? $today_date;
            $selesai_time = strtotime($booking_date . ' ' . $booking['jam_selesai']);
            
            if ($booking_date == $today_date && $current_time >= $selesai_time) {
                $notifikasi_habis[] = $booking;
            }
        }
    }
}
$jumlah_notif = count($notifikasi_habis);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="icon" type="image/webp" href="/assets/logo.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Taman Salma Shofa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif']
                    },
                    colors: {
                        brand: {
                            navy: '#2B2B43',
                            orange: '#e88d57',
                            lightOrange: '#FDF3ED',
                            bgLight: '#FAFAFB',
                            textDark: '#1A1A24',
                            textMuted: '#6B7280'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <!-- Premium UI Libraries -->
    <script src="/assets/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="/assets/css/flatpickr.min.css">
    <script src="/assets/js/flatpickr.min.js"></script>
    <script src="/assets/js/flatpickr-id.js"></script>
</head>

<body class="font-sans antialiased text-gray-800 bg-brand-bgLight flex h-screen overflow-hidden">

    <?php include __DIR__ . '/../shared/includes/sidebar.php'; ?>

    <main class="flex-1 flex flex-col h-full overflow-hidden bg-brand-bgLight max-w-full">

        <header class="h-[80px] bg-white border-b border-gray-100 flex items-center justify-between px-4 md:px-8 shrink-0">

            <div class="flex items-center gap-3 md:gap-4">
                <button id="openSidebarBtn" class="lg:hidden text-gray-500 hover:text-brand-orange focus:outline-none p-2">
                    <i class="fa-solid fa-bars text-xl md:text-2xl"></i>
                </button>

<form action="" method="GET" class="relative w-[140px] sm:w-[200px] md:w-[300px]">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </div>
                    <input type="text" name="search_booking" value="<?= htmlspecialchars($keyword) ?>" placeholder="Cari nama tamu..." class="w-full bg-[#F4F5F7] text-[13px] rounded-lg py-2 md:py-2.5 pl-10 pr-4 outline-none focus:ring-1 focus:ring-brand-orange transition-shadow">
                </form>
            </div>

            <div class="flex items-center gap-4 md:gap-6">
                <div class="hidden lg:flex items-center gap-3">
                    <a href="/" target="_blank" class="text-[12px] font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2.5 rounded-lg transition-colors"><i class="fa-solid fa-globe"></i> Lihat Website</a>
                    <button onclick="syncData(this)" id="btnSync" class="flex items-center gap-2 text-[12px] font-bold text-white bg-brand-orange hover:bg-[#d97c45] px-4 py-2.5 rounded-lg transition-all shadow-sm"><i class="fa-solid fa-arrows-rotate" id="syncIcon"></i> <span id="syncText">Sinkronkan</span></button>
                </div>

                <div class="hidden sm:flex flex-col text-right mr-2">
                    <span id="digitalClock" class="text-[16px] font-bold text-brand-navy leading-none">00:00:00</span>
                    <span class="text-[9px] font-bold text-brand-orange uppercase tracking-wider">WITA</span>
                </div>

                <div class="hidden md:block h-8 w-px bg-gray-200"></div>

                <div class="flex items-center gap-4 text-gray-500">
                    
                    <div class="relative group">
                        <button class="hover:text-brand-orange transition-colors relative">
                            <i class="fa-regular fa-bell text-[18px]"></i>
                            <?php if ($jumlah_notif > 0): ?>
                                <span id="notif-dot" class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
                            <?php endif; ?>
                        </button>
                        
                        <div class="absolute right-[-40px] md:right-0 mt-3 w-[280px] md:w-[320px] bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 p-2">
                            <div class="px-3 py-2 border-b border-gray-100 flex justify-between items-center mb-2">
                                <span class="text-[12px] font-bold text-gray-800">Notifikasi Berakhir</span>
                                <?php if ($jumlah_notif > 0): ?>
                                    <span id="notif-badge" class="bg-red-100 text-red-500 text-[9px] font-bold px-2 py-0.5 rounded-full"><?= $jumlah_notif ?> Baru</span>
                                <?php endif; ?>
                            </div>
                            
                            <div id="notif-list" class="max-h-[300px] overflow-y-auto no-scrollbar px-1">
                                <?php if ($jumlah_notif > 0): ?>
                                    <?php foreach ($notifikasi_habis as $notif): ?>
                                        <div class="p-3 mb-2 bg-red-50 border border-red-100 rounded-lg flex flex-col gap-3 notif-item">
                                            <div class="flex gap-3 items-start">
                                                <div class="w-8 h-8 rounded-full bg-white shadow-sm flex items-center justify-center text-red-500 shrink-0"><i class="fa-regular fa-clock text-xs"></i></div>
                                                <div>
                                                    <p class="text-[11px] font-bold text-gray-800 leading-tight">Waktu Habis: G-<?= htmlspecialchars($notif['nomor_gazebo'] ?? '-') ?></p>
                                                    <p class="text-[10px] text-gray-600 mt-0.5 leading-snug">Sewa atas nama <b><?= htmlspecialchars($notif['nama_pemesan'] ?? '-') ?></b> telah berakhir pada <?= date('H:i', strtotime($notif['jam_selesai'])) ?>.</p>
                                                </div>
                                            </div>
                                            <button onclick="clearNotif(this)" class="w-full text-[10px] font-bold bg-white text-gray-500 border border-gray-200 py-1.5 rounded hover:bg-gray-50 hover:text-gray-800 transition-colors shadow-sm">Oke, Bersihkan</button>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="p-6 text-center text-gray-400 flex flex-col items-center">
                                        <i class="fa-solid fa-check-circle text-3xl mb-2 opacity-30 text-green-500"></i>
                                        <p class="text-[11px] font-medium text-gray-500">Semua aman!</p>
                                        <p class="text-[10px]">Tidak ada gazebo yang lewat waktu.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="h-8 w-px bg-gray-200"></div>

                <div class="flex items-center gap-3 cursor-default select-none">
                    <div class="text-right hidden sm:block">
                        <p class="text-[14px] font-bold text-brand-textDark">Admin Salma</p>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider"></p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Admin+Salma&background=2B2B43&color=fff&rounded=true" class="w-8 h-8 md:w-10 md:h-10 rounded-full border-2 border-gray-100 shadow-sm pointer-events-none">
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto overflow-x-hidden no-scrollbar p-4 md:p-8">
            <div class="max-w-[1200px] mx-auto">

                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-4 mb-6 md:mb-8">
                    <div>
                        <h1 class="text-[24px] md:text-[28px] font-bold text-brand-textDark mb-1">Selamat Pagi, Salma!</h1>
                        <p class="text-brand-textMuted text-[13px] md:text-[14px]">Berikut ringkasan operasional Taman Salma Shofa hari ini.</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-lg px-4 py-2.5 flex items-center gap-3 shadow-sm text-[12px] md:text-[13.5px] font-bold text-gray-700 w-fit">
                        <i class="fa-regular fa-calendar text-brand-orange"></i>
                        <span class="border-r border-gray-200 pr-3"><?= $tanggal_realtime; ?></span>
                        <span id="jamDigital" class="text-brand-orange pl-1 w-[60px] md:w-[70px] text-center tracking-wider">00:00:00</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8 md:mb-10">
                    <div class="bg-white rounded-xl p-5 md:p-6 shadow-sm border-l-4 border-l-brand-navy flex justify-between items-start">
                        <div>
                            <p class="text-[10px] md:text-[11px] font-bold text-gray-400 uppercase mb-1">Total Gazebo</p>
                            <h2 class="text-[32px] md:text-[42px] font-bold text-brand-textDark leading-none mb-2"><?= sprintf("%02d", $total_gazebo) ?></h2>
                            <p class="text-[11px] md:text-[12px] text-gray-400">Kapasitas Maksimal Unit</p>
                        </div>
                        <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-[#F4F5F7] flex items-center justify-center text-brand-navy"><i class="fa-solid fa-house-chimney-window text-[18px] md:text-[22px]"></i></div>
                    </div>
                    <div class="bg-white rounded-xl p-5 md:p-6 shadow-sm border-l-4 border-l-[#C2511D] flex justify-between items-start">
                        <div>
                            <p class="text-[10px] md:text-[11px] font-bold text-gray-400 uppercase mb-1">Gazebo Terisi</p>
                            <h2 class="text-[32px] md:text-[42px] font-bold text-[#C2511D] leading-none mb-2"><?= sprintf("%02d", $gazebo_terisi) ?></h2>
                            <p class="text-[11px] md:text-[12px] text-gray-400"><?= $persentase_okupansi ?>% Okupansi Hari Ini</p>
                        </div>
                        <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-brand-lightOrange flex items-center justify-center text-[#C2511D]"><i class="fa-regular fa-calendar-check text-[18px] md:text-[22px]"></i></div>
                    </div>
                    <div class="bg-[#DDEAE9] rounded-xl p-5 md:p-6 shadow-sm border-l-4 border-l-[#3B82F6] flex justify-between items-start sm:col-span-2 lg:col-span-1">
                        <div>
                            <p class="text-[10px] md:text-[11px] font-bold text-gray-600 uppercase mb-1">Siap Booking</p>
                            <h2 class="text-[32px] md:text-[42px] font-bold text-[#1E3A8A] leading-none mb-2"><?= sprintf("%02d", $gazebo_tersedia) ?></h2>
                            <p class="text-[11px] md:text-[12px] text-gray-600">Tersedia untuk walk-in</p>
                        </div>
                        <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-white/50 flex items-center justify-center text-[#1E3A8A]"><i class="fa-solid fa-clipboard-check text-[18px] md:text-[22px]"></i></div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8 min-w-0">

                    <div class="lg:col-span-2 min-w-0">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 md:mb-5 gap-2">
                            <h3 class="text-[16px] md:text-[18px] font-bold text-brand-textDark">
                                <?= !empty($keyword) ? "Hasil Pencarian: '$keyword'" : "Jadwal Gazebo Hari Ini" ?>
                            </h3>
                            <?php if (count($jadwal) > 5 && empty($keyword)): ?>
                                <button type="button" onclick="toggleJadwal()" id="btnToggleTop" class="text-[12px] md:text-[13px] font-bold text-[#9C4B2E] hover:underline focus:outline-none">Lihat Semua Jadwal</button>
                            <?php else: ?>
                                <a href="status_gazebo" class="text-[12px] md:text-[13px] font-bold text-[#9C4B2E] hover:underline">Kelola Jadwal</a>
                            <?php endif; ?>
                        </div>

                        <div class="bg-white border border-gray-100 rounded-[14px] shadow-sm overflow-hidden overflow-x-auto w-full max-w-full">
                            <div class="min-w-[500px]">
                                <div class="grid grid-cols-12 gap-4 px-4 md:px-6 py-4 bg-[#F8F9FA] border-b border-gray-100 text-[10px] md:text-[11px] font-bold text-gray-400 uppercase">
                                    <div class="col-span-2">Gazebo</div>
                                    <div class="col-span-4">Nama Tamu</div>
                                    <div class="col-span-3">Waktu</div>
                                    <div class="col-span-3 text-center">Status</div>
                                </div>
                                <div class="divide-y divide-gray-100">
                                    <?php
                                    // Filter jadwal based on keyword if exists
                                    $filtered_jadwal = $jadwal;
                                    $is_searching = !empty($keyword);
                                    if ($is_searching) {
                                        $filtered_jadwal = array_filter($jadwal, function ($item) use ($keyword) {
                                            return stripos($item['nama_pemesan'] ?? '', $keyword) !== false;
                                        });
                                    }

                                    if (count($filtered_jadwal) > 0):
                                        $row_index = 0;
                                        foreach ($filtered_jadwal as $row):
                                            $jam_teks = "Seharian";
                                            if (!empty($row['jam_mulai']) && !empty($row['jam_selesai'])) {
                                                $jam_teks = date('H:i', strtotime($row['jam_mulai'])) . " - " . date('H:i', strtotime($row['jam_selesai']));
                                            }
                                            $status_label = ($row['durasi'] ?? '') == 'sewa_singkat' ? "SEDANG DIGUNAKAN" : "BOOKING AKTIF";
                                            $label_class = ($row['durasi'] ?? '') == 'sewa_singkat' ? "bg-[#FEE2E2] text-[#991B1B]" : "bg-brand-lightOrange text-[#C2511D]";
                                            
                                            $hidden_class = (!$is_searching && $row_index >= 5) ? "hidden extra-jadwal" : "";
                                    ?>
                                            <div class="grid grid-cols-12 gap-4 px-4 md:px-6 py-4 items-center hover:bg-gray-50 transition-colors <?= $hidden_class ?>">
                                                <div class="col-span-2 font-bold text-[13px] md:text-[14px] text-brand-textDark">G-<?= htmlspecialchars($row['nomor_gazebo'] ?? '-') ?></div>
                                                <div class="col-span-4">
                                                    <p class="font-bold text-[12px] md:text-[13.5px] truncate"><?= htmlspecialchars($row['nama_pemesan'] ?? '-') ?></p>
                                                    <p class="text-[10px] md:text-[11.5px] text-gray-400"><i class="fa-brands fa-whatsapp text-green-500 mr-1"></i><?= htmlspecialchars($row['no_whatsapp'] ?? '-') ?></p>
                                                    <?php
                                                    $jam_selesai_val = $row['jam_selesai'] ?? null;
                                                    // Ensure it's today's booking
                                                    $is_today_booking = ($row['tanggal_booking'] ?? date('Y-m-d')) == date('Y-m-d');
                                                    if ($jam_selesai_val && ($row['durasi'] ?? '') == 'sewa_singkat' && $is_today_booking):
                                                        $no_wa_clean = preg_replace('/[^0-9]/', '', $row['no_whatsapp'] ?? '');
                                                        $today_Ymd = date('Y-m-d');
                                                    ?>
                                                    <a href="#" target="_blank" class="btn-pengingat hidden mt-1 inline-flex items-center gap-1 bg-[#25D366] hover:bg-[#1DA851] text-white text-[9px] md:text-[10px] font-bold px-2 py-0.5 rounded shadow-sm transition-colors" 
                                                       data-endtime="<?= date('Y-m-d\TH:i:s', strtotime($today_Ymd . ' ' . $jam_selesai_val)) ?>"
                                                       data-nama="<?= htmlspecialchars($row['nama_pemesan'] ?? 'Tamu', ENT_QUOTES) ?>"
                                                       data-nomor="<?= htmlspecialchars($row['nomor_gazebo'] ?? '-', ENT_QUOTES) ?>"
                                                       data-jam="<?= date('H:i', strtotime($jam_selesai_val)) ?>"
                                                       data-admin="<?= htmlspecialchars($admin_wa, ENT_QUOTES) ?>"
                                                       data-phone="<?= $no_wa_clean ?>">
                                                        <i class="fa-brands fa-whatsapp text-[10px]"></i> Kirim Pengingat
                                                    </a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-span-3 flex items-center gap-1 md:gap-2 text-[11px] md:text-[13px] text-gray-600"><i class="fa-regular fa-clock text-gray-400 hidden sm:inline-block"></i><?= $jam_teks ?></div>
                                                <div class="col-span-3 text-center">
                                                    <span class="<?= $label_class ?> text-[8px] md:text-[9.5px] font-bold px-2 py-1 md:px-3 md:py-1.5 rounded-full whitespace-nowrap block text-center truncate"><?= $status_label ?></span>
                                                </div>
                                            </div>
                                        <?php 
                                        $row_index++;
                                        endforeach;
                                    else: ?>
                                        <div class="py-10 text-center text-gray-400">
                                            <i class="fa-solid fa-magnifying-glass text-3xl mb-2 opacity-50 block"></i>
                                            <p class="text-[13px]">
                                                <?= !empty($keyword) ? "Booking untuk '$keyword' tidak ditemukan." : "Belum ada jadwal hari ini." ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if (count($jadwal) > 5 && empty($keyword)): ?>
                            <div class="p-4 border-t border-gray-100 flex justify-center bg-gray-50">
                                <button type="button" onclick="toggleJadwal()" id="btnToggleBottom" class="text-[12px] md:text-[13px] font-bold text-brand-orange hover:text-white border border-brand-orange hover:bg-brand-orange px-5 py-2 rounded-lg transition-all shadow-sm focus:outline-none">Tampilkan Lebih Banyak</button>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

<div class="lg:col-span-1 space-y-4 min-w-0">
                        <h3 class="text-[16px] md:text-[18px] font-bold text-brand-textDark mb-1">Info Fasilitas</h3>

                        <div class="bg-gradient-to-br from-[#2B2B43] to-[#42425c] rounded-[20px] p-7 shadow-md relative overflow-hidden flex flex-col justify-between h-[230px]">
                            <i class="fa-solid fa-boxes-stacked absolute -right-4 -bottom-6 text-[110px] text-white opacity-5 pointer-events-none"></i>
                            
                            <div class="relative z-10">
                                <p class="text-[11px] font-bold text-gray-300 uppercase tracking-widest mb-2">Total Terdaftar</p>
                                <div class="flex items-baseline gap-2">
                                    <h2 class="text-[56px] font-black text-white leading-none">
                                        <?= sprintf("%02d", $total_fasilitas ?? 0) ?>
                                    </h2>
                                    <span class="text-[14px] text-gray-400 font-medium tracking-wide">Item</span>
                                </div>
                            </div>
                            
                            <div class="relative z-10 mt-auto grid grid-cols-2 gap-4 border-t border-white/10 pt-4">
                                <div>
                                    <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Utama</p>
                                    <p class="text-[18px] font-bold text-white"><?= sprintf("%02d", $total_utama ?? 0) ?> <span class="text-[10px] font-normal text-gray-400">Item</span></p>
                                </div>
                                <div class="border-l border-white/10 pl-4">
                                    <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Pendukung</p>
                                    <p class="text-[18px] font-bold text-white"><?= sprintf("%02d", $total_pendukung ?? 0) ?> <span class="text-[10px] font-normal text-gray-400">Item</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Logika Jam Digital Real-time
        function updateClock() {
            const now = new Date();
            const jam = String(now.getHours()).padStart(2, '0');
            const menit = String(now.getMinutes()).padStart(2, '0');
            const detik = String(now.getSeconds()).padStart(2, '0');
            const clockElement = document.getElementById('digitalClock');
            if(clockElement) clockElement.innerText = `${jam}:${menit}:${detik}`;
        }
        setInterval(updateClock, 1000);
        updateClock(); // Jalankan langsung

        // Logika Toggle Jadwal Gazebo
        let isJadwalExpanded = false;
        function toggleJadwal() {
            isJadwalExpanded = !isJadwalExpanded;
            const extraRows = document.querySelectorAll('.extra-jadwal');
            const btnTop = document.getElementById('btnToggleTop');
            const btnBottom = document.getElementById('btnToggleBottom');

            extraRows.forEach(row => {
                if (isJadwalExpanded) {
                    row.classList.remove('hidden');
                } else {
                    row.classList.add('hidden');
                }
            });

            if (isJadwalExpanded) {
                if (btnTop) btnTop.innerText = "Sembunyikan Sebagian";
                if (btnBottom) btnBottom.innerText = "Tampilkan Lebih Sedikit";
            } else {
                if (btnTop) btnTop.innerText = "Lihat Semua Jadwal";
                if (btnBottom) btnBottom.innerText = "Tampilkan Lebih Banyak";
            }
        }

        // Logika Menghapus Notifikasi secara dinamis (DITINGKATKAN DENGAN SWEETALERT)
        function clearNotif(btn) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Bersihkan notifikasi ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#E88D57',
                cancelButtonColor: '#2B2B43',
                confirmButtonText: 'Ya, Bersihkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Hapus box notifikasi yang diklik
                    const notifItem = btn.closest('.notif-item');
                    notifItem.remove();

                    // Cek apakah masih ada notifikasi lain
                    const notifList = document.getElementById('notif-list');
                    if (notifList && notifList.children.length === 0) {
                        // Hilangkan titik merah di lonceng
                        const dot = document.getElementById('notif-dot');
                        if (dot) dot.remove();

                        // Hilangkan badge "Baru"
                        const badge = document.getElementById('notif-badge');
                        if (badge) badge.remove();

                        // Ganti dengan tampilan kosong
                        notifList.innerHTML = `
                            <div class="p-6 text-center text-gray-400 flex flex-col items-center">
                                <i class="fa-solid fa-check-circle text-3xl mb-2 opacity-30 text-green-500"></i>
                                <p class="text-[11px] font-medium text-gray-500">Semua aman!</p>
                                <p class="text-[10px]">Tidak ada gazebo yang lewat waktu.</p>
                            </div>
                        `;
                    }
                }
            });
        }

        // Logika Jam Digital
        function jalankanJam() {
            const waktu = new Date();
            const jam = String(waktu.getHours()).padStart(2, '0');
            const menit = String(waktu.getMinutes()).padStart(2, '0');
            const detik = String(waktu.getSeconds()).padStart(2, '0');
            document.getElementById('jamDigital').innerText = `${jam}:${menit}:${detik}`;
        }
        setInterval(jalankanJam, 1000);
        jalankanJam();

        // Logika Tombol Sinkronisasi
        function syncData(btn) {
            const icon = document.getElementById('syncIcon');
            const text = document.getElementById('syncText');
            if (btn.disabled) return;
            btn.disabled = true;
            icon.classList.add('fa-spin');
            text.textContent = 'Sinkronisasi...';
            setTimeout(() => {
                icon.classList.remove('fa-spin');
                icon.classList.replace('fa-arrows-rotate', 'fa-check');
                text.textContent = 'Selesai!';
                btn.classList.replace('bg-brand-orange', 'bg-emerald-500');
                setTimeout(() => {
                    icon.classList.replace('fa-check', 'fa-arrows-rotate');
                    text.textContent = 'Sinkronkan';
                    btn.classList.replace('bg-emerald-500', 'bg-brand-orange');
                    btn.disabled = false;
                }, 2000);
            }, 1500);
        }

        // --- LOGIKA SIDEBAR MOBILE ---
        const sidebar = document.getElementById('sidebar');
        const openBtn = document.getElementById('openSidebarBtn');
        const closeBtn = document.getElementById('closeSidebarBtn');
        const overlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            overlay.classList.remove('hidden');
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                overlay.classList.add('opacity-100');
            }, 10);
        }

        function closeSidebar() {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0');
            setTimeout(() => {
                overlay.classList.add('hidden');
            }, 300);
        }

        if (openBtn) openBtn.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if (overlay) overlay.addEventListener('click', closeSidebar);

        // Audio Alert Setup
        let audioCtx;
        let alarmedTimers = new Set();

        function playTone(freq, startTime, duration) {
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            osc.type = 'sine';
            osc.frequency.value = freq;
            
            gain.gain.setValueAtTime(0, startTime);
            gain.gain.linearRampToValueAtTime(0.15, startTime + 0.02);
            gain.gain.exponentialRampToValueAtTime(0.001, startTime + duration);
            
            osc.connect(gain);
            gain.connect(audioCtx.destination);
            osc.start(startTime);
            osc.stop(startTime + duration);
        }

        function playBeep() {
            try {
                if (!audioCtx) audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                if (audioCtx.state === 'suspended') audioCtx.resume();
                
                const now = audioCtx.currentTime;
                // WA Web-like chime: C6 (1046 Hz) then E6 (1318 Hz)
                playTone(1046.50, now, 0.15); 
                playTone(1318.51, now + 0.15, 0.3);
            } catch(e) {
                console.log("Audio alert blocked or not supported");
            }
        }

        // WA Reminder Countdown Logic
        function updateCountdowns() {
            const btns = document.querySelectorAll('.btn-pengingat');
            const now = new Date().getTime();

            btns.forEach(btn => {
                const endTimeStr = btn.getAttribute('data-endtime');
                if (!endTimeStr) return;
                
                const endTime = new Date(endTimeStr).getTime();
                const distance = endTime - now;
                
                if (distance < 0) {
                    if (!alarmedTimers.has(endTimeStr)) {
                        playBeep();
                        alarmedTimers.add(endTimeStr);
                    }
                    btn.classList.add('hidden');
                } else if (distance > 0 && distance <= 1800000) { // <= 30 mins
                    btn.classList.remove('hidden');
                    const totalSisaMenit = Math.ceil(distance / (1000 * 60));
                    const nama = btn.getAttribute('data-nama');
                    const nomor = btn.getAttribute('data-nomor');
                    const jam = btn.getAttribute('data-jam');
                    const adminWa = btn.getAttribute('data-admin');
                    const phone = btn.getAttribute('data-phone');
                    
                    if(nama && phone) {
                        const pesanWa = `Halo Kak ${nama}, sekadar mengingatkan bahwa waktu sewa Gazebo - ${nomor} Anda tersisa ${totalSisaMenit} menit lagi (pukul ${jam}). Jika ada pertanyaan atau ingin perpanjang, hubungi Admin di WA: +${adminWa}. Terima kasih!`;
                        btn.href = `https://wa.me/${phone}?text=${encodeURIComponent(pesanWa)}`;
                    }
                } else {
                    btn.classList.add('hidden');
                }
            });
        }
        setInterval(updateCountdowns, 1000);
        updateCountdowns();
    </script>
</body>

</html>