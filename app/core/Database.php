<?php

class Database
{
    // Konfigurasi default Laragon
    private static $host = "localhost";
    private static $user = "root";      // Default user Laragon adalah root
    private static $pass = "";          // Default password Laragon adalah kosong
    private static $db   = "db_salma_shofa"; // Nama database sesuai permintaanmu

    private static $koneksi;

    public static function connect()
    {
        if (!self::$koneksi) {
            self::$koneksi = mysqli_connect(self::$host, self::$user, self::$pass, self::$db);

            if (!self::$koneksi) {
                die("Koneksi Database Gagal: " . mysqli_connect_error());
            }
        }

        return self::$koneksi;
    }
}