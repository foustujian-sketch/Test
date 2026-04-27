<?php
$user = $user ?? null;
$username = $username ?? ($user['username'] ?? 'admin');
$status = $_GET['status'] ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/webp" href="/assets/logo.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - Taman Salma Shofa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>

    <!-- Premium UI Libraries -->
    <script src="/assets/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="/assets/css/flatpickr.min.css">
    <script src="/assets/js/flatpickr.min.js"></script>
    <script src="/assets/js/flatpickr-id.js"></script>
</head>
<body class="bg-[#FAFAFB] text-gray-800 flex h-screen overflow-hidden">

    <?php include __DIR__ . '/../shared/includes/sidebar.php'; ?>

    <main class="flex-1 flex flex-col h-full overflow-hidden w-full relative z-0">
        
        <header class="h-[80px] bg-white border-b border-gray-100 flex items-center justify-between px-4 md:px-8 shrink-0">
            <div class="flex items-center gap-3 md:gap-4">
                <button id="openSidebarBtn" class="lg:hidden text-gray-500 hover:text-[#E88D57] focus:outline-none p-2">
                    <i class="fa-solid fa-bars text-xl md:text-2xl"></i>
                </button>
                <h1 class="text-xl font-bold text-[#1A1A24]">Pengaturan Akun</h1>
            </div>

            <div class="flex items-center gap-4 md:gap-6">
                <div class="flex items-center gap-3 cursor-default select-none">
                    <div class="text-right hidden sm:block">
                        <p class="text-[14px] font-bold text-[#1A1A24]"><?= htmlspecialchars($username) ?></p>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">SUPER ADMIN</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($username) ?>&background=2B2B43&color=fff&rounded=true" class="w-8 h-8 md:w-10 md:h-10 rounded-full border-2 border-gray-100 shadow-sm pointer-events-none">
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-4 md:p-8 no-scrollbar">
            <div class="max-w-[600px] mx-auto bg-white rounded-2xl p-6 md:p-8 border border-gray-100 shadow-sm mt-4 md:mt-8">
                
                <?php if ($status === 'success'): ?>
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-xl flex items-center gap-3 text-sm font-medium">
                        <i class="fa-solid fa-circle-check"></i>
                        Profil berhasil diperbarui!
                    </div>
                <?php elseif ($status === 'success_wa'): ?>
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-xl flex items-center gap-3 text-sm font-medium">
                        <i class="fa-solid fa-circle-check"></i>
                        Nomor Pengingat WA berhasil diperbarui!
                    </div>
                <?php elseif ($status === 'error' || $status === 'error_wa'): ?>
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl flex items-center gap-3 text-sm font-medium">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        Gagal memperbarui data. Silakan coba lagi.
                    </div>
                <?php endif; ?>
                
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4 sm:gap-5 border-b border-gray-100 pb-6 mb-6 text-center sm:text-left">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($username) ?>&background=2B2B43&color=fff&size=100" class="w-16 h-16 rounded-full shadow-sm">
                    <div class="mt-2 sm:mt-0">
                        <h2 class="text-lg font-bold text-gray-800">Ubah Kredensial</h2>
                        <p class="text-xs text-gray-500 mt-1">Gunakan username yang unik dan password yang kuat.</p>
                    </div>
                </div>

                <form action="update_akun" method="POST" class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wider">Username Admin</label>
                        <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" class="w-full bg-[#F8F9FA] border border-gray-200 text-sm rounded-xl py-3 px-4 outline-none focus:ring-1 focus:ring-[#E88D57] transition-all" required>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wider">Password Baru</label>
                        <input type="password" name="password_baru" placeholder="Kosongkan jika tidak ingin mengubah password" class="w-full bg-[#F8F9FA] border border-gray-200 text-sm rounded-xl py-3 px-4 outline-none focus:ring-1 focus:ring-[#E88D57] transition-all">
                        <p class="text-[10px] text-gray-400 mt-2 flex items-center gap-1 italic">
                            <i class="fa-solid fa-info-circle"></i> Biarkan kosong jika hanya ingin mengubah username.
                        </p>
                    </div>

                    <div class="pt-6 text-center sm:text-right border-t border-gray-50">
                        <button type="submit" class="w-full sm:w-auto bg-[#E88D57] hover:bg-[#d97c45] text-white font-bold px-10 py-3.5 rounded-xl transition-all shadow-md active:scale-95">
                            <i class="fa-solid fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>

                <div class="mt-12 flex flex-col sm:flex-row items-center sm:items-start gap-4 sm:gap-5 border-b border-gray-100 pb-6 mb-6 text-center sm:text-left">
                    <div class="w-16 h-16 rounded-full bg-[#25D366]/10 text-[#25D366] flex items-center justify-center text-3xl shadow-sm">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div class="mt-2 sm:mt-0">
                        <h2 class="text-lg font-bold text-gray-800">Pengaturan WhatsApp</h2>
                        <p class="text-xs text-gray-500 mt-1">Atur nomor admin yang akan disertakan dalam pesan Pengingat WA 30 Menit ke pengunjung.</p>
                    </div>
                </div>

                <form action="update_wa_setting" method="POST" class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wider">Nomor Admin Pengirim WA</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold">+</span>
                            <input type="text" name="admin_wa_pengingat" value="<?= htmlspecialchars($admin_wa ?? '628125814305') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full bg-[#F8F9FA] border border-gray-200 text-sm rounded-xl py-3 pl-8 pr-4 outline-none focus:ring-1 focus:ring-[#25D366] transition-all" required>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-2 flex items-center gap-1 italic">
                            <i class="fa-solid fa-info-circle"></i> Gunakan format kode negara, contoh: 62812xxx
                        </p>
                    </div>

                    <div class="pt-6 text-center sm:text-right border-t border-gray-50">
                        <button type="submit" class="w-full sm:w-auto bg-[#25D366] hover:bg-[#1DA851] text-white font-bold px-10 py-3.5 rounded-xl transition-all shadow-md active:scale-95">
                            <i class="fa-solid fa-save mr-2"></i> Simpan Nomor WA
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const openBtn = document.getElementById('openSidebarBtn');
        const closeBtn = document.getElementById('closeSidebarBtn');
        const overlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            if(sidebar) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
            }
            if(overlay) {
                overlay.classList.remove('hidden');
                setTimeout(() => {
                    overlay.classList.remove('opacity-0');
                    overlay.classList.add('opacity-100');
                }, 10);
            }
        }

        function closeSidebar() {
            if(sidebar) {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
            }
            if(overlay) {
                overlay.classList.remove('opacity-100');
                overlay.classList.add('opacity-0');
                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 300);
            }
        }

        if(openBtn) openBtn.addEventListener('click', openSidebar);
        if(closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if(overlay) overlay.addEventListener('click', closeSidebar);
    </script>
    <script>
        <?php if (isset($_GET['status'])): ?>
            Swal.fire({
                title: '<?= strpos($_GET['status'], 'success') !== false ? 'Berhasil!' : 'Gagal!' ?>',
                text: '<?= strpos($_GET['status'], 'success') !== false ? 'Data berhasil diperbarui.' : 'Terjadi kesalahan sistem.' ?>',
                icon: '<?= strpos($_GET['status'], 'success') !== false ? 'success' : 'error' ?>',
                confirmButtonColor: '#2B2B43'
            });
        <?php endif; ?>
    </script>
</body>
</html>