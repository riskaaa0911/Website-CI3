<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *  @property session $session
 * @property form $input
 */
class Proyek extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');

    }
    private function sendRequest($url, $method = 'GET', $data = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        } elseif ($method == 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            // Jika API tidak memerlukan payload, hapus opsi ini
            if ($data) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            }
        }
    
        $response = curl_exec($ch);
    
        if (curl_errno($ch)) {
            $error_msg = 'Curl error: ' . curl_error($ch);
            curl_close($ch);
            return $error_msg;
        }
    
        curl_close($ch);
        return $response;
    }

    // private function sendRequest($url) {
    //     // Initialize cURL session
    //     $ch = curl_init();

    //     // Set URL and other necessary options
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //     // Execute the request and get the response
    //     $response = curl_exec($ch);

    //     // Close the cURL session
    //     curl_close($ch);

    //     return $response;
    // }

    public function index() {
        // URL API untuk mendapatkan data proyek
        $api_url_proyek = 'http://localhost:3000/proyek';
        $response_proyek = $this->sendRequest($api_url_proyek);
        $proyek_list = json_decode($response_proyek, true);

        // Inisialisasi array untuk menyimpan proyek dengan detail lokasi
        $proyek_data = array();

        // Loop melalui setiap proyek
        foreach ($proyek_list as $proyek) {
            // URL API untuk mendapatkan detail lokasi berdasarkan idLokasi
            $api_url_lokasi = 'http://localhost:3000/lokasi/' . $proyek['idLokasi'];
            $response_lokasi = $this->sendRequest($api_url_lokasi);
            $lokasi = json_decode($response_lokasi, true);

            // Gabungkan proyek dengan detail lokasi
            $proyek['lokasi'] = $lokasi;
            $proyek_data[] = $proyek;
        }

        // Kirim data ke view
        $data['proyek'] = $proyek_data;
        $this->load->view('proyek_list', $data);
    }

    public function add() {
        // Load data lokasi untuk dropdown
        $api_url_lokasi = 'http://localhost:3000/lokasi';
        $response_lokasi = $this->sendRequest($api_url_lokasi);
        $data['lokasi_list'] = json_decode($response_lokasi, true);

        // Load form view
        $this->load->view('proyek_add', $data);
    }

    public function save() {
        // Ambil data dari form
        $data = array(
            'namaProyek' => $this->input->post('namaProyek'),
            'client' => $this->input->post('client'),
            'tglMulai' => date('Y-m-d\TH:i:s', strtotime($this->input->post('tglMulai'))),
            'tglSelesai' => date('Y-m-d\TH:i:s', strtotime($this->input->post('tglSelesai'))),
            'pimpinanProyek' => $this->input->post('pimpinanProyek'),
            'keterangan' => $this->input->post('keterangan'),
            'idLokasi' => $this->input->post('idLokasi')
        );
        // Kirim data ke API untuk disimpan
        $api_url = 'http://localhost:3000/proyek';
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Mengirim data dalam format JSON
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); // Set header JSON
        $response = curl_exec($ch);
        curl_close($ch);
    
        // Redirect setelah berhasil disimpan
        $this->session->set_flashdata('success', 'Proyek berhasil ditambahkan!');
        redirect('proyek');
    }
    
    public function delete($id) {
        // URL API untuk menghapus proyek berdasarkan ID
        $api_url = 'http://localhost:3000/proyek/' . $id;
        // Kirim permintaan DELETE ke API
        $response_delete = $this->sendRequest($api_url, 'DELETE');

        // Cek apakah respons berisi indikasi bahwa penghapusan berhasil
        if (strpos($response_delete, 'deleted') !== false) { // Asumsikan API mengembalikan string 'deleted' saat penghapusan berhasil
            $this->session->set_flashdata('success', 'Proyek berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menghapus proyek.');
        }
        redirect('proyek');
    }  
    public function edit($id) {
        // URL API untuk mendapatkan data proyek berdasarkan ID
        $api_url_proyek = 'http://localhost:3000/proyek/' . $id;
        $response_proyek = $this->sendRequest($api_url_proyek);
        $proyek = json_decode($response_proyek, true);
    
        // URL API untuk mendapatkan data lokasi
        $api_url_lokasi = 'http://localhost:3000/lokasi';
        $response_lokasi = $this->sendRequest($api_url_lokasi);
        $data['lokasi_list'] = json_decode($response_lokasi, true);
    
        // Menyediakan data proyek ke view edit
        $data['proyek'] = $proyek;
    
        // Load view untuk form edit
        $this->load->view('proyek_edit', $data);
    }
    
    public function update() {
        // Ambil data dari form
        $id = $this->input->post('id');
        $data = array(
            'namaProyek' => $this->input->post('namaProyek'),
            'client' => $this->input->post('client'),
            'tglMulai' => date('Y-m-d\TH:i:s', strtotime($this->input->post('tglMulai'))),
            'tglSelesai' => date('Y-m-d\TH:i:s', strtotime($this->input->post('tglSelesai'))),
            'pimpinanProyek' => $this->input->post('pimpinanProyek'),
            'keterangan' => $this->input->post('keterangan'),
            'idLokasi' => $this->input->post('idLokasi')
        );
    
        // Kirim data ke API untuk diupdate
        $api_url = 'http://localhost:3000/proyek/' . $id;
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); // Gunakan metode PUT untuk update
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Mengirim data dalam format JSON
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); // Set header JSON
        $response = curl_exec($ch);
        curl_close($ch);
    
        // Redirect setelah berhasil disimpan
        $this->session->set_flashdata('success', 'Proyek berhasil diupdate!');
        redirect('proyek');
    }
        
    
}