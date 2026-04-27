<?php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../app/models/FasilitasModel.php';

function respond($data, $status = 200)
{
    http_response_code($status);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

$fasilitasModel = new FasilitasModel();
$method = $_SERVER['REQUEST_METHOD'];
$action = $_REQUEST['action'] ?? '';

if ($method === 'GET') {
    $id = $_GET['id'] ?? null;
    $kategori = $_GET['kategori'] ?? null;

    if ($id) {
        $facility = $fasilitasModel->getFasilitasById($id);
        if (!$facility) {
            respond(['error' => 'Fasilitas tidak ditemukan'], 404);
        }
        $facility['dokumentasi'] = $fasilitasModel->getDokumentasi($id);
        respond(['data' => $facility]);
    }

    // PERBAIKAN: Menggunakan fungsi yang benar sesuai dengan FasilitasModel.php terbaru
    if ($kategori === 'pendukung') {
        $facilities = $fasilitasModel->getFasilitasPendukung();
    } elseif ($kategori === 'utama') {
        $facilities = $fasilitasModel->getFasilitasUtama();
    } else {
        $utama = $fasilitasModel->getFasilitasUtama();
        $pendukung = $fasilitasModel->getFasilitasPendukung();
        $facilities = array_merge($utama, $pendukung);
    }

    respond(['data' => $facilities]);
}

if ($method === 'POST') {
    if ($action === 'delete') {
        $id = $_POST['id'] ?? '';
        if (!$id) {
            respond(['error' => 'ID fasilitas dibutuhkan'], 400);
        }

        $images = $fasilitasModel->getDokumentasiImages($id);
        foreach ($images as $image_path) {
            $full_path = __DIR__ . '/../' . ltrim($image_path, '/');
            if (file_exists($full_path)) {
                @unlink($full_path);
            }
        }

        $fasilitasModel->deleteDokumentasiByFasilitas($id);
        $fasilitasModel->deleteFasilitas($id);
        respond(['message' => 'Fasilitas berhasil dihapus']);
    }

    if ($action === 'update') {
        $id = $_POST['id'] ?? '';
        if (!$id) {
            respond(['error' => 'ID fasilitas dibutuhkan'], 400);
        }

        $data = [
            'nama' => $_POST['nama'] ?? '',
            'kategori' => $_POST['kategori'] ?? '',
            'deskripsi' => $_POST['deskripsi'] ?? ''
        ];

        $fasilitasModel->updateFasilitas($id, $data);

        if (!empty($_FILES['gambar']['name'])) {
            $uploadDir = __DIR__ . '/../image_tss/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = time() . '_' . basename($_FILES['gambar']['name']);
            $target = $uploadDir . $filename;

            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
                $docs = $fasilitasModel->getDokumentasi($id, 1);
                if (!empty($docs)) {
                    $fasilitasModel->updateDokumentasi($docs[0]['id'], 'image_tss/' . $filename);
                } else {
                    $fasilitasModel->insertDokumentasi($id, 'image_tss/' . $filename);
                }
            }
        }

        respond(['message' => 'Fasilitas berhasil diperbarui']);
    }

    if ($action === 'create') {
        $nama = $_POST['nama'] ?? '';
        $kategori = $_POST['kategori'] ?? 'utama';
        $deskripsi = $_POST['deskripsi'] ?? '';

        if ($nama === '') {
            respond(['error' => 'Nama fasilitas dibutuhkan'], 400);
        }

        $fasilitasModel->createFasilitas([
            'nama' => $nama,
            'kategori' => $kategori,
            'deskripsi' => $deskripsi
        ]);

        $last = $fasilitasModel->getLatestFasilitasByName($nama);
        $newId = $last['id'] ?? null;

        if ($newId && !empty($_FILES['gambar']['name'])) {
            $uploadDir = __DIR__ . '/../image_tss/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = time() . '_' . basename($_FILES['gambar']['name']);
            $target = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
                $fasilitasModel->insertDokumentasi($newId, 'image_tss/' . $filename);
            }
        }

        respond(['message' => 'Fasilitas baru berhasil dibuat']);
    }
}

respond(['error' => 'Metode tidak didukung'], 405);