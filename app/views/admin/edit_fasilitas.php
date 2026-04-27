<?php
$fasilitas = $fasilitas ?? null;
$dokumentasi = $dokumentasi ?? [];

if (!$fasilitas) {
    echo "Data tidak ditemukan!";
    exit;
}

$data = $fasilitas;
$images = [];
$img_ids = [];
foreach ($dokumentasi as $doc) {
    $images[] = $doc['gambar'] ?? null;
    $img_ids[] = $doc['id'] ?? null;
}

// Pastikan array hanya berisi 1 elemen (karena sekarang max 1 foto)
$images = array_pad($images, 1, null);
$img_ids = array_pad($img_ids, 1, null);

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="icon" type="image/webp" href="/assets/logo.webp">
    <meta charset="UTF-8">
    <title>Edit Fasilitas - Taman Salma Shofa</title>
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
                            orange: '#E88D57',
                            bgLight: '#FAFAFB',
                            textDark: '#1A1A24'
                        }
                    }
                }
            }
        }
    </script>

    <!-- Premium UI Libraries -->
    <script src="/assets/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="/assets/css/flatpickr.min.css">
    <script src="/assets/js/flatpickr.min.js"></script>
    <script src="/assets/js/flatpickr-id.js"></script>
</head>

<body class="bg-brand-bgLight font-sans p-8">
    <div class="max-w-[800px] mx-auto">
        <div class="flex items-center gap-4 mb-8">
            <a href="kelola_fasilitas" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-brand-orange transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-brand-textDark">Edit Fasilitas</h1>
                <p class="text-sm text-gray-500">Ubah detail data untuk <?= htmlspecialchars($data['nama'] ?? '') ?></p>
            </div>
        </div>

        <div class="bg-white rounded-[32px] p-10 shadow-sm border border-gray-100">
            <form action="proses_fasilitas" method="POST" enctype="multipart/form-data" class="space-y-6">
                <input type="hidden" name="id" value="<?= $data['id'] ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[12px] font-bold text-gray-700 mb-2">Nama Fasilitas</label>
                        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama'] ?? '') ?>" class="w-full bg-[#F8F9FA] border border-gray-200 text-gray-800 text-sm rounded-xl py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange" required>
                    </div>
                    <div>
                        <label class="block text-[12px] font-bold text-gray-700 mb-2">Kategori</label>
                        <select id="input-kategori" name="kategori" class="w-full bg-[#F8F9FA] border border-gray-200 text-gray-800 text-sm rounded-xl py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange cursor-pointer">
                            <option value="utama" <?= ($data['kategori'] ?? '') == 'utama' ? 'selected' : '' ?>>Fasilitas Utama</option>
                            <option value="pendukung" <?= ($data['kategori'] ?? '') == 'pendukung' ? 'selected' : '' ?>>Fasilitas Pendukung</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[12px] font-bold text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="input-deskripsi" name="deskripsi" class="w-full min-h-[120px] bg-[#F8F9FA] border border-gray-200 text-gray-800 text-sm rounded-xl py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange resize-none"><?= htmlspecialchars($data['deskripsi'] ?? '') ?></textarea>
                    
                    <div class="flex justify-end mt-1">
                        <span id="counter-deskripsi" class="text-[11px] font-medium text-gray-400">0 / 140 Karakter</span>
                    </div>
                </div>

                <div class="border-t border-gray-50 pt-6 mt-6">
                    <label class="block text-[12px] font-bold text-gray-700 mb-4">Foto Fasilitas</label>

                    <div class="w-full md:w-1/3">
                        <div class="border border-gray-100 p-3 rounded-xl bg-white hover:border-gray-300 transition-colors group">
                            <p class="text-[10px] font-bold text-gray-500 group-hover:text-brand-orange uppercase mb-2 transition-colors">Foto Utama</p>
                            <?php if ($images[0]): ?>
                                <?php $img_path = str_replace('../public/', '', $images[0]); ?>
                                <img src="<?= '/' . ltrim($img_path, '/') ?>" onerror="this.style.display='none'" class="w-full h-32 object-cover rounded-lg border border-gray-200 shadow-sm mb-2">
                            <?php else: ?>
                                <div class="w-full h-32 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs mb-2">Kosong</div>
                            <?php endif; ?>
                            <input type="file" name="gambar_0" class="w-full text-[9px] text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:bg-gray-100 file:text-gray-600 hover:file:bg-orange-50 hover:file:text-brand-orange file:transition-colors cursor-pointer outline-none">
                            <input type="hidden" name="img_id_0" value="<?= $img_ids[0] ?>">
                        </div>
                    </div>

                </div>

                <div class="flex justify-end gap-4 pt-6 border-t border-gray-50">
                    <button type="submit" name="update" class="bg-brand-orange hover:bg-[#D97C45] text-white font-bold px-10 py-3 rounded-xl shadow-md transition-all">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    const kategoriSelect = document.getElementById('input-kategori');
    const deskripsiInput = document.getElementById('input-deskripsi');
    const deskripsiCounter = document.getElementById('counter-deskripsi');

    // Atur Batas Maksimal
    const batasUtama = 140; 
    const batasPendukung = 70;  

    function updateCounter() {
        if(!deskripsiInput || !kategoriSelect) return;

        const kategoriValue = kategoriSelect.value.toLowerCase();
        const batasSaatIni = (kategoriValue.includes('utama')) ? batasUtama : batasPendukung;
        
        deskripsiInput.maxLength = batasSaatIni;
        
        if (deskripsiInput.value.length > batasSaatIni) {
            deskripsiInput.value = deskripsiInput.value.substring(0, batasSaatIni);
        }
        
        const jumlahKetikan = deskripsiInput.value.length;
        deskripsiCounter.textContent = `${jumlahKetikan} / ${batasSaatIni} Karakter`;

        if (batasSaatIni - jumlahKetikan <= 10) {
            deskripsiCounter.classList.add('text-[#E88D57]'); 
            deskripsiCounter.classList.remove('text-gray-400');
        } else {
            deskripsiCounter.classList.remove('text-[#E88D57]');
            deskripsiCounter.classList.add('text-gray-400');
        }
    }

    if(deskripsiInput) deskripsiInput.addEventListener('input', updateCounter);
    if(kategoriSelect) kategoriSelect.addEventListener('change', updateCounter);
    
    updateCounter();
    </script>
</body>

</html>
