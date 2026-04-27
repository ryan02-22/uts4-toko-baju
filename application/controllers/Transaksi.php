<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cek login - jika belum login, redirect ke login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        // Load model
        $this->load->model('Transaksi_model');
    }

    // =============================================
    // READ - Menampilkan Daftar Transaksi
    // =============================================
    public function index() {
        $data['transaksi'] = $this->Transaksi_model->get_all_transaksi();
        $data['title'] = 'Daftar Transaksi';
        
        $this->load->view('layout/header', $data);
        $this->load->view('transaksi/index', $data);
        $this->load->view('layout/footer');
    }

    // =============================================
    // CREATE - Form Tambah Transaksi
    // =============================================
    public function create() {
        $data['title'] = 'Tambah Transaksi';
        $data['produk'] = $this->Transaksi_model->get_all_produk();
        $data['user_id'] = $this->session->userdata('user_id');
        
        $this->load->view('layout/header', $data);
        $this->load->view('transaksi/create', $data);
        $this->load->view('layout/footer');
    }

    // =============================================
    // CREATE - Proses Simpan Transaksi
    // =============================================
    public function store() {
        // Ambil data dari form
        $user_id = $this->session->userdata('user_id');
        $shipping_address = $this->input->post('shipping_address');
        
        // Hitung total dari semua item
        $product_ids = $this->input->post('product_id');
        $quantities = $this->input->post('quantity');
        $prices = $this->input->post('price');
        
        $total_amount = 0;
        for ($i = 0; $i < count($product_ids); $i++) {
            $total_amount += $quantities[$i] * $prices[$i];
        }
        
        // Data header transaksi
        $transaksi_data = [
            'user_id' => $user_id,
            'transaction_date' => date('Y-m-d H:i:s'),
            'total_amount' => $total_amount,
            'status' => 'pending',
            'shipping_address' => $shipping_address
        ];
        
        // Simpan header transaksi
        $transaction_id = $this->Transaksi_model->create_transaksi($transaksi_data);
        
        // Simpan detail transaksi
        for ($i = 0; $i < count($product_ids); $i++) {
            $detail_data = [
                'transaction_id' => $transaction_id,
                'product_id' => $product_ids[$i],
                'quantity' => $quantities[$i],
                'price' => $prices[$i],
                'subtotal' => $quantities[$i] * $prices[$i]
            ];
            $this->Transaksi_model->create_detail($detail_data);
        }
        
        // Redirect ke daftar transaksi
        redirect('transaksi');
    }

    // =============================================
    // READ - Lihat Detail Transaksi
    // =============================================
    public function view($id) {
        $data['transaksi'] = $this->Transaksi_model->get_transaksi_by_id($id);
        $data['details'] = $this->Transaksi_model->get_detail_by_transaksi_id($id);
        $data['title'] = 'Detail Transaksi';
        
        $this->load->view('layout/header', $data);
        $this->load->view('transaksi/view', $data);
        $this->load->view('layout/footer');
    }

    // =============================================
    // UPDATE - Form Edit Status Transaksi
    // =============================================
    public function edit($id) {
        $data['transaksi'] = $this->Transaksi_model->get_transaksi_by_id($id);
        $data['title'] = 'Edit Transaksi';
        
        $this->load->view('layout/header', $data);
        $this->load->view('transaksi/edit', $data);
        $this->load->view('layout/footer');
    }

    // =============================================
    // UPDATE - Proses Update Status Transaksi
    // =============================================
    public function update() {
        $id = $this->input->post('id');
        
        $data = [
            'status' => $this->input->post('status'),
            'shipping_address' => $this->input->post('shipping_address')
        ];
        
        $this->Transaksi_model->update_transaksi($id, $data);
        redirect('transaksi');
    }

    // =============================================
    // DELETE - Hapus Transaksi
    // =============================================
    public function delete($id) {
        $this->Transaksi_model->delete_transaksi($id);
        redirect('transaksi');
    }
}
