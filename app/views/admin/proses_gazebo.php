<?php
require_once __DIR__ . '/../../core/Database.php';
require_once __DIR__ . '/../../models/GazebroModel.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$gazebroModel = new GazebroModel();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap ID Gazebo (Bukan nomornya ya, tapi ID aslinya di database)
    // Pakai (int) agar kalau kosong tidak jadi teks "" yang bikin error MySQL
    $gazebo_id = isset($_POST['gazebo_id']) ? (int)$_POST['gazebo_id'] : 0;
    
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'] ?? null;
    $action = $_POST['action'] ?? null;

    // Pastikan ID valid sebelum lanjut memproses
    if ($gazebo_id > 0) {

        // Action 1: Delete/Checkout (Selesaikan Sewa)
        if ($action == 'delete') {
            $gazebroModel->deleteBooking($gazebo_id, $tanggal_kunjungan);
        } 
        // Action 2: Save booking (Simpan/Update Sewa)
        else if ($action == 'save') {
            $data = [
                'nama_pemesan' => $_POST['nama_pemesan'] ?? '',
                'no_whatsapp' => $_POST['no_whatsapp'] ?? '',
                'durasi' => $_POST['durasi'] ?? '',
                'jam_mulai' => $_POST['jam_mulai'] ?? '',
                'jam_selesai' => $_POST['jam_selesai'] ?? ''
            ];
            
            $gazebroModel->saveBooking($gazebo_id, $tanggal_kunjungan, $data);
        }
        
        echo "<!DOCTYPE html>
        <html>
        <head>
    <link rel=\'icon\' type=\'image/webp\' href=\'/assets/logo.webp\'>
            <script src=\"/assets/js/sweetalert2.min.js\"></script>
        </head>
        <body style=\"font-family: 'Poppins', sans-serif;\">
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Status Gazebo berhasil diperbarui!',
                    icon: 'success',
                    confirmButtonColor: '#2B2B43'
                }).then(() => {
                    window.location.replace('status_gazebo');
                });
            </script>
        </body>
        </html>";
        exit; 
    } else {
        echo "<!DOCTYPE html>
        <html>
        <head>
    <link rel=\'icon\' type=\'image/webp\' href=\'/assets/logo.webp\'>
            <script src=\"/assets/js/sweetalert2.min.js\"></script>
        </head>
        <body style=\"font-family: 'Poppins', sans-serif;\">
            <script>
                Swal.fire({
                    title: 'Info',
                    text: 'Data harga berhasil diubah!',
                    icon: 'success',
                    confirmButtonColor: '#2B2B43'
                }).then(() => {
                    window.location.replace('kelola_harga');
                });
            </script>
        </body>
        </html>";
        exit;
    }    }

?>