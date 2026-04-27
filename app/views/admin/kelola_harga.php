<?php
$columns = $columns ?? [];
$fasilitas = $fasilitas ?? [];

// Extract column names
$col_kurang = '';
$col_lebih = '';
foreach ($columns as $col) {
    if (strpos($col['Field'], '4jam') !== false) {
        if ($col_kurang == '') $col_kurang = $col['Field'];
        else $col_lebih = $col['Field'];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/webp" href="/assets/logo.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Harga - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] }, colors: { brand: { navy: '#2B2B43', orange: '#E88D57', bgLight: '#FAFAFB', textDark: '#1A1A24' } } } } }
    </script>
   <style> 
    body { font-family: 'Poppins', sans-serif; } 
    .no-scrollbar::-webkit-scrollbar { display: none; } 
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; } 
    
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none !important;
        margin: 0 !important;
    }
    input[type="number"] {
        -moz-appearance: textfield !important;
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

        <div class="flex-1 overflow-y-auto no-scrollbar p-4 md:p-8 w-full relative">
            <div class="max-w-[1100px] mx-auto">
                
                <a href="dashboard_admin" class="inline-flex items-center gap-2 text-[13px] font-bold text-gray-400 hover:text-brand-orange transition-colors mb-6 md:mb-8">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard Utama
                </a>

                <div class="flex justify-between items-start mb-8 md:mb-10">
                    <div>
                        <h1 class="text-[28px] md:text-[36px] font-extrabold text-brand-textDark mb-2 tracking-tight">Kelola Harga</h1>
                        <p class="text-gray-500 text-[13px] md:text-[14.5px] leading-relaxed max-w-[650px]">Atur dan perbarui daftar harga fasilitas.</p>
                    </div>
                </div>

                <div class="mb-20 overflow-x-auto no-scrollbar w-full">
                    <div class="bg-white border border-gray-100 rounded-[24px] shadow-sm overflow-hidden min-w-[700px]">
                        <div class="grid grid-cols-12 gap-4 px-4 md:px-8 py-5 bg-[#F8F9FA] text-[10px] md:text-[11px] font-extrabold text-gray-400 uppercase tracking-widest border-b border-gray-100">
                            <div class="col-span-5">Nama Layanan</div>
                            <div class="col-span-2">Kategori</div>
                            <div class="col-span-3">Detail Harga</div>
                            <div class="col-span-2 text-center">Aksi</div>
                        </div>
                        
                        <?php
                        if(!empty($fasilitas)) {
                            foreach ($fasilitas as $row) : 
                                $nama = $row['nama']; 
                                $nama_lower = strtolower($nama);

                                if (strpos($nama_lower, 'gazebo') !== false) {
                                    $kategori = 'Gazebo';
                                    $theme = ['bg'=>'bg-[#FEF0E6]', 'text'=>'text-[#E88D57]', 'icon'=>'fa-house-chimney-window'];
                                } elseif (strpos($nama_lower, 'tiket') !== false || strpos($nama_lower, 'renang') !== false) {
                                    $kategori = 'Area/Tiket';
                                    $theme = ['bg'=>'bg-[#E6F3F8]', 'text'=>'text-[#4589A9]', 'icon'=>'fa-ticket'];
                                } elseif (strpos($nama_lower, 'kantin') !== false || strpos($nama_lower, 'lapangan') !== false) {
                                    $kategori = 'Fasilitas';
                                    $theme = ['bg'=>'bg-[#EAE6F8]', 'text'=>'text-[#7A5CA8]', 'icon'=>'fa-map-location-dot'];
                                } else {
                                    $kategori = 'Umum';
                                    $theme = ['bg'=>'bg-[#F4F5F7]', 'text'=>'text-gray-500', 'icon'=>'fa-box-open'];
                                    
                                    // TAMBAHIN INI: Cek kalau namanya Aula, tandai sebagai gratis
                                    if ($nama == 'Aula') { 
                                        $is_gratis = true; 
                                    } else { 
                                        $is_gratis = false; 
                                    }
                                }

                                $harga = $row['harga'];
                                $harga_kurang_4jam = $row[$col_kurang] ?? null; 
                                $harga_lebih_4jam = $row[$col_lebih] ?? null;
                                $is_gazebo = (strpos($nama_lower, 'gazebo') !== false);
                        ?>
                        
                        <div class="grid grid-cols-12 items-center gap-4 px-4 md:px-8 py-5 border-b border-gray-50 hover:bg-[#FAFAFB] transition-colors last:border-0">
                            <div class="col-span-5 flex items-center gap-3 md:gap-4">
                                <div class="w-9 h-9 md:w-11 md:h-11 rounded-xl <?= $theme['bg'] ?> flex items-center justify-center <?= $theme['text'] ?> shrink-0">
                                    <i class="fa-solid <?= $theme['icon'] ?> text-[14px] md:text-[18px]"></i>
                                </div>
                                <span class="font-extrabold text-[13px] md:text-[14px] text-brand-textDark truncate"><?= htmlspecialchars($nama); ?></span>
                            </div>
                            <div class="col-span-2 flex items-center">
                                <span class="<?= $theme['bg'] ?> <?= $theme['text'] ?> text-[9px] md:text-[10px] font-extrabold px-2 py-1 md:px-3 md:py-1.5 rounded-full uppercase tracking-wider"><?= $kategori; ?></span>
                            </div>
                            <div class="col-span-3 flex flex-col justify-center">
                                <?php if ($is_gazebo) : ?>
                                    <div class="text-[11px] md:text-[12px] text-gray-500 font-medium mb-1">
                                        < 4 Jam: <span class="font-extrabold text-brand-textDark text-[12px] md:text-[13px]"><?= ($harga_kurang_4jam !== null) ? 'Rp ' . number_format((float)$harga_kurang_4jam, 0, ',', '.') : '-'; ?></span>
                                    </div>
                                    <div class="text-[11px] md:text-[12px] text-gray-500 font-medium">
                                        Seharian: <span class="font-extrabold text-brand-textDark text-[12px] md:text-[13px]"><?= ($harga_lebih_4jam !== null) ? 'Rp ' . number_format((float)$harga_lebih_4jam, 0, ',', '.') : '-'; ?></span>
                                    </div>
                                <?php elseif ($harga !== null) : ?>
                                    <span class="font-extrabold text-[14px] md:text-[15px] text-brand-textDark">Rp <?= number_format((float)$harga, 0, ',', '.'); ?></span>
                                <?php else : ?>
                                    <span class="font-extrabold text-[12px] md:text-[13px] text-gray-400 italic">Gratis / Belum Diatur</span>
                                <?php endif; ?>
                            </div>
                            <div class="col-span-2 flex items-center justify-center gap-2">
                                <?php $h_visible = $row['is_visible'] ?? 1; ?>
                                <a href="proses_fasilitas&action=toggle_visibility&id=<?= $row['id'] ?>&status=<?= $h_visible ? 0 : 1 ?>" class="w-8 h-8 md:w-9 md:h-9 rounded-lg border border-gray-200 flex items-center justify-center <?= $h_visible ? 'text-[#10B981] bg-[#10B981]/10' : 'text-gray-400 bg-gray-50' ?> hover:bg-gray-100 transition-colors shrink-0" title="<?= $h_visible ? 'Sembunyikan' : 'Tampilkan' ?>">
                                    <i class="fa-regular <?= $h_visible ? 'fa-eye' : 'fa-eye-slash' ?> text-[12px] md:text-[13px]"></i>
                                </a>
                                <button type="button" 
                                    onclick="bukaPopup(this)" 
                                    data-id="<?= htmlspecialchars($row['id'], ENT_QUOTES) ?>"
                                    data-nama="<?= htmlspecialchars($nama, ENT_QUOTES) ?>"
                                    data-is-gazebo="<?= $is_gazebo ? 'true' : 'false' ?>"
                                    data-harga="<?= htmlspecialchars((string)$harga, ENT_QUOTES) ?>"
                                    data-hkurang="<?= htmlspecialchars((string)$harga_kurang_4jam, ENT_QUOTES) ?>"
                                    data-hlebih="<?= htmlspecialchars((string)$harga_lebih_4jam, ENT_QUOTES) ?>"
                                    class="block text-center bg-white border border-gray-200 text-gray-700 hover:text-white hover:bg-brand-orange hover:border-brand-orange font-bold text-[11px] md:text-[12px] px-2 py-2 md:px-4 md:py-2.5 rounded-lg transition-all w-full">
                                    Ubah Harga
                                </button>
                            </div>
                        </div>
                        <?php endforeach; } ?> 
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="modal-overlay" class="fixed inset-0 bg-black/60 z-[99] hidden items-center justify-center backdrop-blur-sm opacity-0 transition-opacity duration-300">
        <div id="modal-box" class="bg-white rounded-[24px] shadow-2xl w-full max-w-[500px] mx-4 transform scale-95 opacity-0 transition-all duration-300">
            <div class="p-8">
                <div class="mb-6">
                    <p class="text-[10px] font-bold text-brand-orange uppercase tracking-widest mb-1">Formulir Pembaruan</p>
                    <h2 class="text-2xl font-extrabold text-brand-textDark">Detail Harga Item</h2>
                </div>

                <form action="proses_harga" method="POST" id="form-harga">
                    <input type="hidden" name="id" id="popup-id">
                    
                    <div class="mb-5">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Nama Item</label>
                        <div class="bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 flex items-center gap-3">
                            <i class="fa-solid fa-tag text-gray-400"></i>
                            <span id="popup-nama" class="font-bold text-gray-700 text-sm">Nama Item</span>
                        </div>
                    </div>

                    <div id="area-harga-normal" class="hidden mb-6">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Harga Normal</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-gray-400">Rp</span>
                            <input type="number" name="harga" id="input-harga-normal" class="w-full bg-gray-50 border border-gray-200 text-gray-800 font-bold rounded-xl py-3 pl-12 pr-4 outline-none focus:ring-2 focus:ring-brand-orange/30 transition-all">
                        </div>
                    </div>

                    <div id="area-harga-gazebo" class="hidden mb-6 space-y-4">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Harga < 4 Jam</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-gray-400">Rp</span>
                                <input type="number" name="<?= htmlspecialchars($col_kurang, ENT_QUOTES) ?>" id="input-harga-kurang" class="w-full bg-gray-50 border border-gray-200 text-gray-800 font-bold rounded-xl py-3 pl-12 pr-4 outline-none focus:ring-2 focus:ring-brand-orange/30 transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Harga Seharian</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-gray-400">Rp</span>
                                <input type="number" name="<?= htmlspecialchars($col_lebih, ENT_QUOTES) ?>" id="input-harga-lebih" class="w-full bg-gray-50 border border-gray-200 text-gray-800 font-bold rounded-xl py-3 pl-12 pr-4 outline-none focus:ring-2 focus:ring-brand-orange/30 transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit" class="flex-1 bg-[#C25A3D] hover:bg-[#A84B31] text-white font-bold py-3.5 rounded-xl transition-all">Simpan Perubahan</button>
                        <button type="button" onclick="tutupPopup()" class="px-6 py-3.5 rounded-xl font-bold text-gray-500 bg-white border border-gray-200 hover:bg-gray-50 transition-all">Batal</button>
                    </div>
                </form>
            </div>
        </div>
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
            setTimeout(() => { overlay.classList.remove('opacity-0'); overlay.classList.add('opacity-100'); }, 10);
        }
        function closeSidebar() {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0');
            setTimeout(() => { overlay.classList.add('hidden'); }, 300);
        }
        if(openBtn) openBtn.addEventListener('click', openSidebar);
        if(closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if(overlay) overlay.addEventListener('click', closeSidebar);

        const modalOverlay = document.getElementById('modal-overlay');
        const modalBox = document.getElementById('modal-box');
        
        function bukaPopup(btn) {
            const id = btn.getAttribute('data-id');
            const nama = btn.getAttribute('data-nama');
            const isGazebo = (btn.getAttribute('data-is-gazebo') === 'true');
            const hargaNormal = btn.getAttribute('data-harga');
            const hargaKurang = btn.getAttribute('data-hkurang');
            const hargaLebih = btn.getAttribute('data-hlebih');

            document.getElementById('popup-id').value = id;
            document.getElementById('popup-nama').innerText = nama;
            
            const areaNormal = document.getElementById('area-harga-normal');
            const areaGazebo = document.getElementById('area-harga-gazebo');
            const inputNormal = document.getElementById('input-harga-normal');
            const inputKurang = document.getElementById('input-harga-kurang');
            const inputLebih = document.getElementById('input-harga-lebih');

            if (isGazebo) {
                areaNormal.classList.add('hidden');
                areaGazebo.classList.remove('hidden');
                inputNormal.removeAttribute('required');
                inputKurang.setAttribute('required', 'required');
                inputLebih.setAttribute('required', 'required');
                inputKurang.value = hargaKurang || '';
                inputLebih.value = hargaLebih || '';
            } else {
                areaGazebo.classList.add('hidden');
                areaNormal.classList.remove('hidden');
                inputKurang.removeAttribute('required');
                inputLebih.removeAttribute('required');
                inputNormal.setAttribute('required', 'required');
                inputNormal.value = hargaNormal || '';
            }

            modalOverlay.classList.remove('hidden');
            modalOverlay.classList.add('flex');
            setTimeout(() => {
                modalOverlay.classList.remove('opacity-0');
                modalBox.classList.remove('scale-95', 'opacity-0');
                modalBox.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function tutupPopup() {
            modalOverlay.classList.add('opacity-0');
            modalBox.classList.remove('scale-100', 'opacity-100');
            modalBox.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modalOverlay.classList.add('hidden');
                modalOverlay.classList.remove('flex');
            }, 300); 
        }

        modalOverlay.addEventListener('click', function(e) {
            if (e.target === modalOverlay) tutupPopup();
        });
    </script>
    <script>
        <?php if (isset($_GET['status'])): ?>
            Swal.fire({
                title: '<?= $_GET['status'] == 'success' ? 'Berhasil!' : 'Gagal!' ?>',
                text: '<?= $_GET['status'] == 'success' ? 'Data berhasil diperbarui.' : 'Terjadi kesalahan sistem.' ?>',
                icon: '<?= $_GET['status'] == 'success' ? 'success' : 'error' ?>',
                confirmButtonColor: '#2B2B43'
            });
        <?php endif; ?>
    </script>
</body>
</html>