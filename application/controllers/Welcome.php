<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent ::__construct();
		$this -> load -> model('Product_model', 'product');
		$this -> load -> library('form_validation');
	}

	/**
	 * Ürünlerin listelendiği alan
	 */
	public function index()
	{
		$data = new stdClass();
		$data -> products = $this -> product -> getList('products', '*', ['isActive' => 1]);
		$this -> load -> view('welcome_message', $data);
	}

	/**
	 * ürünlerin sepete eklendiği adım
	 */
	public function insertCart()
	{
		if ($this -> input -> is_ajax_request() && $this -> input -> method() == 'post') {
			$config = [
				['field' => 'id',
				 'label' => 'id',
				 'rules' => 'trim|required'],
				['field' => 'qty',
				 'label' => 'qty',
				 'rules' => 'trim|required']
			];
			$this -> form_validation -> set_rules($config);
			if ($this -> form_validation -> run() == FALSE) {
				validation_errors('<p>', '</p>');
			} else {
				$product = $this -> product -> selectOne('products', '*', ['id' => $this -> input -> post('id'), 'isActive' => 1]);
				$basket = ['id' => $product -> id,
						   'qty' => $this -> input -> post('qty'),
						   'price' => $product -> price,
						   'name' => $product -> productName];
				if($this -> cart -> insert($basket))
					$this->showCart();
				else
					echo 'ürün sepete eklenemedi.';
			}
		} else {
			echo 'ajax veya post yapılmadı.';
		}
	}

	/**
	 * ürünlerin sepette güncellendiği adım
	 */
	public function updateCart()
	{
		if ($this -> input -> is_ajax_request() && $this -> input -> method() == 'post') {
			$config = [
				['field' => 'rowid',
				 'label' => 'rowid',
				 'rules' => 'trim|required'],
				['field' => 'qty',
				 'label' => 'qty',
				 'rules' => 'trim|required']
			];
			$this -> form_validation -> set_rules($config);
			if ($this -> form_validation -> run() == FALSE) {
				validation_errors('<p>', '</p>');
			} else {
				$basket = ['rowid' => $this->input->post('rowid'),
						   'qty' => $this->input->post('qty')];
				if ($this -> cart -> update($basket))
					$this -> showCart();
			}
		} else {
			echo 'ajax veya post yapılmadı.';
		}
	}

	/**
	 * sağ üstteki sepeti güncelliyor.
	*/
	private function showCart()
	{
		$carts = $this -> cart -> contents();
		$array = [];
		foreach ($carts as $cart) {
			$array[$cart['rowid']] = [
				'id' => $cart['id'],
				'qty' => $cart['qty'],
				'price' => $this -> cart -> format_number($cart['price']),
				'name' => $cart['name'],
				'subtotal' => $this -> cart -> format_number($cart['subtotal']),
				'rowid'=>$cart['rowid']
			];
		}
		echo json_encode($array);
	}

	/**
	 * ürünlerden birini sepetten çıkarma
	 */
	public function deleteOneProductInCart()
	{
		if ($this -> input -> is_ajax_request() && $this -> input -> method() == 'post') {
			$config = [
				['field' => 'rowid',
				 'label' => 'rowid',
				 'rules' => 'trim|required']
			];
			$this -> form_validation -> set_rules($config);
			if ($this -> form_validation -> run() == FALSE) {
				validation_errors('<p>', '</p>');
			} else {
				if($this -> cart -> remove($this->input->post('rowid')))
					$this->showCart();
			}
		} else {
			echo 'ajax veya post yapılmadı.';
		}
	}

	/**
	 * sepeti tamamen temizleme adımı.
	 */
	public function deleteCart()
	{
		if ($this -> input -> is_ajax_request() && $this -> input -> method() == 'post') {
			$this -> cart -> destroy();
		} else {
			echo 'ajax veya post yapılmadı.';
		}
	}
	
	/*---------------------------------------*/
	/**
	 * Çoklu ürün sepeti oluşturma. ürün paketi vardır kampanyalı, laptop, çantası, fare.
	 */
	/*---------------------------------------*/
	
	/**
	 * sepet listesi
	*/
	public function basket()
	{
		$this->load->view('basket');
	}
}
