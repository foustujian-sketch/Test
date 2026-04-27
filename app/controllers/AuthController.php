<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->userModel = new UserModel();
    }

    public function login()
{
    // Cek jika sudah login, lempar ke dashboard
    if (isset($_SESSION['login'])) {
    header("Location: dashboard_admin");
        exit;
    }

    $error = false;
    $error_msg = "";

    // CEK APAKAH ADA DATA POST (SAAT TOMBOL DIKLIK)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Rate Limiting Sederhana Berbasis Sesi
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 0;
            $_SESSION['last_attempt_time'] = time();
        }

        // Reset jika sudah lewat 15 menit (900 detik)
        if (time() - $_SESSION['last_attempt_time'] > 900) {
            $_SESSION['login_attempts'] = 0;
        }

        if ($_SESSION['login_attempts'] >= 5) {
            $error = true;
            $error_msg = "Terlalu banyak percobaan login. Silakan coba lagi setelah 15 menit.";
        } else {
            $user = $this->userModel->getUserByUsername($username);

            // Hanya menggunakan password_verify untuk mengecek hash
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['login_attempts'] = 0; // Reset saat sukses

                header("Location: dashboard_admin");
                exit;
            } else {
                $_SESSION['login_attempts']++;
                $_SESSION['last_attempt_time'] = time();
                $error = true;
                $error_msg = "Kredensial tidak valid! Silakan coba lagi.";
            }
        }
    }

    // Jika tidak ada POST (akses halaman biasa), tampilkan view login
    $data = [
        'error' => $error,
        'error_msg' => $error_msg
    ];
    $this->view('pages/login', $data);
}
    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: index');
        exit;
    }
}