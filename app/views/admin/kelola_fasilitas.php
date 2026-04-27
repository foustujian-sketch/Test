<?php
$fasilitas_utama = $fasilitas_utama ?? [];
$fasilitas_pendukung = $fasilitas_pendukung ?? [];

// MENGHILANGKAN SEWA BAJU TRADISIONAL DARI HALAMAN KELOLA FASILITAS
foreach ($fasilitas_utama as $k => $v) {
    if (strpos(strtolower(trim($v['nama'] ?? '')), 'baju') !== false) {
        unset($fasilitas_utama[$k]);
    }
}
foreach ($fasilitas_pendukung as $k => $v) {
    if (strpos(strtolower(trim($v['nama'] ?? '')), 'baju') !== false) {
        unset($fasilitas_pendukung[$k]);
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="icon" type="image/webp" href="/assets/logo.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Fasilitas - Taman Salma Shofa</title>
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
                            orange: '#E88D57',
                            bgLight: '#FAFAFB',
                            textDark: '#1A1A24'
                        }
                    }
                }
            }
        }

        function konfirmasiHapus(namaFasilitas) {
            return confirm("⚠️ PERINGATAN KERAS! ⚠️\n\nAnda akan menghapus fasilitas '" + namaFasilitas + "'.\n\nSemua data gambar dan informasi terkait akan DIHAPUS PERMANEN dari database dan tidak bisa dikembalikan.\n\nApakah Anda benar-benar yakin?");
        }
    </script>
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
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

        <div class="flex-1 overflow-y-auto no-scrollbar p-4 md:p-8 lg:p-10 w-full">
            <div class="max-w-[1200px] mx-auto">

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-[28px] md:text-[32px] font-bold text-brand-textDark mb-1 leading-tight">Kelola Fasilitas</h1>
                        <p class="text-gray-500 text-[13px] md:text-[14px]">Atur aset utama dan amenitas premium Taman Salma Shofa</p>
                    </div>
                </div>

                <div class="mb-6">
                    <h2 class="text-[20px] md:text-[22px] font-bold text-brand-textDark leading-tight">Fasilitas Utama</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    <?php foreach ($fasilitas_utama as $f):
                        $img = !empty($f['gambar']) ? 'image_tss/' . rawurlencode(basename($f['gambar'])) : 'https://images.unsplash.com/photo-1576013551627-1422ab1a0f44?w=400&q=80';
                    ?>
                        <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm flex flex-col group">
                            <div class="relative w-full h-[180px] rounded-xl overflow-hidden mb-4 bg-gray-200">
                                <img src="<?= $img ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                                <h3 class="absolute bottom-4 left-4 text-white font-bold text-[16px] md:text-[18px] tracking-wide truncate pr-4"><?= htmlspecialchars($f['nama']) ?></h3>
                            </div>
                            <div class="flex items-center gap-2">
                                <?php $is_visible = $f['is_visible'] ?? 1; ?>
                                <a href="proses_fasilitas&action=toggle_visibility&id=<?= $f['id'] ?>&status=<?= $is_visible ? 0 : 1 ?>" class="w-8 h-8 rounded border border-gray-200 flex items-center justify-center <?= $is_visible ? 'text-[#10B981] bg-[#10B981]/10 border-[#10B981]/20' : 'text-gray-400 bg-gray-50' ?> hover:bg-gray-100 transition-colors" title="<?= $is_visible ? 'Sembunyikan' : 'Tampilkan' ?>">
                                    <i class="fa-regular <?= $is_visible ? 'fa-eye' : 'fa-eye-slash' ?> text-[12px]"></i>
                                </a>

                                <a href="edit_fasilitas&id=<?= $f['id'] ?>" class="w-8 h-8 rounded border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-50 hover:text-brand-orange transition-colors">
                                    <i class="fa-solid fa-pencil text-[12px]"></i>
                                </a>

                                <a href="proses_fasilitas&action=delete&id=<?= $f['id'] ?>" onclick="return konfirmasiHapus('<?= htmlspecialchars($f['nama']) ?>')" class="w-8 h-8 rounded border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-500 transition-colors">
                                    <i class="fa-regular fa-trash-can text-[12px]"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mb-6">
                    <h2 class="text-[20px] md:text-[22px] font-bold text-brand-textDark leading-tight">Fasilitas Lainnya</h2>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-5 mb-14">
                    <?php foreach ($fasilitas_pendukung as $p):
                        $p_img = !empty($p['gambar']) ? 'image_tss/' . rawurlencode(basename($p['gambar'])) : 'https://images.unsplash.com/photo-1542816417-0983c9c9ad53?w=300&q=60';
                    ?>
                        <div class="bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm flex flex-col group relative">
                            <div class="h-[90px] md:h-[110px] w-full relative overflow-hidden bg-gray-100">
                                <img src="<?= $p_img ?>" class="absolute inset-0 w-full h-full object-cover">
                                <a href="proses_fasilitas&action=delete&id=<?= $p['id'] ?>"
                                    onclick="return konfirmasiHapus('<?= htmlspecialchars($p['nama']) ?>')"
                                    class="absolute top-2 right-2 w-6 h-6 md:w-7 md:h-7 bg-black/40 backdrop-blur-sm rounded-md flex items-center justify-center text-white hover:bg-red-500 transition-colors opacity-100 md:opacity-0 md:group-hover:opacity-100">
                                    <i class="fa-regular fa-trash-can text-[10px] md:text-[11px]"></i>
                                </a>
                            </div>
                            <div class="p-3 md:p-4 pt-2 md:pt-3 flex flex-col flex-1">
                                <h4 class="font-bold text-[12px] md:text-[14px] text-brand-textDark leading-tight mb-0.5 truncate"><?= htmlspecialchars($p['nama']) ?></h4>
                                <p class="text-[9px] md:text-[10px] text-gray-400 line-clamp-1 mb-3"><?= !empty($p['deskripsi']) ? htmlspecialchars($p['deskripsi']) : 'Layanan pendukung' ?></p>
                                <div class="mt-auto flex items-center gap-2">
                                    <?php $p_visible = $p['is_visible'] ?? 1; ?>
                                    <a href="proses_fasilitas&action=toggle_visibility&id=<?= $p['id'] ?>&status=<?= $p_visible ? 0 : 1 ?>" class="w-6 h-6 md:w-7 md:h-7 rounded border border-gray-200 flex items-center justify-center <?= $p_visible ? 'text-[#10B981] bg-[#10B981]/10 border-[#10B981]/20' : 'text-gray-400 bg-gray-50' ?> hover:bg-gray-100 transition-colors" title="<?= $p_visible ? 'Sembunyikan' : 'Tampilkan' ?>">
                                        <i class="fa-regular <?= $p_visible ? 'fa-eye' : 'fa-eye-slash' ?> text-[9px] md:text-[10px]"></i>
                                    </a>
                                    <a href="edit_fasilitas&id=<?= $p['id'] ?>" class="w-6 h-6 md:w-7 md:h-7 rounded border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-50 hover:text-brand-orange transition-colors">
                                        <i class="fa-solid fa-pencil text-[9px] md:text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pb-20">
                    <div class="lg:col-span-2 bg-white rounded-2xl p-6 md:p-8 border border-gray-100 shadow-sm">
                        <div class="mb-6 md:mb-8">
                            <h3 class="text-[20px] md:text-[22px] font-bold text-brand-textDark mb-1">Input Fasilitas Baru</h3>
                            <p class="text-[12px] md:text-[13px] text-gray-500">Lengkapi data untuk publikasi di halaman pengunjung</p>
                        </div>

                        <form action="proses_fasilitas" method="POST" enctype="multipart/form-data" id="form-fasilitas" class="space-y-5 md:space-y-6">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                                <div>
                                    <label class="block text-[11px] md:text-[12px] font-bold text-gray-700 mb-2 tracking-wide uppercase">Nama Fasilitas</label>
                                    <input type="text" name="nama" placeholder="Contoh: Kolam Arus Anak" class="w-full bg-[#F8F9FA] border border-gray-200 text-gray-800 text-[13px] md:text-[14px] rounded-lg py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange transition-all" required>
                                </div>
                                <div>
                                    <label class="block text-[11px] md:text-[12px] font-bold text-gray-700 mb-2 tracking-wide uppercase">Kategori</label>
                                    <select id="input-kategori" name="kategori" class="w-full bg-[#F8F9FA] border border-gray-200 text-gray-800 text-[13px] md:text-[14px] rounded-lg py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange transition-all cursor-pointer">
                                        <option value="utama">Utama</option>
                                        <option value="pendukung">Pendukung</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-[11px] md:text-[12px] font-bold text-gray-700 mb-2 tracking-wide uppercase">Deskripsi Fasilitas</label>
                                <textarea id="input-deskripsi" name="deskripsi" maxlength="140" placeholder="Jelaskan keunggulan dan detail fasilitas ini..." class="w-full min-h-[100px] md:min-h-[120px] bg-[#F8F9FA] border border-gray-200 text-gray-800 text-[13px] md:text-[14px] rounded-lg py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange resize-none transition-all"></textarea>
                                <div class="flex justify-end mt-1">
                                    <span id="counter-deskripsi" class="text-[11px] font-medium text-gray-400">0 / 140 Karakter</span>
                                </div>
                            </div>

                            <div class="flex justify-end items-center gap-4 md:gap-6 pt-4 md:pt-6">
                                <button type="reset" class="text-[13px] md:text-[14px] font-bold text-gray-400 hover:text-gray-600 transition-colors">Batal</button>
                                <button type="submit" name="simpan" class="bg-[#C6714A] hover:bg-[#b0623f] text-white font-bold px-6 py-2.5 md:px-10 md:py-3 rounded-xl transition-all shadow-md active:scale-95 text-[13px] md:text-[14px]">
                                    Simpan Fasilitas
                                </button>
                            </div>
                        
                    </div>

                    <div class="lg:col-span-1 bg-[#2B2B43] rounded-2xl p-6 md:p-8 shadow-lg flex flex-col h-full relative">
                        <div class="mb-5 md:mb-6">
                            <h3 class="text-[16px] md:text-[18px] font-bold text-white mb-1">Media Fasilitas</h3>
                            <p class="text-[11px] md:text-[12px] text-gray-400 leading-relaxed">Unggah foto berkualitas tinggi (min. 1200×800px) untuk hasil terbaik pada website marketing.</p>
                        </div>

                        <label for="input-foto" id="drop-zone" class="flex-1 border-2 border-dashed border-[#4A4A68] rounded-2xl flex flex-col items-center justify-center p-6 md:p-8 bg-[#32324A]/40 hover:bg-[#32324A]/70 hover:border-brand-orange transition-all cursor-pointer group min-h-[180px] md:min-h-[220px]">
                            <input type="file" name="gambar" id="input-foto" class="hidden" accept="image/*">

                            <div class="w-12 h-12 md:w-14 md:h-14 bg-white/5 rounded-2xl flex items-center justify-center text-brand-orange mb-3 md:mb-4 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-cloud-arrow-up text-xl md:text-2xl"></i>
                            </div>

                            <p class="text-white font-bold text-[12px] md:text-[14px] mb-1 text-center" id="file-name">Klik atau tarik foto ke sini</p>
                            <p class="text-[9px] md:text-[10px] text-gray-500 font-medium tracking-widest uppercase text-center">PNG, JPG, WEBP UP TO 10MB</p>
                        </label>

                        <div class="mt-6 md:mt-8 bg-white/5 border border-white/10 rounded-2xl p-4 md:p-5">
                            <div class="flex items-center gap-3 mb-2 text-brand-orange">
                                <i class="fa-solid fa-circle-info text-[12px] md:text-sm"></i>
                                <span class="text-[9px] md:text-[10px] font-bold uppercase tracking-wider">Tips Editorial</span>
                            </div>
                            <p class="text-[10px] md:text-[11px] text-gray-400 leading-relaxed italic">
                                "Gunakan pencahayaan alami dan sudut pandang lebar untuk memperlihatkan skala fasilitas."
                            </p>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>

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

        if (openBtn) openBtn.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if (overlay) overlay.addEventListener('click', closeSidebar);
    </script>

    <script>
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('input-foto');
        const fileNameDisplay = document.getElementById('file-name');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, e => {
                e.preventDefault();
                e.stopPropagation();
            }, false);
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.add('border-brand-orange', 'bg-[#32324A]');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.remove('border-brand-orange', 'bg-[#32324A]');
            }, false);
        });

        dropZone.addEventListener('drop', e => {
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                updateFileName(files[0].name);
            }
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                updateFileName(fileInput.files[0].name);
            }
        });

        function updateFileName(name) {
            fileNameDisplay.innerText = "File dipilih: " + name;
            fileNameDisplay.classList.add('text-brand-orange');
            dropZone.classList.add('border-brand-orange');
        }
    </script>

    <script>
    const kategoriSelect = document.getElementById('input-kategori');
    const deskripsiInput = document.getElementById('input-deskripsi');
    const deskripsiCounter = document.getElementById('counter-deskripsi');

    const batasUtama = 140; 
    const batasPendukung = 70;  

    function updateCounter() {
        if(!deskripsiInput || !kategoriSelect) return;

        const batasSaatIni = (kategoriSelect.value === 'utama') ? batasUtama : batasPendukung;
        
        deskripsiInput.maxLength = batasSaatIni;
        
        if (deskripsiInput.value.length > batasSaatIni) {
            deskripsiInput.value = deskripsiInput.value.substring(0, batasSaatIni);
        }
        
        const jumlahKetikan = deskripsiInput.value.length;
        deskripsiCounter.textContent = `${jumlahKetikan} / ${batasSaatIni} Karakter`;

        if (batasSaatIni - jumlahKetikan <= 10) {
            deskripsiCounter.classList.add('text-brand-orange');
            deskripsiCounter.classList.remove('text-gray-400');
        } else {
            deskripsiCounter.classList.remove('text-brand-orange');
            deskripsiCounter.classList.add('text-gray-400');
        }
    }

    if(deskripsiInput) deskripsiInput.addEventListener('input', updateCounter);
    if(kategoriSelect) kategoriSelect.addEventListener('change', updateCounter);
    updateCounter();
    </script>
</body>

</html>