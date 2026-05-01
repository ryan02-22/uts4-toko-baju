<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Transaksi_model');

        // Cek login - jika belum login, redirect ke login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        // Cek role - hanya admin yang bisa akses
        if ($this->session->userdata('role') !== 'admin') {
            redirect('shop');
        }
    }

    // =============================================
    // Dashboard Admin
    // =============================================
    public function index()
    {
        $user_id = $this->session->userdata('user_id');

        $data['title'] = 'Admin Dashboard';
        $data['total_users'] = $this->User_model->get_total_users();
        $data['total_admins'] = $this->User_model->get_total_admins();
        $data['total_customers'] = $this->User_model->get_total_customers();
        $data['total_transactions'] = count($this->Transaksi_model->get_all_transaksi());
        $data['recent_transactions'] = array_slice($this->Transaksi_model->get_all_transaksi(), 0, 5);

        $this->load->view('layout/admin_header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('layout/admin_footer');
    }

    // =============================================
    // Profile Admin - Lihat Data Profil
    // =============================================
    public function profile()
    {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $data['title'] = 'My Profile';
        $data['transactions'] = $this->User_model->get_user_transactions($user_id);

        $this->load->view('layout/admin_header', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('layout/admin_footer');
    }

    // =============================================
    // Profile Admin - Edit Data Profil
    // =============================================
    public function edit_profile()
    {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $data['title'] = 'Edit Profile';

        $this->load->view('layout/admin_header', $data);
        $this->load->view('admin/edit_profile', $data);
        $this->load->view('layout/admin_footer');
    }

    // =============================================
    // Profile Admin - Update Profil
    // =============================================
    public function update_profile()
    {
        $user_id = $this->session->userdata('user_id');

        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email')
        ];

        $this->User_model->update_user($user_id, $data);

        // Update session
        $this->session->set_userdata([
            'user' => $data['name'],
            'email' => $data['email']
        ]);

        $this->session->set_flashdata('success', 'Profile berhasil diperbarui');
        redirect('admin/profile');
    }

    // =============================================
    // Profile Admin - Ubah Password
    // =============================================
    public function change_password()
    {
        $user_id = $this->session->userdata('user_id');
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');

        // Validasi
        $user = $this->User_model->get_user_by_id($user_id);

        if (!password_verify($old_password, $user->password)) {
            $this->session->set_flashdata('error', 'Password lama salah');
            redirect('admin/profile');
            return;
        }

        if ($new_password !== $confirm_password) {
            $this->session->set_flashdata('error', 'Password baru tidak cocok');
            redirect('admin/profile');
            return;
        }

        // Update password
        $this->User_model->update_password($user_id, $new_password);
        $this->session->set_flashdata('success', 'Password berhasil diubah');
        redirect('admin/profile');
    }

    // =============================================
    // Transaksi - List Semua Transaksi
    // =============================================
    public function transaksi()
    {
        $data['transaksi'] = $this->Transaksi_model->get_all_transaksi();
        $data['title'] = 'Daftar Transaksi';

        $this->load->view('layout/admin_header', $data);
        $this->load->view('admin/transaksi/index', $data);
        $this->load->view('layout/admin_footer');
    }

    // =============================================
    // Transaksi - Lihat Detail Transaksi
    // =============================================
    public function view_transaksi($id)
    {
        $data['transaksi'] = $this->Transaksi_model->get_transaksi_by_id($id);
        $data['details'] = $this->Transaksi_model->get_detail_by_transaksi_id($id);
        $data['title'] = 'Detail Transaksi';

        $this->load->view('layout/admin_header', $data);
        $this->load->view('admin/transaksi/view', $data);
        $this->load->view('layout/admin_footer');
    }

    // =============================================
    // Transaksi - Tambah Transaksi Baru
    // =============================================
    public function create_transaksi()
    {
        $data['title'] = 'Tambah Transaksi';
        $data['produk'] = $this->Transaksi_model->get_all_produk();
        $data['customers'] = $this->User_model->get_all_users();

        $this->load->view('layout/admin_header', $data);
        $this->load->view('admin/transaksi/create', $data);
        $this->load->view('layout/admin_footer');
    }

    // =============================================
    // Transaksi - Proses Simpan Transaksi Baru
    // =============================================
    public function store_transaksi()
    {
        $user_id = $this->input->post('user_id');
        $shipping_address = $this->input->post('shipping_address');
        $status = $this->input->post('status');

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
            'status' => $status,
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

        $this->session->set_flashdata('success', 'Transaksi berhasil ditambahkan');
        redirect('admin/transaksi');
    }

    // =============================================
    // Transaksi - Form Edit Transaksi
    // =============================================
    public function edit_transaksi($id)
    {
        $data['transaksi'] = $this->Transaksi_model->get_transaksi_by_id($id);
        $data['details'] = $this->Transaksi_model->get_detail_by_transaksi_id($id);
        $data['produk'] = $this->Transaksi_model->get_all_produk();
        $data['customers'] = $this->User_model->get_all_users();
        $data['title'] = 'Edit Transaksi';

        $this->load->view('layout/admin_header', $data);
        $this->load->view('admin/transaksi/edit', $data);
        $this->load->view('layout/admin_footer');
    }

    // =============================================
    // Transaksi - Proses Update Transaksi
    // =============================================
    public function update_transaksi($id)
    {
        $shipping_address = $this->input->post('shipping_address');
        $status = $this->input->post('status');

        // Hitung total dari semua item
        $product_ids = $this->input->post('product_id');
        $quantities = $this->input->post('quantity');
        $prices = $this->input->post('price');

        $total_amount = 0;
        for ($i = 0; $i < count($product_ids); $i++) {
            $total_amount += $quantities[$i] * $prices[$i];
        }

        // Data transaksi update
        $transaksi_data = [
            'total_amount' => $total_amount,
            'status' => $status,
            'shipping_address' => $shipping_address
        ];

        // Update header transaksi
        $this->Transaksi_model->update_transaksi($id, $transaksi_data);

        // Hapus detail transaksi lama
        $this->db->delete('transaction_details', ['transaction_id' => $id]);

        // Simpan detail transaksi baru
        for ($i = 0; $i < count($product_ids); $i++) {
            $detail_data = [
                'transaction_id' => $id,
                'product_id' => $product_ids[$i],
                'quantity' => $quantities[$i],
                'price' => $prices[$i],
                'subtotal' => $quantities[$i] * $prices[$i]
            ];
            $this->Transaksi_model->create_detail($detail_data);
        }

        $this->session->set_flashdata('success', 'Transaksi berhasil diperbarui');
        redirect('admin/transaksi');
    }

    // =============================================
    // Transaksi - Hapus Transaksi
    // =============================================
    public function delete_transaksi($id)
    {
        $this->Transaksi_model->delete_transaksi($id);
        $this->session->set_flashdata('success', 'Transaksi berhasil dihapus');
        redirect('admin/transaksi');
    }
}
