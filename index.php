<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'app/controllers/PageController.php';
require_once 'app/controllers/AdminController.php';
require_once 'app/controllers/AuthController.php';

$script_dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$base_path = ($script_dir === '/' || $script_dir === '.') ? '' : rtrim($script_dir, '/');

// Get request URI and method
$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

// Parse query string and path
$uri_parts = parse_url($request_uri);
$path = $uri_parts['path'] ?? '/';
$query_string = $uri_parts['query'] ?? '';

// Remove base_path from path to get relative segments
if ($base_path && strpos($path, $base_path) === 0) {
    $path = substr($path, strlen($base_path));
}

$path_segments = explode('/', trim($path, '/'));
$path_segments = array_filter($path_segments, function ($segment) {
    return !empty($segment);
});

// --- DAFTAR IZIN RUTE (WHITELIST) ---
$route = '';
if (!empty($path_segments)) {
    $first = reset($path_segments);
    
    // Whitelist rute yang valid
    $valid_routes = [
        'informasi', 'fasilitas', 'gazebo', 'pricelist', 'faq', 
        'login', 'proses_login', 'logout', 'dashboard_admin', 
        'status_gazebo', 'kelola_harga', 'kelola_fasilitas', 
        'pengaturan_akun', 'edit_harga', 'edit_fasilitas', 
        'proses_gazebo', 'proses_fasilitas', 'proses_harga', 
        'update_akun', 'update_wa_setting', 'index', 
        'convert_live', 'sync_names'
    ];

    if (in_array($first, $valid_routes)) {
        $route = $first;
    } else {
        // Jika segmen pertama bukan rute, mungkin rutenya ada di segmen kedua (kasus folder/subfolder)
        if (count($path_segments) > 1) {
            $second = $path_segments[1];
            if (in_array($second, $valid_routes)) {
                $route = $second;
            }
        }
    }
}

// Fallback routing: index.php?route=informasi (prioritaskan ini jika ada)
if (!empty($_GET['route'])) {
    $route = trim((string) $_GET['route'], '/');
}

// Parse query parameters
if ($query_string) {
    parse_str($query_string, $params);
    $_GET = array_merge($_GET, $params);
}

// Inisialisasi Controller
$pageController = new PageController();
$adminController = new AdminController();
$authController = new AuthController();

try {
    // --- HALAMAN ADMIN (PROTECTED) ---
    $admin_routes = [
        'dashboard_admin', 'status_gazebo', 'kelola_harga', 'kelola_fasilitas', 
        'pengaturan_akun', 'edit_harga', 'edit_fasilitas', 'proses_gazebo', 
        'proses_fasilitas', 'proses_harga', 'update_akun', 'update_wa_setting'
    ];

    if (in_array($route, $admin_routes)) {
        if (!isset($_SESSION['login'])) {
            header("Location: login");
            exit;
        }
    }

    // --- HALAMAN PUBLIK ---
    if ($route === '' || $route === 'index') {
        $pageController->home();
    } elseif ($route === 'informasi') {
        $pageController->informasi();
    } elseif ($route === 'fasilitas') {
        $pageController->fasilitas();
    } elseif ($route === 'gazebo') {
        $pageController->gazebo();
    } elseif ($route === 'pricelist') {
        $pageController->pricelist();
    } elseif ($route === 'faq') {
        $pageController->faq();
    } elseif ($route === 'login') {
        $pageController->login();
    } elseif ($route === 'convert_live') {
        require_once __DIR__ . '/convert_live.php';
        exit;
    } elseif ($route === 'sync_names') {
        require_once __DIR__ . '/sync_names.php';
        exit;
    } elseif ($route === 'proses_login') {
        if ($request_method === 'POST') {
            $authController->login(); 
            exit;
        } else {
            header("Location: " . $base_path . "/login");
            exit;
        }
    } elseif ($route === 'logout') {
        $authController->logout();
    }

    elseif ($route === 'dashboard_admin') {
        $adminController->dashboard();
    } elseif ($route === 'status_gazebo') {
        $adminController->statusGazebo();
    } elseif ($route === 'kelola_harga') {
        $adminController->kelolaHarga();
    } elseif ($route === 'kelola_fasilitas') {
        $adminController->kelolaFasilitas();
    } elseif ($route === 'pengaturan_akun') {
        $adminController->pengaturanAkun();
    } elseif ($route === 'edit_harga') {
        $adminController->editHarga();
    } elseif ($route === 'edit_fasilitas') {
        $adminController->editFasilitas();
    }
    
    // --- PROSES DATA (FORM) ---
    elseif ($route === 'proses_gazebo') {
        $adminController->prosesGazebo();
    } elseif ($route === 'proses_fasilitas') {
        $adminController->prosesFasilitas();
    } elseif ($route === 'proses_harga') {
        $adminController->updateHarga(); 
    } elseif ($route === 'update_akun') {
        // MENGHUBUNGKAN KE FUNGSI UPDATE AKUN DI CONTROLLER
        $adminController->updateAkun();
    } elseif ($route === 'update_wa_setting') {
        $adminController->updateWaSetting();
    }
    
    // --- 404 NOT FOUND ---
    else {
        header("HTTP/1.0 404 Not Found");
        $pageController->view('pages/404');
    }
} catch (Exception $e) {
    header("HTTP/1.0 500 Internal Server Error");
    echo "Error: " . $e->getMessage();
}