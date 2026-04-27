<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/GazebroModel.php';
require_once __DIR__ . '/../models/FasilitasModel.php';
require_once __DIR__ . '/../models/UserModel.php';

class PageController extends Controller
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

    public function home()
    {
        $this->view('pages/index');
    }

    public function informasi()
    {
        // Ambil data dari model agar halaman informasi tidak error/kosong
        $data = [
            'fasilitas_utama' => $this->fasilitasModel->getFasilitasUtama(true),
            'fasilitas_pendukung' => $this->fasilitasModel->getFasilitasPendukung(true),
            'foto_utama' => $this->fasilitasModel->getDokumentasiByKategori('utama', 3),
            'foto_pendukung' => $this->fasilitasModel->getDokumentasiByKategori('pendukung')
        ];

        // Pastikan nama file view-nya benar: app/views/pages/informasi.php
        $this->view('pages/informasi', $data);
    }

    public function fasilitas()
    {
        $baju = $this->fasilitasModel->getFasilitasByName('Sewa Baju Tradisional');

        $data = [
            'baju' => $baju,
            'dokumentasi_baju' => $baju ? $this->fasilitasModel->getDokumentasi($baju['id'], 3) : [],
            'fasilitas_utama' => $this->fasilitasModel->getFasilitasUtama(true),
            'fasilitas_pendukung' => $this->fasilitasModel->getFasilitasPendukung(true)
        ];

        $this->view('pages/fasilitas', $data);
    }

    public function gazebo()
    {
        // Ambil tanggal hari ini atau dari input user
        $tanggal = $_GET['tanggal_kunjungan'] ?? date('Y-m-d');
        
        $data = [
            'booked_dates' => $this->gazebroModel->getBookedGazebosforDate($tanggal),
            'tanggal_dipilih' => $tanggal
        ];

        // Memanggil file view: app/views/pages/gazebo.php
        $this->view('pages/gazebo', $data);
    }

    public function pricelist()
    {
        $this->view('pages/pricelist');
    }

    public function faq()
    {
        $this->view('pages/faq');
    }

    public function login()
    {
        $this->view('pages/login');
    }
}
