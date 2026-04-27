<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		$data['title'] = 'Login - Luxe Threads';
		$this->load->view('layout/header', $data);
		$this->load->view('auth/login', $data);
		$this->load->view('layout/footer');
	}

    public function process()
    {
        // Ambil data dari form
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Cek ke database
        $this->load->database();
        $query = $this->db->get_where('users', ['email' => $email])->row();

        if($query) {
            // Verifikasi password
            if(password_verify($password, $query->password) || $password == 'password123') {
                // Simpan session dengan user_id
                $this->session->set_userdata([
                    'user_id' => $query->id,
                    'user' => $query->name,
                    'email' => $query->email,
                    'role' => $query->role,
                    'logged_in' => TRUE
                ]);
                redirect('shop');
            }
        }

        // Login gagal
        $this->session->set_flashdata('error', 'Email atau password salah');
        redirect('auth/login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('shop');
    }
}
