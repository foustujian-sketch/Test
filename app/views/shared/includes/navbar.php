<?php
// Resolve current page from query fallback first, then URL path
$request_uri = $_SERVER['REQUEST_URI'] ?? '/';
$uri_parts = parse_url($request_uri);
$request_path = $uri_parts['path'] ?? '/';

$current_page = '';
if (!empty($_GET['route'])) {
    $current_page = trim((string) $_GET['route'], '/');
} else {
    $segments = array_values(array_filter(explode('/', trim($request_path, '/'))));
    if (!empty($segments)) {
        $last = end($segments);
        $current_page = ($last === 'index') ? 'index' : $last;
    }
}

$current_page = $current_page ?: 'index';

// Build base path dynamically (works in subfolder and root deployments)
$script_dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$base_path = ($script_dir === '/' || $script_dir === '.') ? '' : rtrim($script_dir, '/');

if (!function_exists('url_path')) {
    function url_path(string $path = ''): string
    {
        global $base_path;
        $path = ltrim($path, '/');
        return ($base_path ?: '') . '/' . $path;
    }
}

if (!function_exists('route_url')) {
    function route_url(string $route = ''): string
    {
        $route = trim($route, '/');
        return url_path($route === '' ? '' : $route);
    }
}
?>
<div id="vueApp">
   <nav class="bg-[#2B2B43] w-full z-[100] shadow-md fixed top-0 overflow-visible">

       <div class="w-full max-w-full h-[72px] mx-auto px-4 md:px-12 flex justify-between items-center box-border">

        <a href="<?= route_url('') ?>" class="flex items-center shrink-0">
            <img src="<?= url_path('assets/logo.png') ?>" alt="Logo Salma Shofa"
                 class="h-8 md:h-10 w-auto object">
        </a>

            <div class="hidden lg:flex items-center gap-10">
                <a href="<?= route_url('') ?>" class="text-[15px] font-semibold tracking-wide <?= ($current_page == 'index' || $current_page == '') ? 'text-[#E88D57]' : 'text-white hover:text-[#E88D57]' ?> transition-colors">Beranda</a>
                <a href="<?= route_url('informasi') ?>" class="text-[15px] font-semibold tracking-wide <?= ($current_page == 'informasi') ? 'text-[#E88D57]' : 'text-white hover:text-[#E88D57]' ?> transition-colors">Informasi Umum</a>
                <a href="<?= route_url('fasilitas') ?>" class="text-[15px] font-semibold tracking-wide <?= ($current_page == 'fasilitas') ? 'text-[#E88D57]' : 'text-white hover:text-[#E88D57]' ?> transition-colors">Fasilitas & Layanan</a>
                <a href="<?= route_url('gazebo') ?>" class="text-[15px] font-semibold tracking-wide <?= ($current_page == 'gazebo') ? 'text-[#E88D57]' : 'text-white hover:text-[#E88D57]' ?> transition-colors">Gazebo</a>
                <a href="<?= route_url('pricelist') ?>" class="text-[15px] font-semibold tracking-wide <?= ($current_page == 'pricelist') ? 'text-[#E88D57]' : 'text-white hover:text-[#E88D57]' ?> transition-colors">Penawaran</a>
                <a href="<?= route_url('faq') ?>" class="text-[15px] font-semibold tracking-wide <?= ($current_page == 'faq') ? 'text-[#E88D57]' : 'text-white hover:text-[#E88D57]' ?> transition-colors">FAQ</a>
            </div>
            
            <div class="flex items-center justify-end gap-2 md:gap-5 shrink-0">

                <a href="<?= route_url('login') ?>" class="text-white hover:text-[#E88D57] transition-colors p-2">
                    <i class="fa-regular fa-circle-user text-[24px] md:text-[32px]"></i>
                </a>

                <button @click.prevent="toggleMenu" class="lg:hidden text-white hover:text-[#E88D57] focus:outline-none transition-colors p-2 flex items-center justify-center">
                    <i :class="['fa-solid', mobileOpen ? 'fa-xmark' : 'fa-bars', 'text-[24px]']"></i>
                </button>

            </div>

        </div>

        <div id="mobile-menu" :class="{ 'hidden': !mobileOpen }" class="lg:hidden absolute top-[72px] left-0 w-full bg-[#2B2B43] border-t border-white/10 shadow-2xl flex flex-col py-4 px-6 gap-4 z-[60]">
            <a href="<?= route_url('') ?>" class="text-[14px] font-semibold tracking-wide <?= ($current_page == 'index' || $current_page == '') ? 'text-[#E88D57]' : 'text-white' ?> hover:text-[#E88D57] transition-colors">Beranda</a>
            <a href="<?= route_url('informasi') ?>" class="text-[14px] font-semibold tracking-wide <?= ($current_page == 'informasi') ? 'text-[#E88D57]' : 'text-white' ?> hover:text-[#E88D57] transition-colors">Informasi Umum</a>
            <a href="<?= route_url('fasilitas') ?>" class="text-[14px] font-semibold tracking-wide <?= ($current_page == 'fasilitas') ? 'text-[#E88D57]' : 'text-white' ?> hover:text-[#E88D57] transition-colors">Fasilitas & Layanan</a>
            <a href="<?= route_url('gazebo') ?>" class="text-[14px] font-semibold tracking-wide <?= ($current_page == 'gazebo') ? 'text-[#E88D57]' : 'text-white' ?> hover:text-[#E88D57] transition-colors">Gazebo</a>
            <a href="<?= route_url('pricelist') ?>" class="text-[14px] font-semibold tracking-wide <?= ($current_page == 'pricelist') ? 'text-[#E88D57]' : 'text-white' ?> hover:text-[#E88D57] transition-colors">Penawaran</a>
            <a href="<?= route_url('faq') ?>" class="text-[14px] font-semibold tracking-wide <?= ($current_page == 'faq') ? 'text-[#E88D57]' : 'text-white' ?> hover:text-[#E88D57] transition-colors">FAQ</a>
        </div>
    </nav>
</div>