<?php
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../../core/Database.php';
require_once __DIR__ . '/../../models/FasilitasModel.php';

$fasilitasModel = new FasilitasModel();

// Data passed from AdminController
$fasilitas = $fasilitas ?? null;
$columns = $columns ?? [];

if (!$fasilitas) {
    // DIPERBAIKI JUGA: Fallback jika gagal ambil data
    header("Location: kelola_harga");
    exit;
}

$data = $fasilitas;
$id = $data['id'];
$col_kurang = '';
$col_lebih = '';

foreach ($columns as $col) {
    if (strpos($col['Field'], '4jam') !== false) {
        if ($col_kurang == '') {
            $col_kurang = $col['Field'];
        } else {
            $col_lebih = $col['Field'];
        }
    }
}

// Detect if Gazebo
$is_gazebo = (strpos(strtolower($data['nama']), 'gazebo') !== false);

if (isset($_POST['simpan'])) {
    $updateData = [];
    
    if ($is_gazebo) {
        // Clean input, get numbers only
        $harga_kurang = (int) preg_replace('/[^0-9]/', '', $_POST['harga_kurang']);
        $harga_lebih = (int) preg_replace('/[^0-9]/', '', $_POST['harga_lebih']);
        
        $updateData[$col_kurang] = $harga_kurang;
        $updateData[$col_lebih] = $harga_lebih;
        $updateData['harga'] = null;
    } else {
        $harga_normal = (int) preg_replace('/[^0-9]/', '', $_POST['harga_normal']);
        
        $updateData['harga'] = $harga_normal;
        $updateData[$col_kurang] = null;
        $updateData[$col_lebih] = null;
    }

    if ($fasilitasModel->updateFasilitas($id, $updateData)) {
        // DIPERBAIKI: Jalur kembali menggunakan router index
        echo "<!DOCTYPE html><html><head><script src='/assets/js/sweetalert2.min.js'></script></head><body>
              <script>
                Swal.fire({title: 'Berhasil!', text: 'Harga berhasil diperbarui!', icon: 'success'}).then(() => {
                    window.location.href = 'kelola_harga';
                });
              </script></body></html>";
        exit;
    } else {
        $error = "Gagal memperbarui data";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/webp" href="/assets/logo.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Harga - Admin Taman Salma Shofa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style> body { font-family: 'Poppins', sans-serif; } 
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Hilangkan panah di Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }</style>

    <!-- Premium UI Libraries -->
    <script src="/assets/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="/assets/css/flatpickr.min.css">
    <script src="/assets/js/flatpickr.min.js"></script>
    <script src="/assets/js/flatpickr-id.js"></script>
</head>
<body class="bg-[#FAFAFB] min-h-screen flex items-center justify-center p-6 text-gray-800">

    <div class="flex flex-col lg:flex-row items-start gap-6 lg:gap-8 w-full max-w-[880px]">
        <div class="bg-white rounded-[24px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] w-full lg:flex-1 overflow-hidden z-10 relative">
            <div class="p-8 md:p-10">
                <div class="mb-8">
                    <p class="text-[#C27A5B] text-[10px] font-bold uppercase tracking-widest mb-2">Formulir Pembaruan</p>
                    <h2 class="text-[26px] font-extrabold text-[#1a1a24]">Detail Harga Item</h2>
                </div>

                <?php if(isset($error)) : ?>
                    <div class="bg-red-50 text-red-500 p-3 rounded-lg text-sm mb-5 font-medium border border-red-100">
                        <i class="fa-solid fa-circle-exclamation mr-2"></i> <?= $error; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-6">
                        <label class="block text-gray-500 text-[11px] font-bold uppercase tracking-wider mb-2">Nama Item</label>
                        <div class="flex items-center gap-3 bg-[#F4F5F7] rounded-xl px-4 py-3.5 border border-transparent">
                            <i class="fa-solid <?= $is_gazebo ? 'fa-house-chimney-window text-[#4589A9]' : 'fa-ticket text-[#E88D57]' ?> text-[18px]"></i>
                            <input type="text" value="<?= $data['nama']; ?>" readonly class="bg-transparent font-bold text-[#1a1a24] outline-none w-full text-[14px]">
                        </div>
                    </div>

                    <?php if ($is_gazebo) : ?>
                        <div class="mb-5">
                            <label class="block text-gray-500 text-[11px] font-bold uppercase tracking-wider mb-2">Harga < 4 Jam</label>
                            <div class="flex items-center bg-[#F4F5F7] rounded-xl px-4 py-3.5 focus-within:ring-2 focus-within:ring-[#C27A5B]/30 focus-within:bg-white transition-all border border-transparent focus-within:border-[#C27A5B]">
                                <span class="font-bold text-gray-500 mr-2 text-[15px]">Rp</span>
                                <input type="number" name="harga_kurang" value="<?= (int)$data[$col_kurang]; ?>" required class="bg-transparent font-bold text-[#C27A5B] outline-none w-full text-[16px]">
                            </div>
                            <p class="text-gray-400 text-[11px] mt-2 font-medium">Masukan angka tanpa titik.</p>
                        </div>

                        <div class="mb-8">
                            <label class="block text-gray-500 text-[11px] font-bold uppercase tracking-wider mb-2">Harga Seharian</label>
                            <div class="flex items-center bg-[#F4F5F7] rounded-xl px-4 py-3.5 focus-within:ring-2 focus-within:ring-[#C27A5B]/30 focus-within:bg-white transition-all border border-transparent focus-within:border-[#C27A5B]">
                                <span class="font-bold text-gray-500 mr-2 text-[15px]">Rp</span>
                                <input type="number" name="harga_lebih" value="<?= (int)$data[$col_lebih]; ?>" required class="bg-transparent font-bold text-[#C27A5B] outline-none w-full text-[16px]">
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="mb-8">
                            <label class="block text-gray-500 text-[11px] font-bold uppercase tracking-wider mb-2">Harga Normal</label>
                            <div class="flex items-center bg-[#F4F5F7] rounded-xl px-4 py-3.5 focus-within:ring-2 focus-within:ring-[#C27A5B]/30 focus-within:bg-white transition-all border border-transparent focus-within:border-[#C27A5B]">
                                <span class="font-bold text-gray-500 mr-2 text-[15px]">Rp</span>
                                <input type="number" name="harga_normal" value="<?= (int)$data['harga']; ?>" required class="bg-transparent font-bold text-[#C27A5B] outline-none w-full text-[16px]">
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="flex items-center gap-3 mt-4">
                        <button type="submit" name="simpan" class="flex-1 bg-[#C27A5B] hover:bg-[#a66549] text-white font-bold text-[14px] py-3.5 rounded-xl transition-colors shadow-[0_4px_12px_-2px_rgba(194,122,91,0.4)]">
                            Simpan Perubahan
                        </button>
                        <a href="kelola_harga" class="px-6 py-3.5 rounded-xl bg-white border border-gray-200 text-gray-600 font-bold text-[14px] hover:bg-gray-50 transition-colors text-center">Batal</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-[#5B5B6E] rounded-[20px] p-7 shadow-xl w-full lg:w-[320px] text-white lg:mt-16">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-[16px] font-bold tracking-wide">Panduan Admin</h3>
                <div class="w-8 h-8 rounded-full border-2 border-[#E88D57] text-[#E88D57] flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-info text-[13px]"></i>
                </div>
            </div>
            <p class="text-[#D4D4D8] text-[13px] leading-relaxed mb-6 font-medium">
                Perubahan harga akan langsung diterapkan. Karena database Anda mendeteksi Gazebo 1-6 dengan harga Rp1, silakan edit dan perbarui angkanya di form ini.
            </p>
        </div>
    </div>

</body>
</html>