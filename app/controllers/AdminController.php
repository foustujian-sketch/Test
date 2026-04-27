<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/GazebroModel.php';
require_once __DIR__ . '/../models/FasilitasModel.php';
require_once __DIR__ . '/../models/UserModel.php';

class AdminController extends Controller
{
    private $gazebroModel;
    private $fasilitasModel;
    private $userModel;

    public function __construct()
    {
        $this->gazebroModel = new GazebroModel();
        $this->fasilitasModel = new FasilitasModel();
        $this->userModel = new UserModel();
    }

    public function dashboard()
    {
        date_default_timezone_set('Asia/Makassar');
        
        $data = [
            'total_gazebo' => $this->gazebroModel->getTotalCount(),
            'gazebo_terisi' => $this->gazebroModel->getTerisilToday(),
            'jadwal' => $this->gazebroModel->getJadwal(date('Y-m-d')),
            'search_keyword' => $_GET['search_booking'] ?? ''
        ];
        
        $data['gazebo_tersedia'] = $data['total_gazebo'] - $data['gazebo_terisi'];

        // --- Statistik Fasilitas ---
        $semua_fasilitas = $this->fasilitasModel->getAllFasilitas(); 
        
        $total_fasilitas = is_array($semua_fasilitas) ? count($semua_fasilitas) : 0;
        $total_utama = 0;
        $total_pendukung = 0;

        if (is_array($semua_fasilitas)) {
            foreach ($semua_fasilitas as $f) {
                if (isset($f['kategori']) && strtolower($f['kategori']) == 'utama') {
                    $total_utama++;
                } elseif (isset($f['kategori']) && strtolower($f['kategori']) == 'pendukung') {
                    $total_pendukung++;
                } else {
                    $total_pendukung++;
                }
            }
        }

        $data['total_fasilitas'] = $total_fasilitas;
        $data['total_utama'] = $total_utama;
        $data['total_pendukung'] = $total_pendukung;

        $this->view('admin/dashboard_admin', $data);
    }

    public function statusGazebo()
    {
        date_default_timezone_set('Asia/Makassar');
        $tanggal_filter = !empty($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
        
        $data = [
            'gazebos' => $this->gazebroModel->getAllGazebos(),
            'bookings' => $this->gazebroModel->getBookingsByDate($tanggal_filter),
            'booked_gazebos' => $this->gazebroModel->getBookedGazebosforDate($tanggal_filter),
            'tanggal_filter' => $tanggal_filter
        ];
        
        $this->view('admin/status_gazebo', $data);
    }

    public function kelolaHarga()
    {
        $data = [
            'columns' => $this->fasilitasModel->getTableColumns(),
            'fasilitas' => $this->fasilitasModel->getAllFasilitas()
        ];
        
        $this->view('admin/kelola_harga', $data);
    }

    // --- FUNGSI BARU: Menangani Update Harga dari Popup ---
    public function updateHarga()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if (!$id) {
                header("Location: kelola_harga");
                exit;
            }

            // Ambil semua data dari POST kecuali ID dan Route
            $updateData = [];
            foreach ($_POST as $key => $value) {
                if ($key !== 'id' && $key !== 'route') {
                    $updateData[$key] = $value;
                }
            }

            // Kirim ke model untuk update ke database
            $result = $this->fasilitasModel->updateFasilitas($id, $updateData);

            if ($result) {
                header("Location: kelola_harga?status=success");
            } else {
                header("Location: kelola_harga?status=error");
            }
            exit;
        }
    }

    public function kelolaFasilitas()
    {
        $data = [
            'fasilitas_utama' => $this->fasilitasModel->getFasilitasUtama(),
            'fasilitas_pendukung' => $this->fasilitasModel->getFasilitasPendukung()
        ];
        
        $this->view('admin/kelola_fasilitas', $data);
    }

    public function pengaturanAkun()
    {
        $user_id = $_SESSION['user_id'] ?? null;
        
        $settingsFile = __DIR__ . '/../config/settings.json';
        $admin_wa = '628125814305';
        if (file_exists($settingsFile)) {
            $settings = json_decode(file_get_contents($settingsFile), true);
            $admin_wa = $settings['admin_wa_pengingat'] ?? $admin_wa;
        }

        $data = [
            'user' => $this->userModel->getUserById($user_id),
            'username' => $this->userModel->getUserById($user_id)['username'] ?? '',
            'admin_wa' => $admin_wa
        ];
        
        $this->view('admin/pengaturan_akun', $data);
    }

    public function editHarga()
    {
        $id = $_GET['id'] ?? null;
        
        $data = [
            'fasilitas' => $this->fasilitasModel->getFasilitasById($id),
            'columns' => $this->fasilitasModel->getTableColumns()
        ];
        
        $this->view('admin/edit_harga', $data);
    }

    public function editFasilitas()
    {
        $id = $_GET['id'] ?? null;
        
        $data = [
            'fasilitas' => $this->fasilitasModel->getFasilitasById($id),
            'dokumentasi' => $this->fasilitasModel->getDokumentasi($id, 3)
        ];
        
        $this->view('admin/edit_fasilitas', $data);
    }

    public function prosesGazebo()
    {
        $this->view('admin/proses_gazebo');
    }

    public function prosesFasilitas()
    {
        $this->view('admin/proses_fasilitas');
    }
    public function updateAkun()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user_id'] ?? null;
            if (!$user_id) {
                header("Location: login");
                exit;
            }

            $username = $_POST['username'] ?? '';
            $password_baru = $_POST['password_baru'] ?? '';

            $data = ['username' => $username];
            
            // Jika password diisi, maka enkripsi dan masukkan ke data update
            if (!empty($password_baru)) {
                $data['password'] = password_hash($password_baru, PASSWORD_DEFAULT);
            }

            // Panggil model user untuk update
            if ($this->userModel->updateUser($user_id, $data)) {
                $_SESSION['username'] = $username; // Update nama di session agar header berubah
                header("Location: pengaturan_akun?status=success");
            } else {
                header("Location: pengaturan_akun?status=error");
            }
            exit;
        }
    }

    public function updateWaSetting()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $admin_wa = $_POST['admin_wa_pengingat'] ?? '';
            $admin_wa = preg_replace('/[^0-9]/', '', $admin_wa); // hanya angka
            
            $settingsFile = __DIR__ . '/../config/settings.json';
            $settings = [];
            if (file_exists($settingsFile)) {
                $settings = json_decode(file_get_contents($settingsFile), true) ?: [];
            }
            
            $settings['admin_wa_pengingat'] = $admin_wa;
            
            if (!is_dir(dirname($settingsFile))) {
                mkdir(dirname($settingsFile), 0777, true);
            }
            
            if (file_put_contents($settingsFile, json_encode($settings, JSON_PRETTY_PRINT))) {
                header("Location: pengaturan_akun?status=success_wa");
            } else {
                header("Location: pengaturan_akun?status=error_wa");
            }
            exit;
        }
    }
}