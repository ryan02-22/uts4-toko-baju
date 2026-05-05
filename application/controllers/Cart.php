<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
    }

    public function index()
    {
        $data['title'] = 'Shopping Cart';
        $this->load->view('layout/header', $data);
        $this->load->view('cart/index', $data);
        $this->load->view('layout/footer');
    }

    public function add($id)
    {
        $product = $this->Product_model->get_by_id($id);
        
        if ($product) {
            $data = array(
                'id'      => $product['id'],
                'qty'     => 1,
                'price'   => $product['price'],
                'name'    => $product['name'],
                'image'   => !empty($product['image']) ? $product['image'] : 'default.jpg'
            );
            $this->cart->insert($data);
        }
        redirect('cart');
    }

    public function remove($rowid)
    {
        $this->cart->remove($rowid);
        redirect('cart');
    }

    public function update()
    {
        $i = 1;
        foreach ($this->cart->contents() as $item) {
            $data = array(
                'rowid' => $item['rowid'],
                'qty'   => $this->input->post($i . '[qty]')
            );
            $this->cart->update($data);
            $i++;
        }
        redirect('cart');
    }

    public function checkout()
    {
        if(!$this->session->userdata('logged_in')){
            $this->session->set_flashdata('error', 'Please login to checkout.');
            redirect('auth/login');
        }

        if (empty($this->cart->contents())) {
            redirect('shop');
        }

        $data['title'] = 'Checkout';
        $this->load->view('layout/header', $data);
        $this->load->view('cart/checkout', $data);
        $this->load->view('layout/footer');
    }

    public function process_checkout()
    {
        if(!$this->session->userdata('logged_in')){
            redirect('auth/login');
        }

        $user_id = $this->session->userdata('user_id');

        // Fallback for older sessions before the update
        if (!$user_id) {
            $email = $this->session->userdata('user');
            if (!$email) $email = $this->session->userdata('user_email');
            
            if ($email) {
                $user = $this->db->get_where('users', ['email' => $email])->row_array();
                if ($user) {
                    $user_id = $user['id'];
                    $this->session->set_userdata('user_id', $user_id);
                }
            }
        }

        // Force relogin if user_id is still not found
        if (!$user_id) {
            $this->session->sess_destroy();
            redirect('auth/login');
        }

        $address = $this->input->post('address');

        if(empty($address)){
            redirect('cart/checkout');
        }

        // Insert into transactions
        $transaction_data = [
            'user_id' => $user_id,
            'total_amount' => $this->cart->total(),
            'status' => 'pending',
            'shipping_address' => $address
        ];
        $this->db->insert('transactions', $transaction_data);
        $transaction_id = $this->db->insert_id();

        // Insert into transaction_details
        foreach ($this->cart->contents() as $item) {
            $detail_data = [
                'transaction_id' => $transaction_id,
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal']
            ];
            $this->db->insert('transaction_details', $detail_data);
        }

        $this->cart->destroy();
        
        $data['title'] = 'Checkout Success';
        $this->load->view('layout/header', $data);
        $this->load->view('cart/success', $data);
        $this->load->view('layout/footer');
    }
}
