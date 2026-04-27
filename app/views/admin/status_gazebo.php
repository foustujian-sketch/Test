<?php
date_default_timezone_set('Asia/Makassar');
$tanggal_filter = $tanggal_filter ?? date('Y-m-d');
$waktu_sekarang = date('H:i:s');

$gazebos = $gazebos ?? [];
$bookings = $bookings ?? [];
$booked_gazebos = $booked_gazebos ?? [];

// Build booked data array
$booked_data = [];
foreach ($bookings as $row) {
    $booked_data[$row['gazebo_id'] ?? ''] = $row;
}

$settingsFile = __DIR__ . '/../../config/settings.json';
$admin_wa = '628125814305';
if (file_exists($settingsFile)) {
    $settings = json_decode(file_get_contents($settingsFile), true);
    $admin_wa = $settings['admin_wa_pengingat'] ?? $admin_wa;
}

// Fallback for Indonesian Date Formatting if IntlDateFormatter is not available
$timestamp = strtotime($tanggal_filter);
$hari_array = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
$bulan_array = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

$hari = $hari_array[date('w', $timestamp)];
$tanggal = date('j', $timestamp);
$bulan = $bulan_array[(int)date('n', $timestamp)];
$tahun = date('Y', $timestamp);

$tanggal_tampil = "$hari, $tanggal $bulan $tahun";

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/webp" href="/assets/logo.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Status Gazebo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'], },
                    colors: {
                        brand: { navy: '#2B2B43', orange: '#E88D57', bgLight: '#FAFAFB', textDark: '#1A1A24', green: '#10B981', blue: '#3B82F6', booking: '#E28E66' }
                    }
                }
            }
        }
    </script>
    <style> 
        .no-scrollbar::-webkit-scrollbar { display: none; } 
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; } 
        input[type="time"]::-webkit-calendar-picker-indicator, input[type="date"]::-webkit-calendar-picker-indicator { opacity: 0; position: absolute; width: 100%; height: 100%; cursor: pointer; } 
        .swal2-container { z-index: 99999 !important; }
    </style>

    <!-- Premium UI Libraries -->
    <script src="/assets/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="/assets/css/flatpickr.min.css">
    <script src="/assets/js/flatpickr.min.js"></script>
    <script src="/assets/js/flatpickr-id.js"></script>
