<?php

require_once __DIR__ . '/../core/Database.php';

class GazebroModel
{
    private $koneksi;

    public function __construct()
    {
        $this->koneksi = Database::connect();
    }

    /**
     * Get total gazebos count
     */
    public function getTotalCount()
    {
        $query = mysqli_query($this->koneksi, "SELECT COUNT(id) as total FROM gazebos");
        return mysqli_fetch_assoc($query)['total'];
    }

    /**
     * Get booked gazebos count for today
     */
    public function getTerisilToday()
    {
        $hari_ini_db = date('Y-m-d');
        $query = mysqli_query($this->koneksi, "SELECT COUNT(id) as terisi FROM bookings WHERE tanggal_kunjungan = '$hari_ini_db' AND status = 'terisi'");
        return mysqli_fetch_assoc($query)['terisi'];
    }

    /**
     * Get all gazebos ordered
     */
    public function getAllGazebos()
    {
        $query = mysqli_query($this->koneksi, "SELECT * FROM gazebos ORDER BY CAST(nomor_gazebo AS UNSIGNED) ASC, nomor_gazebo ASC");
        $gazebos = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $gazebos[] = $row;
        }
        return $gazebos;
    }

    /**
     * Get all bookings by date
     */
    public function getBookingsByDate($tanggal_filter)
    {
        $tanggal_filter = mysqli_real_escape_string($this->koneksi, $tanggal_filter);
        $query = mysqli_query($this->koneksi, "SELECT * FROM bookings WHERE tanggal_kunjungan = '$tanggal_filter' AND status = 'terisi'");
        $bookings = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $bookings[] = $row;
        }
        return $bookings;
    }

    /**
     * Get booked gazebos for specific date
     */
    public function getBookedGazebosforDate($tanggal_filter)
    {
        $tanggal_filter = mysqli_real_escape_string($this->koneksi, $tanggal_filter);
        $query = mysqli_query($this->koneksi, "
            SELECT b.gazebo_id, g.nomor_gazebo 
            FROM bookings b 
            JOIN gazebos g ON b.gazebo_id = g.id 
            WHERE b.tanggal_kunjungan = '$tanggal_filter' AND b.status = 'terisi'
        ");
        $booked = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $booked[$row['gazebo_id']] = $row['nomor_gazebo'];
        }
        return $booked;
    }

    /**
     * Get gazebo by nomor
     */
    public function getGazebroByNomor($nomor_gazebo)
    {
        $nomor_gazebo = mysqli_real_escape_string($this->koneksi, $nomor_gazebo);
        $query = mysqli_query($this->koneksi, "SELECT id FROM gazebos WHERE nomor_gazebo = '$nomor_gazebo'");
        return mysqli_fetch_assoc($query);
    }

    /**
     * Check if booking exists
     */
    public function checkBookingExists($gazebo_id, $tanggal_kunjungan)
    {
        $gazebo_id = mysqli_real_escape_string($this->koneksi, $gazebo_id);
        $tanggal_kunjungan = mysqli_real_escape_string($this->koneksi, $tanggal_kunjungan);
        $cek_booking = mysqli_query($this->koneksi, "SELECT id FROM bookings WHERE gazebo_id = '$gazebo_id' AND tanggal_kunjungan = '$tanggal_kunjungan'");
        return mysqli_fetch_assoc($cek_booking);
    }

    /**
     * Update booking status
     */
    public function updateBooking($gazebo_id, $tanggal_kunjungan, $status)
    {
        $gazebo_id = mysqli_real_escape_string($this->koneksi, $gazebo_id);
        $tanggal_kunjungan = mysqli_real_escape_string($this->koneksi, $tanggal_kunjungan);
        $status = mysqli_real_escape_string($this->koneksi, $status);
        
        $query = "UPDATE bookings SET status = '$status' WHERE gazebo_id = '$gazebo_id' AND tanggal_kunjungan = '$tanggal_kunjungan'";
        return mysqli_query($this->koneksi, $query) or die(mysqli_error($this->koneksi));
    }

    /**
     * Insert new booking
     */
    public function insertBooking($gazebo_id, $tanggal_kunjungan, $status = 'terisi')
    {
        $gazebo_id = mysqli_real_escape_string($this->koneksi, $gazebo_id);
        $tanggal_kunjungan = mysqli_real_escape_string($this->koneksi, $tanggal_kunjungan);
        $status = mysqli_real_escape_string($this->koneksi, $status);
        
        // PERBAIKAN: Menghapus kolom id dan UUID() dari query INSERT
        $query = "INSERT INTO bookings (gazebo_id, tanggal_kunjungan, status) VALUES ('$gazebo_id', '$tanggal_kunjungan', '$status')";
        return mysqli_query($this->koneksi, $query) or die(mysqli_error($this->koneksi));
    }

    /**
     * Delete booking
     */
    public function deleteBooking($gazebo_id, $tanggal_kunjungan)
    {
        $gazebo_id = mysqli_real_escape_string($this->koneksi, $gazebo_id);
        $tanggal_kunjungan = mysqli_real_escape_string($this->koneksi, $tanggal_kunjungan);
        
        $query = "DELETE FROM bookings WHERE gazebo_id = '$gazebo_id' AND tanggal_kunjungan = '$tanggal_kunjungan'";
        return mysqli_query($this->koneksi, $query);
    }

    /**
     * Get schedule/jadwal
     */
    public function getJadwal($tanggal_filter)
    {
        $tanggal_filter = mysqli_real_escape_string($this->koneksi, $tanggal_filter);
        $sql = "SELECT b.*, g.nomor_gazebo FROM bookings b 
                JOIN gazebos g ON b.gazebo_id = g.id 
                WHERE b.tanggal_kunjungan = '$tanggal_filter' AND b.status = 'terisi'";
        $query = mysqli_query($this->koneksi, $sql);
        $schedules = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $schedules[] = $row;
        }
        return $schedules;
    }

    /**
     * Save or update booking with full details
     */
    public function saveBooking($gazebo_id, $tanggal_kunjungan, $data)
    {
        $gazebo_id = mysqli_real_escape_string($this->koneksi, $gazebo_id);
        $tanggal_kunjungan = mysqli_real_escape_string($this->koneksi, $tanggal_kunjungan);
        
        $nama_pemesan = mysqli_real_escape_string($this->koneksi, $data['nama_pemesan']);
        $no_whatsapp = mysqli_real_escape_string($this->koneksi, $data['no_whatsapp']);
        $durasi = mysqli_real_escape_string($this->koneksi, $data['durasi']);
        
        $jam_mulai = !empty($data['jam_mulai']) ? "'" . mysqli_real_escape_string($this->koneksi, $data['jam_mulai']) . "'" : "NULL";
        $jam_selesai = !empty($data['jam_selesai']) ? "'" . mysqli_real_escape_string($this->koneksi, $data['jam_selesai']) . "'" : "NULL";
        
        $booking = $this->checkBookingExists($gazebo_id, $tanggal_kunjungan);
        
        if ($booking) {
            // Update existing booking
            $booking_id = $booking['id'];
            $query = "UPDATE bookings SET 
                      nama_pemesan = '$nama_pemesan', 
                      no_whatsapp = '$no_whatsapp', 
                      durasi = '$durasi',
                      jam_mulai = $jam_mulai,
                      jam_selesai = $jam_selesai,
                      status = 'terisi'
                      WHERE id = '$booking_id'";
            return mysqli_query($this->koneksi, $query) or die(mysqli_error($this->koneksi));
        } else {
            // Insert new booking
            // PERBAIKAN: Menghapus kolom id dan UUID() dari query INSERT
            $query = "INSERT INTO bookings (gazebo_id, tanggal_kunjungan, nama_pemesan, no_whatsapp, durasi, jam_mulai, jam_selesai, status) 
                      VALUES ('$gazebo_id', '$tanggal_kunjungan', '$nama_pemesan', '$no_whatsapp', '$durasi', $jam_mulai, $jam_selesai, 'terisi')";
            return mysqli_query($this->koneksi, $query) or die(mysqli_error($this->koneksi));
        }
    }
}