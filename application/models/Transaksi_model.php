<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    // =============================================
    // READ - Ambil Semua Data Transaksi
    // =============================================
    public function get_all_transaksi()
    {
        $this->db->select('transactions.*, users.name as customer_name');
        $this->db->from('transactions');
        $this->db->join('users', 'users.id = transactions.user_id', 'left');
        $this->db->order_by('transactions.id', 'DESC');
        return $this->db->get()->result();
    }

    // =============================================
    // READ - Ambil Data Transaksi Berdasarkan ID
    // =============================================
    public function get_transaksi_by_id($id)
    {
        return $this->db->get_where('transactions', ['id' => $id])->row();
    }

    // =============================================
    // CREATE - Tambah Transaksi Baru
    // =============================================
    public function create_transaksi($data)
    {
        $this->db->insert('transactions', $data);
        return $this->db->insert_id();
    }

    // =============================================
    // UPDATE - Update Data Transaksi
    // =============================================
    public function update_transaksi($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('transactions', $data);
        return $this->db->affected_rows();
    }

    // =============================================
    // DELETE - Hapus Transaksi
    // =============================================
    public function delete_transaksi($id)
    {
        // Hapus detail transaksi dulu
        $this->db->delete('transaction_details', ['transaction_id' => $id]);
        // Baru hapus header transaksi
        $this->db->delete('transactions', ['id' => $id]);
        return $this->db->affected_rows();
    }

    // =============================================
    // READ - Ambil Detail Transaksi
    // =============================================
    public function get_detail_by_transaksi_id($transaction_id)
    {
        $this->db->select('transaction_details.*, products.name as product_name');
        $this->db->from('transaction_details');
        $this->db->join('products', 'products.id = transaction_details.product_id', 'left');
        $this->db->where('transaction_details.transaction_id', $transaction_id);
        return $this->db->get()->result();
    }

    // =============================================
    // CREATE - Tambah Detail Transaksi
    // =============================================
    public function create_detail($data)
    {
        $this->db->insert('transaction_details', $data);
    }

    // =============================================
    // READ - Ambil Semua Produk (untuk dropdown)
    // =============================================
    public function get_all_produk()
    {
        return $this->db->get('products')->result();
    }

    // =============================================
    // GET - Total Transaksi (untuk dashboard)
    // =============================================
    public function get_total_transaksi()
    {
        return $this->db->count_all('transactions');
    }

    // =============================================
    // GET - Total Pendapatan
    // =============================================
    public function get_total_revenue()
    {
        return $this->db->select_sum('total_amount')->get('transactions')->row()->total_amount ?? 0;
    }

    // =============================================
    // GET - Transaksi Terakhir (n buah)
    // =============================================
    public function get_recent_transaksi($limit = 5)
    {
        $this->db->select('transactions.*, users.name as customer_name');
        $this->db->from('transactions');
        $this->db->join('users', 'users.id = transactions.user_id', 'left');
        $this->db->order_by('transactions.transaction_date', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    // =============================================
    // GET - Transaksi Berdasarkan Status
    // =============================================
    public function get_transaksi_by_status($status)
    {
        $this->db->select('transactions.*, users.name as customer_name');
        $this->db->from('transactions');
        $this->db->join('users', 'users.id = transactions.user_id', 'left');
        $this->db->where('transactions.status', $status);
        $this->db->order_by('transactions.transaction_date', 'DESC');
        return $this->db->get()->result();
    }

    // =============================================
    // GET - Produk Terlaris
    // =============================================
    public function get_top_products($limit = 5)
    {
        $this->db->select('products.*, SUM(transaction_details.quantity) as total_qty');
        $this->db->from('transaction_details');
        $this->db->join('products', 'products.id = transaction_details.product_id', 'left');
        $this->db->group_by('products.id');
        $this->db->order_by('total_qty', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
}