</head>
<body class="font-sans antialiased text-gray-800 bg-brand-bgLight flex h-screen overflow-hidden">

    <?php include __DIR__ . '/../shared/includes/sidebar.php'; ?>

    <main class="flex-1 flex flex-col h-full overflow-hidden bg-brand-bgLight w-full relative z-0">
        
        <header class="h-[80px] bg-white border-b border-gray-100 flex items-center justify-between px-4 md:px-8 shrink-0">
            <div class="flex items-center gap-3 md:gap-4">
                <button id="openSidebarBtn" class="lg:hidden text-gray-500 hover:text-brand-orange focus:outline-none p-2">
                    <i class="fa-solid fa-bars text-xl md:text-2xl"></i>
                </button>
            </div>

            <div class="flex items-center gap-4 md:gap-6">
                <a href="/" target="_blank" class="hidden md:flex text-[12px] font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2.5 rounded-lg transition-colors items-center gap-2">
                    <i class="fa-solid fa-globe"></i> Lihat Website
                </a>
                <div class="hidden md:block h-8 w-px bg-gray-200"></div>
                <div class="flex items-center gap-3 cursor-default select-none">
                    <div class="text-right hidden sm:block">
                        <p class="text-[14px] font-bold text-brand-textDark">Admin Salma</p>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider"></p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Admin+Salma&background=2B2B43&color=fff&rounded=true" class="w-8 h-8 md:w-10 md:h-10 rounded-full border-2 border-gray-100 shadow-sm pointer-events-none">
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto no-scrollbar p-4 md:p-10 pt-6 md:pt-12 w-full">
            <div class="max-w-[1400px] mx-auto">
                
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-[24px] md:text-[32px] font-bold text-brand-textDark mb-1">Manajemen Status Gazebo</h1>
                        <p class="text-gray-500 text-[13px] md:text-[15px]">Pantau dan kelola ketersediaan 21 gazebo secara real-time.</p>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-4 md:gap-5">
                        <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-brand-green"></div><span class="text-[10px] md:text-[11px] font-bold text-gray-500 uppercase tracking-wider">Tersedia</span></div>
                        <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-brand-blue"></div><span class="text-[10px] md:text-[11px] font-bold text-gray-500 uppercase tracking-wider">Sewa Di Tempat</span></div>
                        <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-brand-booking"></div><span class="text-[10px] md:text-[11px] font-bold text-gray-500 uppercase tracking-wider">Booking</span></div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 md:gap-6 mb-10">
                    <div class="bg-[#EAECEE] p-1.5 rounded-xl flex items-center overflow-x-auto no-scrollbar">
                        <button onclick="filterGazebo('semua', this)" class="filter-btn bg-[#5C5E75] text-white px-4 md:px-6 py-2.5 rounded-lg text-[12px] md:text-[13.5px] font-semibold shadow-sm shrink-0">Semua</button>
                        <button onclick="filterGazebo('tersedia', this)" class="filter-btn text-gray-500 hover:text-gray-800 px-4 md:px-6 py-2.5 rounded-lg text-[12px] md:text-[13.5px] font-semibold transition-colors shrink-0">Tersedia</button>
                        <button onclick="filterGazebo('sewa_singkat', this)" class="filter-btn text-gray-500 hover:text-gray-800 px-4 md:px-6 py-2.5 rounded-lg text-[12px] md:text-[13.5px] font-semibold transition-colors shrink-0">Sewa < 4 Jam</button>
                        <button onclick="filterGazebo('sewa_lama', this)" class="filter-btn text-gray-500 hover:text-gray-800 px-4 md:px-6 py-2.5 rounded-lg text-[12px] md:text-[13.5px] font-semibold transition-colors shrink-0">Booking Seharian</button>
                    </div>

                    <form action="" method="GET" class="relative bg-white border border-gray-200 rounded-xl px-4 md:px-5 py-3 flex items-center justify-between gap-4 md:gap-6 shadow-sm cursor-pointer w-full md:w-auto md:min-w-[250px]">
                        <div class="flex items-center gap-3">
                            <i class="fa-regular fa-calendar text-brand-orange text-lg"></i>
                            <div class="flex flex-col">
                                <span class="text-[8px] md:text-[9px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Pilih Tanggal</span>
                                <span class="text-[12px] md:text-[13.5px] font-bold text-gray-800 leading-none" id="currentDateDisplay"><?= $tanggal_tampil ?></span>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                        <input type="text" id="datePicker" name="tanggal" value="<?= $tanggal_filter ?>" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full">
                    </form>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php 
                    foreach($gazebos as $gazebo): 
                        $gz_id = $gazebo['id'] ?? '';
                        $nomor = $gazebo['nomor_gazebo'] ?? '';
                        $kapasitas = $gazebo['kapasitas'] ?? 0;
                        
                        if(isset($booked_data[$gz_id])) {
                            $book = $booked_data[$gz_id];
                            $nama_pemesan = $book['nama_pemesan'] ?? 'Tamu';
                            $no_hp = $book['no_whatsapp'] ?? '';
                            $durasi = isset($book['durasi']) ? strtolower($book['durasi']) : 'sewa_singkat';
                            $jam_mulai = isset($book['jam_mulai']) ? date('H:i', strtotime($book['jam_mulai'])) : '';
                            $jam_selesai = isset($book['jam_selesai']) ? date('H:i', strtotime($book['jam_selesai'])) : '';
                            
                            // LOGIKA WAKTU HABIS MENGGUNAKAN TIMESTAMP
                            $is_waktu_habis = false;
                            if ($tanggal_filter == date('Y-m-d') && !empty($book['jam_selesai'])) {
                                $selesai_time = strtotime($tanggal_filter . ' ' . $book['jam_selesai']);
                                if (time() >= $selesai_time) {
                                    $is_waktu_habis = true;
                                }
                            }
                            if($durasi == 'sewa_lama' || $durasi == 'booking') {
                                $teks_durasi = ($durasi == 'booking') ? 'BOOKING DIMUKA' : 'SEHARIAN';
                    ?>
                                <div class="gazebo-card bg-[#FFF8F5] rounded-[18px] p-6 border border-[#FDEAE2] shadow-sm flex flex-col justify-between min-h-[230px]" data-status="sewa_lama">
                                    <div>
                                        <div class="flex justify-between items-start mb-2">
                                            <h3 class="text-[18px] font-bold text-brand-textDark">Gazebo - <?= $nomor ?></h3>
                                        </div>
                                        <span class="inline-block bg-[#FDEAE2] text-brand-booking text-[9px] font-bold px-2 py-1 rounded uppercase tracking-wider"><?= $kapasitas ?> Orang</span>
                                    </div>
                                    <div class="mt-4 mb-4">
                                        <p class="text-brand-textDark font-bold text-[14px] mb-0.5 truncate"><?= htmlspecialchars($nama_pemesan) ?></p>
                                        <p class="text-brand-booking text-[11px] font-bold uppercase tracking-wider"><?= $teks_durasi ?></p>
                                    </div>
                                    <button type="button" onclick="openModal('lihat', '<?= $gz_id ?>', '<?= $nomor ?>', '<?= htmlspecialchars($nama_pemesan, ENT_QUOTES) ?>', '<?= $no_hp ?>', '<?= $durasi ?>', '<?= $jam_mulai ?>', '<?= $jam_selesai ?>')" class="w-full bg-brand-booking text-white font-semibold text-[13px] py-2.5 rounded-lg hover:bg-[#cf7b56] transition-colors shadow-sm">
                                        Lihat Booking
                                    </button>
                                </div>
                    <?php
                            } else {
                    ?>          
                                <div class="gazebo-card <?= $is_waktu_habis ? 'bg-[#FEF2F2] border-[#FCA5A5]' : 'bg-[#F5F8FF] border-[#E0E7FF]' ?> rounded-[18px] p-6 border shadow-sm flex flex-col justify-between min-h-[230px]" data-status="sewa_singkat">
                                    <div>
                                        <div class="flex justify-between items-start mb-2">
                                            <h3 class="text-[18px] font-bold text-brand-textDark">Gazebo - <?= $nomor ?></h3>
                                            <?php if($is_waktu_habis): ?>
                                                <span class="bg-red-500 text-white text-[9px] font-bold px-2 py-1 rounded shadow-sm animate-pulse">WAKTU HABIS</span>
                                            <?php endif; ?>
                                        </div>
                                        <span class="inline-block <?= $is_waktu_habis ? 'bg-red-100 text-red-500' : 'bg-[#E0E7FF] text-brand-blue' ?> text-[9px] font-bold px-2 py-1 rounded uppercase tracking-wider"><?= $kapasitas ?> Orang</span>
                                    </div>
                                    <div class="mt-4 mb-4">
                                        <p class="text-brand-textDark font-bold text-[14px] mb-0.5 truncate"><?= htmlspecialchars($nama_pemesan) ?></p>
                                        <div class="flex flex-col gap-1">
                                            <p class="<?= $is_waktu_habis ? 'text-red-500' : 'text-brand-blue' ?> text-[13px] font-semibold tracking-wide">
                                                <?= ($jam_mulai && $jam_selesai) ? "$jam_mulai - $jam_selesai" : "Sewa < 4 Jam" ?>
                                            </p>
                                            <?php if (!$is_waktu_habis && $jam_selesai && $tanggal_filter == date('Y-m-d')): ?>
                                                <p class="text-[12px] font-bold text-brand-orange countdown-timer" data-endtime="<?= date('Y-m-d\TH:i:s', strtotime($tanggal_filter . ' ' . $jam_selesai)) ?>"></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <button type="button" onclick="openModal('lihat_biru', '<?= $gz_id ?>', '<?= $nomor ?>', '<?= htmlspecialchars($nama_pemesan, ENT_QUOTES) ?>', '<?= $no_hp ?>', 'sewa_singkat', '<?= $jam_mulai ?>', '<?= $jam_selesai ?>')" class="w-full <?= $is_waktu_habis ? 'bg-red-500 hover:bg-red-600' : 'bg-brand-blue hover:bg-blue-600' ?> text-white font-semibold text-[13px] py-2.5 rounded-lg transition-colors shadow-sm mb-2">
                                        Selesaikan
                                    </button>
                                    <?php 
                                    if (!$is_waktu_habis && $jam_selesai && $tanggal_filter == date('Y-m-d')):
                                        $no_wa_clean = preg_replace('/[^0-9]/', '', $no_hp);
                                    ?>
                                    <a href="#" target="_blank" class="btn-pengingat hidden w-full bg-[#25D366] hover:bg-[#1DA851] text-white font-semibold text-[13px] py-2.5 rounded-lg transition-colors shadow-sm flex items-center justify-center gap-2"
                                       data-nama="<?= htmlspecialchars($nama_pemesan, ENT_QUOTES) ?>"
                                       data-nomor="<?= htmlspecialchars($nomor, ENT_QUOTES) ?>"
                                       data-jam="<?= htmlspecialchars($jam_selesai, ENT_QUOTES) ?>"
                                       data-admin="<?= htmlspecialchars($admin_wa, ENT_QUOTES) ?>"
                                       data-phone="<?= $no_wa_clean ?>">
                                        <i class="fa-brands fa-whatsapp"></i> Kirim Pengingat WA
                                    </a>
                                    <?php endif; ?>
                                </div>
                    <?php
                            }
                        } else {
                    ?>
                            <div class="gazebo-card bg-white rounded-[18px] p-6 border border-gray-100 shadow-sm flex flex-col justify-between min-h-[230px]" data-status="tersedia">
                                <div>
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="text-[18px] font-bold text-brand-textDark">Gazebo - <?= $nomor ?></h3>
                                    </div>
                                    <span class="inline-block bg-[#F4F5F7] text-gray-400 text-[9px] font-bold px-2 py-1 rounded uppercase tracking-wider"><?= $kapasitas ?> Orang</span>
                                </div>
                                <div class="mt-4 mb-4">
                                    <p class="text-brand-green font-bold text-[14px] mb-0.5">Tersedia</p>
                                    <p class="text-gray-400 text-[12px]">Siap digunakan</p>
                                </div>
                                <button type="button" onclick="openModal('atur', '<?= $gz_id ?>', '<?= $nomor ?>', '', '', '', '', '')" class="w-full bg-[#F9FAFB] border border-gray-100 text-gray-400 font-semibold text-[13px] py-2.5 rounded-lg hover:bg-gray-100 hover:text-gray-600 transition-colors">
                                    Atur Status
                                </button>
                            </div>
                    <?php } endforeach; ?>
                </div>
            </div>
        </div>
    </main>

    <div id="modalOverlay" class="fixed inset-0 bg-black/40 z-[9998] hidden opacity-0 transition-opacity duration-300 backdrop-blur-sm" onclick="closeModal()"></div>

    <div id="modalPanel" class="fixed inset-y-0 right-0 w-full md:w-full max-w-[420px] bg-white z-[9999] transform translate-x-full transition-transform duration-300 shadow-[0_0_40px_rgba(0,0,0,0.2)] flex flex-col">
        <div class="px-7 py-6 flex justify-between items-start">
            <div>
                <h2 id="modalTitle" class="text-[22px] font-bold text-brand-textDark leading-tight">Detail Gazebo</h2>
                <p class="text-[13px] text-gray-500 mt-1">Kelola status dan informasi penyewa</p>
            </div>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-900 transition-colors bg-gray-100 hover:bg-gray-200 w-8 h-8 rounded-full flex items-center justify-center"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <form action="proses_gazebo" method="POST" id="formGazebo" class="flex flex-col flex-1 overflow-hidden">
            <input type="hidden" name="gazebo_id" id="inputIdGazebo">
            <input type="hidden" name="tanggal_kunjungan" value="<?= $tanggal_filter ?>">
            
            <div class="flex-1 overflow-y-auto px-7 py-2 space-y-6">
                <div id="modalStatusBanner" class="bg-[#EEF2FF] rounded-[14px] p-4 flex items-center gap-4 transition-colors">
                    <div id="modalStatusIconContainer" class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-[#4F46E5] shadow-sm shrink-0"><i class="fa-solid fa-border-all text-[20px]"></i></div>
                    <div>
                        <p id="modalStatusLabel" class="text-[10px] font-bold text-[#4F46E5] uppercase tracking-wider mb-0.5">Status Saat Ini</p>
                        <p id="modalStatusText" class="text-[16px] font-bold text-[#3730A3] leading-none">Sewa di tempat</p>
                    </div>
                </div>

               <div class="space-y-4">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Nama Penyewa / Booking</label>
                        <input type="text" name="nama_pemesan" id="inputNama" 
                               onkeypress="return /^[a-zA-Z\s]*$/i.test(event.key)" 
                               class="w-full border border-gray-200 rounded-xl p-3.5 text-[14px] text-brand-textDark font-medium outline-none focus:border-brand-orange transition-all" 
                               required>
                    </div>
                    
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Nomor Telepon</label>
                        <input type="text" name="no_whatsapp" id="inputTelepon" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric" class="w-full border border-gray-200 rounded-xl p-3.5 text-[14px] text-brand-textDark font-medium outline-none focus:border-brand-orange transition-all" required>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3">Tipe Layanan</label>
                        <div class="space-y-2.5">
                            <label class="radio-container flex items-center gap-3 border border-brand-orange bg-[#FFF8F5] rounded-xl p-3.5 cursor-pointer transition-all">
                                <input type="radio" name="durasi" value="sewa_singkat" class="accent-brand-orange w-4 h-4" checked onchange="toggleTimeInputs(true)">
                                <span class="text-[14px] font-medium text-brand-textDark">Sewa &lt; 4 Jam</span>
                            </label>
                            
                            <div id="timeInputsContainer" class="flex gap-3 ml-7 pb-2 transition-all">
                                <div class="relative flex-1">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"><i class="fa-regular fa-clock"></i></span>
                                    <input type="time" name="jam_mulai" id="inputJamMulai" class="w-full border border-gray-200 rounded-lg py-2 pl-8 pr-3 text-[13px] text-gray-600 focus:border-brand-orange outline-none">
                                </div>
                                <span class="text-gray-400 self-center text-[12px] font-bold">ke</span>
                                <div class="relative flex-1">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"><i class="fa-regular fa-clock"></i></span>
                                    <input type="time" name="jam_selesai" id="inputJamSelesai" class="w-full border border-gray-200 rounded-lg py-2 pl-8 pr-3 text-[13px] text-gray-600 focus:border-brand-orange outline-none">
                                </div>
                            </div>

                            <label class="radio-container flex items-center gap-3 border border-gray-200 rounded-xl p-3.5 cursor-pointer transition-all hover:bg-gray-50">
                                <input type="radio" name="durasi" value="sewa_lama" class="accent-brand-orange w-4 h-4" onchange="toggleTimeInputs(false)">
                                <span class="text-[14px] font-medium text-gray-600">Sewa &gt; 4 Jam / Seharian</span>
                            </label>
                            <label class="radio-container flex items-center gap-3 border border-gray-200 rounded-xl p-3.5 cursor-pointer transition-all hover:bg-gray-50">
                                <input type="radio" name="durasi" value="booking" class="accent-brand-orange w-4 h-4" onchange="toggleTimeInputs(false)">
                                <span class="text-[14px] font-medium text-gray-600">Booking Dimuka</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-7 border-t border-gray-100 bg-white pt-5">
                <button type="submit" name="action" value="save" class="w-full bg-[#E39873] hover:bg-[#d48761] text-white font-bold text-[14px] py-3.5 rounded-xl transition-colors shadow-sm flex items-center justify-center gap-2">
                    <i class="fa-regular fa-floppy-disk"></i> Simpan Perubahan
                </button>
                <button type="button" onclick="confirmDelete()" class="w-full mt-3 text-[#DC2626] hover:bg-red-50 font-bold text-[14px] py-3.5 rounded-xl transition-colors flex items-center justify-center gap-2 border border-transparent hover:border-red-100">
                    <i class="fa-solid fa-check-double"></i> Selesaikan (Kosongkan Status)
                </button>
                <input type="submit" name="action" value="delete" id="realDeleteBtn" style="display:none">
            </div>
        </form>
    </div>

    <script>
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

        if(openBtn) openBtn.addEventListener('click', openSidebar);
        if(closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if(overlay) overlay.addEventListener('click', closeSidebar);

        function confirmDelete() {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Yakin ingin menyelesaikan dan mengosongkan gazebo ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DC2626',
                cancelButtonColor: '#2B2B43',
                confirmButtonText: 'Ya, Selesaikan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('realDeleteBtn').click();
                }
            });
        }

        // Initialize Flatpickr
        flatpickr("#datePicker", {
            locale: "id",
            dateFormat: "Y-m-d",
            minDate: "today",
            defaultDate: "<?= $tanggal_filter ?>",
            onChange: function(selectedDates, dateStr, instance) {
                instance.element.form.submit();
            }
        });
    </script>

    <script>
        function toggleTimeInputs(show) {
            const timeContainer = document.getElementById('timeInputsContainer');
            if(show) {
                timeContainer.style.display = 'flex';
            } else {
                timeContainer.style.display = 'none';
                document.getElementById('inputJamMulai').value = '';
                document.getElementById('inputJamSelesai').value = '';
            }
        }

        function filterGazebo(status, btn) {
            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(b => {
                b.classList.remove('bg-[#5C5E75]', 'text-white', 'shadow-sm');
                b.classList.add('text-gray-500', 'hover:text-gray-800');
            });
            btn.classList.remove('text-gray-500', 'hover:text-gray-800');
            btn.classList.add('bg-[#5C5E75]', 'text-white', 'shadow-sm');

            const cards = document.querySelectorAll('.gazebo-card');
            cards.forEach(card => {
                if (status === 'semua' || card.getAttribute('data-status') === status) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function openModal(mode, idGazebo, gazeboNum, namaPemesan, noTelp, tipeLayanan, jamMulai, jamSelesai) {
            const overlay = document.getElementById('modalOverlay');
            const panel = document.getElementById('modalPanel');
            const radios = document.querySelectorAll('input[name="durasi"]');
            
            document.getElementById('modalTitle').textContent = `Detail Gazebo ${gazeboNum}`;
            document.getElementById('inputIdGazebo').value = idGazebo;

            const inputNama = document.getElementById('inputNama');
            const inputTelepon = document.getElementById('inputTelepon');
            const inputJamMulai = document.getElementById('inputJamMulai');
            const inputJamSelesai = document.getElementById('inputJamSelesai');
            
            const statusBanner = document.getElementById('modalStatusBanner');
            const statusIconContainer = document.getElementById('modalStatusIconContainer');
            const statusLabel = document.getElementById('modalStatusLabel');
            const statusText = document.getElementById('modalStatusText');

            if (mode === 'atur') {
                inputNama.value = '';
                inputTelepon.value = '';
                inputJamMulai.value = '';
                inputJamSelesai.value = '';
                
                radios[0].checked = true; 
                radios[0].dispatchEvent(new Event('change')); 
                toggleTimeInputs(true);
                
                statusBanner.className = 'bg-[#ECFDF5] rounded-[14px] p-4 flex items-center gap-4 transition-colors';
                statusIconContainer.className = 'w-12 h-12 bg-white rounded-xl flex items-center justify-center text-[#059669] shadow-sm shrink-0';
                statusLabel.className = 'text-[10px] font-bold text-[#059669] uppercase tracking-wider mb-0.5';
                statusText.className = 'text-[16px] font-bold text-[#047857] leading-none';
                statusText.textContent = 'Tersedia';

            } else {
                inputNama.value = namaPemesan;
                inputTelepon.value = noTelp;
                inputJamMulai.value = jamMulai;
                inputJamSelesai.value = jamSelesai;
                
                radios.forEach(r => {
                    if(r.value === tipeLayanan) {
                        r.checked = true;
                        r.dispatchEvent(new Event('change'));
                        toggleTimeInputs(tipeLayanan === 'sewa_singkat');
                    }
                });

                if (mode === 'lihat_biru') {
                    statusBanner.className = 'bg-[#EEF2FF] rounded-[14px] p-4 flex items-center gap-4 transition-colors';
                    statusIconContainer.className = 'w-12 h-12 bg-white rounded-xl flex items-center justify-center text-[#4F46E5] shadow-sm shrink-0';
                    statusLabel.className = 'text-[10px] font-bold text-[#4F46E5] uppercase tracking-wider mb-0.5';
                    statusText.className = 'text-[16px] font-bold text-[#3730A3] leading-none';
                    statusText.textContent = 'Sewa di tempat';
                } else {
                    statusBanner.className = 'bg-[#FFF8F5] rounded-[14px] p-4 flex items-center gap-4 transition-colors';
                    statusIconContainer.className = 'w-12 h-12 bg-white rounded-xl flex items-center justify-center text-[#E88D57] shadow-sm shrink-0';
                    statusLabel.className = 'text-[10px] font-bold text-[#E88D57] uppercase tracking-wider mb-0.5';
                    statusText.className = 'text-[16px] font-bold text-[#cf7b56] leading-none';
                    statusText.textContent = (tipeLayanan === 'booking') ? 'Booking Dimuka' : 'Sewa Seharian';
                }
            }

            overlay.classList.remove('hidden');
            void overlay.offsetWidth; 
            overlay.classList.add('opacity-100');
            overlay.classList.remove('opacity-0');
            panel.classList.remove('translate-x-full');
            panel.classList.add('translate-x-0');
        }

        function closeModal() {
            const overlay = document.getElementById('modalOverlay');
            const panel = document.getElementById('modalPanel');
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0');
            panel.classList.remove('translate-x-0');
            panel.classList.add('translate-x-full');
            setTimeout(() => overlay.classList.add('hidden'), 300);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const radioContainers = document.querySelectorAll('.radio-container');
            const radios = document.querySelectorAll('input[type="radio"]');

            radios.forEach((radio, index) => {
                radio.addEventListener('change', () => {
                    radioContainers.forEach(container => {
                        container.classList.remove('border-brand-orange', 'bg-[#FFF8F5]');
                        container.classList.add('border-gray-200');
                        container.querySelector('span').classList.remove('text-brand-textDark');
                        container.querySelector('span').classList.add('text-gray-600');
                    });
                    
                    if(radio.checked) {
                        const activeContainer = radioContainers[index];
                        activeContainer.classList.add('border-brand-orange', 'bg-[#FFF8F5]');
                        activeContainer.classList.remove('border-gray-200');
                        activeContainer.querySelector('span').classList.add('text-brand-textDark');
                        activeContainer.querySelector('span').classList.remove('text-gray-600');
                    }
                });
            });
        });
    </script>
    
    <script>
    const inputNama = document.getElementById('inputNama');
    if (inputNama) {
        inputNama.addEventListener('input', function() {
            // Menghapus karakter selain huruf dan spasi secara otomatis
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
        });
    }

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

    // Countdown Timer Logic
    function updateCountdowns() {
        const timers = document.querySelectorAll('.countdown-timer');
        const now = new Date().getTime();

        timers.forEach(timer => {
            const endTimeStr = timer.getAttribute('data-endtime');
            if (!endTimeStr) return;
            
            const endTime = new Date(endTimeStr).getTime();
            const distance = endTime - now;
            
            const card = timer.closest('.gazebo-card');
            const btnPengingat = card ? card.querySelector('.btn-pengingat') : null;

            if (distance < 0) {
                if (!alarmedTimers.has(endTimeStr)) {
                    playBeep();
                    alarmedTimers.add(endTimeStr);
                }
                
                timer.innerHTML = "WAKTU HABIS";
                timer.classList.remove('text-brand-orange');
                timer.classList.add('text-red-500', 'animate-pulse');
                
                if (btnPengingat) btnPengingat.classList.add('hidden');
            } else {
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
                timer.innerHTML = `Sisa Waktu: ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                
                if (distance <= 1800000 && btnPengingat) { // 30 mins
                    btnPengingat.classList.remove('hidden');
                    const totalSisaMenit = Math.ceil(distance / (1000 * 60));
                    const nama = btnPengingat.getAttribute('data-nama');
                    const nomor = btnPengingat.getAttribute('data-nomor');
                    const jam = btnPengingat.getAttribute('data-jam');
                    const adminWa = btnPengingat.getAttribute('data-admin');
                    const phone = btnPengingat.getAttribute('data-phone');
                    
                    if(nama && phone) {
                        const pesanWa = `Halo Kak ${nama}, sekadar mengingatkan bahwa waktu sewa Gazebo - ${nomor} Anda tersisa ${totalSisaMenit} menit lagi (pukul ${jam}). Jika ada pertanyaan atau ingin perpanjang, hubungi Admin di WA: +${adminWa}. Terima kasih!`;
                        btnPengingat.href = `https://wa.me/${phone}?text=${encodeURIComponent(pesanWa)}`;
                    }
                } else if (btnPengingat) {
                    btnPengingat.classList.add('hidden');
                }
            }
        });
    }

    // Run every second
    setInterval(updateCountdowns, 1000);
    // Initial run
    updateCountdowns();
</script>
</body>
</html>