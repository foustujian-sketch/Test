<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../core/Database.php';
require_once __DIR__ . '/../../models/FasilitasModel.php';

function compressToWebP($source, $destination, $quality = 80) {
    // Fallback if GD extension is not installed/enabled
    if (!function_exists('imagecreatefrompng')) {
        return move_uploaded_file($source, $destination);
    }

    $info = getimagesize($source);
    if ($info === false) return false;

    if ($info["mime"] == "image/jpeg") {
        $image = imagecreatefromjpeg($source);
    } elseif ($info["mime"] == "image/png") {
        $image = imagecreatefrompng($source);
        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);
    } elseif ($info["mime"] == "image/webp") {
        return move_uploaded_file($source, $destination);
    } else {
        return move_uploaded_file($source, $destination);
    }
    
    if ($image) {
        $result = imagewebp($image, $destination, $quality);
        imagedestroy($image);
        return $result;
    }
    return false;
}

$fasilitasModel = new FasilitasModel();

// PERBAIKAN: Gunakan absolute path untuk folder upload (misal: root/image_tss/)
// Asumsi: root proyek adalah 2 level di atas direktori file ini
$uploadDir = realpath(__DIR__ . '/../../../') . '/image_tss/';

// Pastikan folder ada, jika tidak, buat foldernya
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Logic 1: UPDATE facility (EDIT)
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];

    $updateData = [
        'nama' => $nama,
        'kategori' => $kategori,
        'deskripsi' => $deskripsi
    ];
    
    $fasilitasModel->updateFasilitas($id, $updateData);
    
    // Handle 3 image slots
    for ($i = 0; $i < 3; $i++) {
        $input_name = 'gambar_' . $i;
        $img_id_name = 'img_id_' . $i;
        $existing_id = isset($_POST[$img_id_name]) ? $_POST[$img_id_name] : '';

        if (!empty($_FILES[$input_name]['tmp_name']) && is_uploaded_file($_FILES[$input_name]['tmp_name'])) {
            $fileInfo = pathinfo(basename($_FILES[$input_name]['name']));
            $nama_file_bersih = time() . "_" . $i . "_" . str_replace(' ', '_', $fileInfo['filename']) . ".webp";
            $folder = $uploadDir . $nama_file_bersih;

            if (compressToWebP($_FILES[$input_name]['tmp_name'], $folder)) {
                if (!empty($existing_id)) {
                    // Update existing image
                    $fasilitasModel->updateDokumentasi($existing_id, "image_tss/" . $nama_file_bersih);
                } else {
                    // Insert new image
                    $fasilitasModel->insertDokumentasi($id, "image_tss/" . $nama_file_bersih);
                }
            }
        }
    }
    
    // REDIRECT SETELAH UPDATE BERHASIL
    echo "<!DOCTYPE html><html><head><script src='/assets/js/sweetalert2.min.js'></script></head><body>
    <script>
        Swal.fire({title: 'Berhasil!', text: 'Data fasilitas berhasil diupdate!', icon: 'success'}).then(() => {
            window.location.replace('kelola_fasilitas');
        });
    </script></body></html>";
    exit;
}

// Logic 2: CREATE new facility (SIMPAN)
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];

    $data = [
        'nama' => $nama,
        // PERBAIKAN: Gunakan 'kategori' sesuai nama kolom yang valid
        'kategori' => $kategori, 
        'deskripsi' => $deskripsi
    ];
    
    $fasilitasModel->createFasilitas($data);
    
    // Get newly created fasilitas ID
    $newFasilitas = $fasilitasModel->getLatestFasilitasByName($nama);
    $fasilitas_id = $newFasilitas['id'];

    if (!empty($_FILES['gambar']['tmp_name']) && is_uploaded_file($_FILES['gambar']['tmp_name'])) {
        $fileInfo = pathinfo(basename($_FILES['gambar']['name']));
        $nama_file_bersih = time() . "_clean_" . str_replace(' ', '_', $fileInfo['filename']) . ".webp";
        $folder = $uploadDir . $nama_file_bersih;

        // Pindahkan file ke target directory dengan konversi WebP
        if (compressToWebP($_FILES['gambar']['tmp_name'], $folder)) {
            // Jika berhasil, simpan nama file ke database
            $fasilitasModel->insertDokumentasi($fasilitas_id, "image_tss/" . $nama_file_bersih);
        } else {
            // Tampilkan error jika unggah gagal
             echo "<!DOCTYPE html><html><head><script src='/assets/js/sweetalert2.min.js'></script></head><body><script>Swal.fire({title: 'Error!', text: 'Gagal memindahkan dan kompresi file. Periksa izin folder.', icon: 'error'}).then(() => { window.history.back(); });</script></body></html>";
        }
    }
    
    // REDIRECT SETELAH SIMPAN BERHASIL
    echo "<!DOCTYPE html><html><head><script src='/assets/js/sweetalert2.min.js'></script></head><body>
    <script>
        Swal.fire({title: 'Berhasil!', text: 'Data fasilitas baru berhasil disimpan!', icon: 'success'}).then(() => {
            window.location.replace('kelola_fasilitas');
        });
    </script></body></html>";
    exit;
}

// Logic 3: DELETE facility
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'] ?? '';
    
    if ($id) {
        // PROSES HAPUS GAMBAR FISIK & DATABASE DULU
        $images = $fasilitasModel->getDokumentasiImages($id);
        foreach ($images as $image_path) {
            // Gunakan path absolut yang sama
            $full_path = realpath(__DIR__ . '/../../../') . '/' . ltrim($image_path, '/');
            if (file_exists($full_path)) {
                unlink($full_path);
            }
        }

        // Delete dokumentasi records
        $fasilitasModel->deleteDokumentasiByFasilitas($id);
        
        // Delete facility record
        $fasilitasModel->deleteFasilitas($id);
        
        // SETELAH DATA TERHAPUS, BARU MUNCULKAN ALERT & REDIRECT
        echo "<!DOCTYPE html><html><head><script src='/assets/js/sweetalert2.min.js'></script></head><body>
        <script>
            Swal.fire({title: 'Terhapus!', text: 'Fasilitas berhasil dihapus!', icon: 'success'}).then(() => {
                window.location.replace('kelola_fasilitas');
            });
        </script></body></html>";
        exit;
    }
}

// Logic 4: TOGGLE VISIBILITY facility
if (isset($_GET['action']) && $_GET['action'] == 'toggle_visibility') {
    $id = $_GET['id'] ?? '';
    $status = $_GET['status'] ?? 1;
    
    if ($id) {
        $fasilitasModel->updateFasilitas($id, ['is_visible' => (int)$status]);
        
        $pesan = $status ? 'Fasilitas kini ditampilkan!' : 'Fasilitas telah disembunyikan!';
        $redirect_to = $_SERVER['HTTP_REFERER'] ?? 'kelola_fasilitas';
        
        echo "<!DOCTYPE html><html><head><script src='/assets/js/sweetalert2.min.js'></script></head><body>
        <script>
            Swal.fire({title: 'Berhasil!', text: '$pesan', icon: 'success'}).then(() => {
                window.location.replace('$redirect_to');
            });
        </script></body></html>";
        exit;
    }
}

// JIKA MENGAKSES FILE TANPA POST/GET, KEMBALIKAN KE HALAMAN KELOLA FASILITAS
echo "<script>window.location.replace('kelola_fasilitas');</script>";
exit;
?>
