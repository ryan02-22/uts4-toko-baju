<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Luxe Threads - Premium Online Clothing';
		$data['products'] = [
            [
                'id' => 1,
                'name' => 'Midnight Velvet Jacket',
                'price' => 'Rp 850.000',
                'image' => 'jacket.jpg',
                'category' => 'Outerwear'
            ],
            [
                'id' => 2,
                'name' => 'Classic Oxford Shirt',
                'price' => 'Rp 450.000',
                'image' => 'shirt.jpg',
                'category' => 'Tops'
            ],
            [
                'id' => 3,
                'name' => 'Urban Cargo Pants',
                'price' => 'Rp 550.000',
                'image' => 'pants.jpg',
                'category' => 'Bottoms'
            ],
            [
                'id' => 4,
                'name' => 'Silk Elegance Dress',
                'price' => 'Rp 1.200.000',
                'image' => 'dress.jpg',
                'category' => 'Dresses'
            ],
            [
                'id' => 5,
                'name' => 'Vintage Denim Jacket',
                'price' => 'Rp 750.000',
                'image' => 'denim.jpg',
                'category' => 'Outerwear'
            ],
            [
                'id' => 6,
                'name' => 'Cozy Knit Sweater',
                'price' => 'Rp 350.000',
                'image' => 'sweater.jpg',
                'category' => 'Tops'
            ]
        ];

		$this->load->view('layout/header', $data);
		$this->load->view('shop/index', $data);
		$this->load->view('layout/footer');
	}
}
