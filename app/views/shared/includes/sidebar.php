<?php
// Get current page from request URI
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$current_page = $_GET['route'] ?? 'dashboard_admin';
?>

<aside id="sidebar" class="w-[260px] bg-[#2B2B43] h-full flex flex-col shrink-0 absolute lg:relative z-[60] shadow-2xl lg:shadow-xl transition-transform duration-300 -translate-x-full lg:translate-x-0">
    
    <div class="h-[80px] flex items-center justify-between px-8 border-b border-white/10 shrink-0">
        <a href="dashboard_admin" class="text-xl font-bold text-white leading-tight">
            Taman Salma<br><span class="text-[#E88D57]">Shofa</span>
        </a>
        <button id="closeSidebarBtn" class="lg:hidden text-gray-400 hover:text-white transition-colors focus:outline-none">
            <i class="fa-solid fa-xmark text-2xl"></i>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-2 no-scrollbar">
        <p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">Menu Utama</p>
        
        <a href="dashboard_admin" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-[13.5px] transition-colors <?= ($current_page == 'dashboard_admin') ? 'text-white bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' ?>">
            <i class="fa-solid fa-border-all w-5 text-center <?= ($current_page == 'dashboard_admin') ? 'text-[#E88D57]' : '' ?>"></i> Dashboard
        </a>
        
        <a href="status_gazebo" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-[13.5px] transition-colors <?= ($current_page == 'status_gazebo') ? 'text-white bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' ?>">
            <i class="fa-solid fa-house-chimney w-5 text-center <?= ($current_page == 'status_gazebo') ? 'text-[#E88D57]' : '' ?>"></i> Status Gazebo
        </a>
        
        <a href="kelola_harga" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-[13.5px] transition-colors <?= ($current_page == 'kelola_harga') ? 'text-white bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' ?>">
            <i class="fa-solid fa-money-bill-wave w-5 text-center <?= ($current_page == 'kelola_harga') ? 'text-[#E88D57]' : '' ?>"></i> Kelola Harga
        </a>

        <a href="kelola_fasilitas" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-[13.5px] transition-colors <?= ($current_page == 'kelola_fasilitas') ? 'text-white bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' ?>">
            <i class="fa-solid fa-box-open w-5 text-center <?= ($current_page == 'kelola_fasilitas') ? 'text-[#E88D57]' : '' ?>"></i> Kelola Fasilitas
        </a>
    </nav>

 <div class="p-4 border-t border-white/10 space-y-1">
        
        <a href="pengaturan_akun" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-[13.5px] transition-colors <?= ($current_page == 'pengaturan_akun') ? 'text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' ?>">
            <i class="fa-solid fa-gear w-5 text-center <?= ($current_page == 'pengaturan_akun') ? 'text-[#E88D57]' : '' ?>"></i> Pengaturan Akun
        </a>
        
        <a href="#" onclick="confirmLogout(event)" class="flex items-center gap-3 text-[#F87171] hover:text-white hover:bg-red-500/20 px-4 py-3 rounded-xl transition-colors font-bold text-[13.5px]">
            <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center"></i> Keluar System
        </a>
        
    </div>
</aside>

<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-[50] hidden lg:hidden transition-opacity duration-300 opacity-0"></div>

<script>
    function confirmLogout(e) {
        e.preventDefault();
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Keluar Sistem?',
                text: 'Sesi Anda akan diakhiri dan Anda harus login kembali.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#E88D57',
                cancelButtonColor: '#2B2B43',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'logout';
                }
            });
        } else {
            if (confirm('Anda yakin ingin keluar dari sistem?')) {
                window.location.href = 'logout';
            }
        }
    }
</script>