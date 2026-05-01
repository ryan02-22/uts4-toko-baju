<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    // =============================================
    // READ - Ambil Data User Berdasarkan ID
    // =============================================
    public function get_user_by_id($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    // =============================================
    // READ - Ambil Data User Berdasarkan Email
    // =============================================
    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    // =============================================
    // READ - Ambil Semua User
    // =============================================
    public function get_all_users()
    {
        return $this->db->get('users')->result();
    }

    // =============================================
    // CREATE - Tambah User Baru
    // =============================================
    public function create_user($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    // =============================================
    // UPDATE - Update Data User
    // =============================================
    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        return $this->db->affected_rows();
    }

    // =============================================
    // DELETE - Hapus User
    // =============================================
    public function delete_user($id)
    {
        // Hapus transaksi user dulu
        $this->db->delete('transactions', ['user_id' => $id]);
        // Baru hapus user
        $this->db->delete('users', ['id' => $id]);
        return $this->db->affected_rows();
    }

    // =============================================
    // UPDATE - Update Password User
    // =============================================
    public function update_password($id, $password)
    {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $this->db->where('id', $id);
        $this->db->update('users', ['password' => $hashed_password]);
        return $this->db->affected_rows();
    }

    // =============================================
    // GET - Total User (untuk dashboard)
    // =============================================
    public function get_total_users()
    {
        return $this->db->count_all('users');
    }

    // =============================================
    // GET - Total Admin Users
    // =============================================
    public function get_total_admins()
    {
        return $this->db->get_where('users', ['role' => 'admin'])->num_rows();
    }

    // =============================================
    // GET - Total Customer Users
    // =============================================
    public function get_total_customers()
    {
        return $this->db->get_where('users', ['role' => 'customer'])->num_rows();
    }

    // =============================================
    // GET - Transaksi User (untuk profil)
    // =============================================
    public function get_user_transactions($user_id)
    {
        $this->db->select('transactions.*, users.name as customer_name');
        $this->db->from('transactions');
        $this->db->join('users', 'users.id = transactions.user_id', 'left');
        $this->db->where('transactions.user_id', $user_id);
        $this->db->order_by('transactions.transaction_date', 'DESC');
        return $this->db->get()->result();
    }
}
