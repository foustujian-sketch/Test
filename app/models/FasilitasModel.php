<?php

require_once __DIR__ . '/../core/Database.php';

class FasilitasModel
{
    private $koneksi;

    public function __construct()
    {
        $this->koneksi = Database::connect();
    }

    /**
     * Get fasilitas by name
     */
    public function getFasilitasByName($nama)
    {
        $nama = mysqli_real_escape_string($this->koneksi, $nama);
        $query = mysqli_query($this->koneksi, "SELECT * FROM fasilitas WHERE nama = '$nama' LIMIT 1");
        return mysqli_fetch_assoc($query);
    }

    /**
     * Get fasilitas by id
     */
    public function getFasilitasById($id)
    {
        $id = mysqli_real_escape_string($this->koneksi, $id);
        $query = mysqli_query($this->koneksi, "SELECT * FROM fasilitas WHERE id = '$id'");
        return mysqli_fetch_assoc($query);
    }

    /**
     * Get all fasilitas utama (main facilities) + GAMBAR (SINKRONISASI DIPERBAIKI)
     */
    public function getFasilitasUtama($only_visible = false)
    {
        $vis_cond = $only_visible ? " AND f.is_visible = 1 " : "";
        $sql_utama = "SELECT f.*, MIN(d.gambar) as gambar 
                      FROM fasilitas f 
                      LEFT JOIN dokumentasi d ON f.id = d.fasilitas_id 
                      WHERE f.kategori = 'utama' $vis_cond
                      GROUP BY f.id 
                      ORDER BY f.nama ASC";
        $query = mysqli_query($this->koneksi, $sql_utama);
        $facilities = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $facilities[] = $row;
        }
        return $facilities;
    }

    /**
     * Get all fasilitas pendukung (supporting facilities) + GAMBAR (SINKRONISASI DIPERBAIKI)
     */
    public function getFasilitasPendukung($only_visible = false)
    {
        $vis_cond = $only_visible ? " AND f.is_visible = 1 " : "";
        $sql_pendukung = "SELECT f.*, MIN(d.gambar) as gambar 
                          FROM fasilitas f 
                          LEFT JOIN dokumentasi d ON f.id = d.fasilitas_id 
                          WHERE f.kategori = 'pendukung' $vis_cond
                          GROUP BY f.id 
                          ORDER BY f.nama ASC";
        $query = mysqli_query($this->koneksi, $sql_pendukung);
        $facilities = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $facilities[] = $row;
        }
        return $facilities;
    }

    /**
     * Get all fasilitas ordered by name
     */
    public function getAllFasilitas($only_visible = false)
    {
        $vis_cond = $only_visible ? " WHERE is_visible = 1 " : "";
        $query = mysqli_query($this->koneksi, "SELECT * FROM fasilitas $vis_cond ORDER BY nama ASC");
        $facilities = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $facilities[] = $row;
        }
        return $facilities;
    }

    /**
     * Get dokumentasi by fasilitas_id
     */
    public function getDokumentasi($fasilitas_id, $limit = null)
    {
        $fasilitas_id = mysqli_real_escape_string($this->koneksi, $fasilitas_id);
        $sql = "SELECT id, gambar FROM dokumentasi WHERE fasilitas_id = '$fasilitas_id' ORDER BY id ASC";
        if ($limit) {
            $sql .= " LIMIT $limit";
        }
        $query = mysqli_query($this->koneksi, $sql);
        $docs = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $docs[] = $row;
        }
        return $docs;
    }

    /**
     * Get dokumentasi image paths by fasilitas kategori
     */
    public function getDokumentasiByKategori($kategori, $limit = null)
    {
        $kategori = mysqli_real_escape_string($this->koneksi, $kategori);
        $sql = "SELECT d.gambar
                FROM dokumentasi d
                INNER JOIN fasilitas f ON f.id = d.fasilitas_id
                WHERE f.kategori = '$kategori' AND d.gambar IS NOT NULL AND d.gambar <> ''
                ORDER BY f.nama ASC, d.id ASC";

        if ($limit !== null) {
            $limit = (int) $limit;
            $sql .= " LIMIT $limit";
        }

        $query = mysqli_query($this->koneksi, $sql);
        $images = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $images[] = $row['gambar'];
        }

        return $images;
    }

    /**
     * Get columns from fasilitas table
     */
    public function getTableColumns()
    {
        $query = mysqli_query($this->koneksi, "SHOW COLUMNS FROM fasilitas");
        $columns = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $columns[] = $row;
        }
        return $columns;
    }

    /**
     * Create new fasilitas
     */
    public function createFasilitas($data)
    {
        $nama = mysqli_real_escape_string($this->koneksi, $data['nama']);
        $kategori = mysqli_real_escape_string($this->koneksi, $data['kategori'] ?? $data['jenis'] ?? '');
        $deskripsi = mysqli_real_escape_string($this->koneksi, $data['deskripsi']);

        $sql = "INSERT INTO fasilitas (nama, kategori, deskripsi) VALUES ('$nama', '$kategori', '$deskripsi')";
        return mysqli_query($this->koneksi, $sql);
    }

    /**
     * Update fasilitas with dynamic columns
     */
    public function updateFasilitas($id, $data)
    {
        $id = mysqli_real_escape_string($this->koneksi, $id);
        $updates = [];

        foreach ($data as $key => $value) {
            $key = mysqli_real_escape_string($this->koneksi, $key);
            
            if (strpos($key, 'harga') !== false) {
                if ($value === '' || $value === null) {
                    $updates[] = "$key = NULL"; 
                } else {
                    $harga_angka = (int)$value;
                    $updates[] = "$key = $harga_angka"; 
                }
            } else {
                $value = mysqli_real_escape_string($this->koneksi, $value);
                $updates[] = "$key = '$value'"; 
            }
        }

        $sql = "UPDATE fasilitas SET " . implode(", ", $updates) . " WHERE id = '$id'";
        return mysqli_query($this->koneksi, $sql);
    }

    /**
     * Insert dokumentasi
     */
    public function insertDokumentasi($fasilitas_id, $gambar)
    {
        $fasilitas_id = mysqli_real_escape_string($this->koneksi, $fasilitas_id);
        $gambar = mysqli_real_escape_string($this->koneksi, $gambar);

        $query = "INSERT INTO dokumentasi (fasilitas_id, gambar) VALUES ('$fasilitas_id', '$gambar')";
        return mysqli_query($this->koneksi, $query);
    }

    /**
     * Update dokumentasi
     */
    public function updateDokumentasi($doc_id, $gambar)
    {
        $doc_id = mysqli_real_escape_string($this->koneksi, $doc_id);
        $gambar = mysqli_real_escape_string($this->koneksi, $gambar);

        $query = "UPDATE dokumentasi SET gambar = '$gambar' WHERE id = '$doc_id'";
        return mysqli_query($this->koneksi, $query);
    }

    /**
     * Delete dokumentasi by fasilitas_id
     */
    public function deleteDokumentasiByFasilitas($fasilitas_id)
    {
        $fasilitas_id = mysqli_real_escape_string($this->koneksi, $fasilitas_id);
        return mysqli_query($this->koneksi, "DELETE FROM dokumentasi WHERE fasilitas_id = '$fasilitas_id'");
    }

    /**
     * Delete fasilitas
     */
    public function deleteFasilitas($id)
    {
        $id = mysqli_real_escape_string($this->koneksi, $id);
        return mysqli_query($this->koneksi, "DELETE FROM fasilitas WHERE id = '$id'");
    }

    /**
     * Get dokumentasi images for deletion
     */
    public function getDokumentasiImages($fasilitas_id)
    {
        $fasilitas_id = mysqli_real_escape_string($this->koneksi, $fasilitas_id);
        $query = mysqli_query($this->koneksi, "SELECT gambar FROM dokumentasi WHERE fasilitas_id = '$fasilitas_id'");
        $images = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $images[] = $row['gambar'];
        }
        return $images;
    }

    /**
     * Get latest fasilitas by name
     */
    public function getLatestFasilitasByName($nama)
    {
        $nama = mysqli_real_escape_string($this->koneksi, $nama);
        $query = mysqli_query($this->koneksi, "SELECT id FROM fasilitas WHERE nama = '$nama' ORDER BY id DESC LIMIT 1");
        return mysqli_fetch_assoc($query);
    }
}