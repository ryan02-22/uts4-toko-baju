<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model');
	}

	public function index()
	{
		$data['title'] = 'Luxe Threads - Premium Online Clothing';
		$products = $this->Product_model->get_all();
		
		// Format price to match the previous string format expected by the view
		foreach ($products as &$product) {
			$product['price'] = 'Rp ' . number_format($product['price'], 0, ',', '.');
			// fallback image if empty
			if (empty($product['image'])) {
				$product['image'] = 'default.jpg';
			}
		}
		$data['products'] = $products;

		$this->load->view('layout/header', $data);
		$this->load->view('shop/index', $data);
		$this->load->view('layout/footer');
	}
}
