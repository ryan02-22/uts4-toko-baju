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
        // Simple auth for demonstration
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Create standard session (would normally check DB here)
        if($email) {
            $this->session->set_userdata([
                'user' => $email,
                'logged_in' => TRUE
            ]);
            redirect('shop');
        } else {
            redirect('auth/login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('shop');
    }
}
