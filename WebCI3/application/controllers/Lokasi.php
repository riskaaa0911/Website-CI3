<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *  @property session $session
 * @property form $input
 */
class Lokasi extends CI_Controller {

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

    public function index() {
        // URL API untuk mendapatkan data lokasi
        $api_url_lokasi = 'http://localhost:3000/lokasi';
        $response_lokasi = $this->sendRequest($api_url_lokasi);
        $lokasi_list = json_decode($response_lokasi, true);

        // Inisialisasi array untuk menyimpan data lokasi
        $lokasi_data = array();

        // Loop melalui setiap lokasi
        foreach ($lokasi_list as $lokasi) {
            $lokasi_data[] = $lokasi;
        }

        // Kirim data ke view
        $data['lokasi'] = $lokasi_data;
        $this->load->view('lokasi_list', $data);
    }

    public function add() {
        // Load form view
        $this->load->view('lokasi_add');
    }

    public function save() {
        // Ambil data dari form
        $data = array(
            'namaLokasi' => $this->input->post('namaLokasi'),
            'negara' => $this->input->post('negara'),
            'provinsi' => $this->input->post('provinsi'),
            'kota' => $this->input->post('kota'),
        );
        // Kirim data ke API untuk disimpan
        $api_url = 'http://localhost:3000/lokasi';
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Mengirim data dalam format JSON
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); // Set header JSON
        $response = curl_exec($ch);
        curl_close($ch);
    
        // Redirect setelah berhasil disimpan
        $this->session->set_flashdata('success', 'Lokasi berhasil ditambahkan!');
        redirect('lokasi');
    }
    
    public function delete($id) {
        // URL API untuk menghapus lokasi berdasarkan ID
        $api_url = 'http://localhost:3000/lokasi/' . $id;
        // Kirim permintaan DELETE ke API
        $response_delete = $this->sendRequest($api_url, 'DELETE');

        // Cek apakah respons berisi indikasi bahwa penghapusan berhasil
        if (strpos($response_delete, 'deleted') !== false) { // Asumsikan API mengembalikan string 'deleted' saat penghapusan berhasil
            $this->session->set_flashdata('success', 'Lokasi berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menghapus lokasi.');
        }
        redirect('lokasi');
    }  
    
    public function edit($id) {
        // URL API untuk mendapatkan data lokasi berdasarkan ID
        $api_url_lokasi = 'http://localhost:3000/lokasi/' . $id;
        $response_lokasi = $this->sendRequest($api_url_lokasi);
        $lokasi = json_decode($response_lokasi, true);
    
        // Menyediakan data lokasi ke view edit
        $data['lokasi'] = $lokasi;
    
        // Load view untuk form edit
        $this->load->view('lokasi_edit', $data);
    }
    
    public function update() {
        // Ambil data dari form
        $id = $this->input->post('id');
        $data = array(
           'namaLokasi' => $this->input->post('namaLokasi'),
           'negara' => $this->input->post('negara'),
           'provinsi' => $this->input->post('provinsi'),
           'kota' => $this->input->post('kota'),
        );
    
        // Kirim data ke API untuk diupdate
        $api_url = 'http://localhost:3000/lokasi/' . $id;
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); // Gunakan metode PUT untuk update
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Mengirim data dalam format JSON
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); // Set header JSON
        $response = curl_exec($ch);
        curl_close($ch);
    
        // Redirect setelah berhasil disimpan
        $this->session->set_flashdata('success', 'Lokasi berhasil diupdate!');
        redirect('lokasi');
    }
      
}