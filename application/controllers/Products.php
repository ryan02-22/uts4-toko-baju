<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('logged_in')){
            redirect('auth/login');
        }

        $role = $this->session->userdata('role');
        
        // Fallback for older sessions
        if (!$role) {
            $email = $this->session->userdata('user');
            if (!$email) $email = $this->session->userdata('user_email');
            if ($email) {
                $user = $this->db->get_where('users', ['email' => $email])->row_array();
                if ($user) {
                    $role = $user['role'];
                    $this->session->set_userdata('role', $role);
                }
            }
        }

        // Restrict if not admin
        if ($role !== 'admin') {
            redirect('shop');
        }

        $this->load->model('Product_model');
    }

    public function index()
    {
        $data['title'] = 'Manage Products';
        $data['products'] = $this->Product_model->get_all();
        
        $this->load->view('layout/header', $data);
        $this->load->view('products/index', $data);
        $this->load->view('layout/footer');
    }

    public function create()
    {
        if ($this->input->post()) {
            $image_name = 'default.jpg';

            if (!empty($_FILES['image']['name'])) {
                $config['upload_path']   = './assets/images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
                $config['max_size']      = 5000;
                $config['file_name']     = time() . '_' . preg_replace('/[^a-zA-Z0-9.-]/', '_', $_FILES['image']['name']);

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $uploadData = $this->upload->data();
                    $image_name = $uploadData['file_name'];
                }
            }

            $data = [
                'name' => $this->input->post('name'),
                'category' => $this->input->post('category'),
                'price' => $this->input->post('price'),
                'stock' => $this->input->post('stock'),
                'description' => $this->input->post('description'),
                'image' => $image_name
            ];
            $this->Product_model->insert($data);
            redirect('products');
        }

        $data['title'] = 'Add Product';
        $this->load->view('layout/header', $data);
        $this->load->view('products/create', $data);
        $this->load->view('layout/footer');
    }

    public function edit($id)
    {
        $data['product'] = $this->Product_model->get_by_id($id);
        
        if (empty($data['product'])) {
            redirect('products');
        }
        
        if ($this->input->post()) {
            $update_data = [
                'name' => $this->input->post('name'),
                'category' => $this->input->post('category'),
                'price' => $this->input->post('price'),
                'stock' => $this->input->post('stock'),
                'description' => $this->input->post('description'),
            ];

            if (!empty($_FILES['image']['name'])) {
                $config['upload_path']   = './assets/images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
                $config['max_size']      = 5000;
                $config['file_name']     = time() . '_' . preg_replace('/[^a-zA-Z0-9.-]/', '_', $_FILES['image']['name']);

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $uploadData = $this->upload->data();
                    $update_data['image'] = $uploadData['file_name'];
                    
                    if (!empty($data['product']['image']) && $data['product']['image'] != 'default.jpg') {
                        @unlink('./assets/images/' . $data['product']['image']);
                    }
                }
            }

            $this->Product_model->update($id, $update_data);
            redirect('products');
        }

        $data['title'] = 'Edit Product';
        $this->load->view('layout/header', $data);
        $this->load->view('products/edit', $data);
        $this->load->view('layout/footer');
    }

    public function delete($id)
    {
        $this->Product_model->delete($id);
        redirect('products');
    }
}
