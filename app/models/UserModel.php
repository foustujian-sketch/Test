<?php

require_once __DIR__ . '/../core/Database.php';

class UserModel
{
    private $koneksi;

    public function __construct()
    {
        $this->koneksi = Database::connect();
    }

    /**
     * FUNGSI BARU: Update data user secara fleksibel (Username & Password)
     * Ini untuk memperbaiki error "undefined method updateUser"
     */
    public function updateUser($id, $data)
    {
        if (empty($id) || empty($data)) return false;
        
        $id = mysqli_real_escape_string($this->koneksi, $id);
        $updates = [];

        foreach ($data as $key => $value) {
            $key = mysqli_real_escape_string($this->koneksi, $key);
            $value = mysqli_real_escape_string($this->koneksi, $value);
            $updates[] = "$key = '$value'";
        }

        if (empty($updates)) return false;

        // Menggunakan nama tabel 'users' sesuai struktur database kamu
        $sql = "UPDATE users SET " . implode(", ", $updates) . " WHERE id = '$id'";
        return mysqli_query($this->koneksi, $sql);
    }

    /**
     * Get user by username
     */
    public function getUserByUsername($username)
    {
        if (empty($username)) return null;
        
        $username = mysqli_real_escape_string($this->koneksi, $username);
        $result = mysqli_query($this->koneksi, "SELECT * FROM users WHERE username = '$username'");
        return mysqli_fetch_assoc($result);
    }

    /**
     * Get user by id
     */
    public function getUserById($id)
    {
        if (empty($id)) return null;
        
        $id = mysqli_real_escape_string($this->koneksi, $id);
        $query = mysqli_query($this->koneksi, "SELECT * FROM users WHERE id = '$id'");
        return mysqli_fetch_assoc($query);
    }

    /**
     * Get first user
     */
    public function getFirstUser()
    {
        $query = mysqli_query($this->koneksi, "SELECT id FROM users LIMIT 1");
        return mysqli_fetch_assoc($query);
    }

    /**
     * Check if user exists
     */
    public function userExists($username)
    {
        if (empty($username)) return false;
        
        $username = mysqli_real_escape_string($this->koneksi, $username);
        $cek = mysqli_query($this->koneksi, "SELECT username FROM users WHERE username = '$username'");
        return mysqli_num_rows($cek) > 0;
    }

    /**
     * Get user password
     */
    public function getUserPassword($user_id)
    {
        if (empty($user_id)) return null;
        
        $user_id = mysqli_real_escape_string($this->koneksi, $user_id);
        $query = mysqli_query($this->koneksi, "SELECT password FROM users WHERE id = '$user_id'");
        return mysqli_fetch_assoc($query);
    }

    /**
     * Verify password
     */
    public function verifyPassword($plain_password, $hashed_password)
    {
        if (empty($plain_password) || empty($hashed_password)) return false;
        return password_verify($plain_password, $hashed_password);
    }

    /**
     * Hash password
     */
    public function hashPassword($password)
    {
        if (empty($password)) return false;
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Insert new user
     */
    public function insertUser($username, $hashed_password)
    {
        if (empty($username) || empty($hashed_password)) return false;
        
        $username = mysqli_real_escape_string($this->koneksi, $username);
        // Note: we assume role is admin or default by the DB schema
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        return mysqli_query($this->koneksi, $sql);
    }

    public function getAllUsers()
    {
        $result = mysqli_query($this->koneksi, "SELECT id, username, is_approved FROM users ORDER BY username ASC");
        $users = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
        }
        return $users;
    }

    public function updateApproval($id, $status)
    {
        if (empty($id)) return false;
        $id = mysqli_real_escape_string($this->koneksi, $id);
        $status = (int)$status;
        return mysqli_query($this->koneksi, "UPDATE users SET is_approved = $status WHERE id = '$id'");
    }
}