<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {

	public function show_products($id){
		$images['images'] = $this->Client->get_images_by_category_id($id);
		$images['category'] = $this->Client->get_category_by_category_id($id);
		$this->load->view('products_display', $images);
	}
	public function show($id){
		$item = $this->Client->get_show($id);
		$this->load->view('show_view',$item);
	}
	public function add_to_cart(){
		$product = $this->input->post();
		$product['price'] = $product['quantity'] * $product['price'];
		$products = $this->session->userdata('cart');
		// we need to iterate through the items so that we only increase the quantity if the item is a duplicate;
		$new_quantity = $this->check_for_duplicates($product,$products);
		if (intval($new_quantity['quantity']) > intval($product['quantity'])) {
			$products[$new_quantity['index']]['quantity'] = $new_quantity['quantity'];
		} else {
			$products[] = $product;
		}
		$quantity_for_res = $this->cart_count();
		$response['product_quantity'] = intval($product['quantity']);
		$response['total'] = intval($quantity_for_res);
		echo json_encode($response);
		$this->session->set_userdata('cart', $products);
	}
	public function show_orders(){
		/*You can't go to your cart if it's empty*/
		if($this->session->userdata('cart') !== null){
			$this->load->view('carts');
		}else{
			redirect('/');
		}
	}
	public function checkout(){
		/*WE LATER NEED FORM VALIDATION HERE*/
		$order = $this->input->post();
		$products = $this->session->userdata('cart');
		$this->Client->add_order($order, $products);
		$this->load->view('success');
	}
	public function destroy_session(){
		session_destroy();
		redirect('/');
	}
	public function remove_item($id){
		// var_dump($this->session->userdata('cart'));
		$temp_cart = $this->session->userdata('cart');
		$cart = $this->clean_cart($temp_cart);
		for($i=0; $i < count($cart); $i++) {
			if ($cart[$i]['id'] == $id) {
				unset($cart[$i]);
			}
		}
		$cart = $this->clean_cart($cart);
		$this->session->set_userdata('cart', $cart);
		redirect('/');
	}

	// Helper functions ->>>>>>>>>>>>>>>>>>>>>>>>>>>

	protected function clean_cart($temp_cart) {
		$cart = [];
		foreach ($temp_cart as $item) {
			$cart[] = $item;
		}
		return $cart;
	}
	protected function check_for_duplicates($product, $products) {
		$new_quantity['quantity'] = $product['quantity'];
		$new_quantity['index'] = (count($products) - 1);
		for($i = 0; $i < count($products); $i++ ){
			if ($product['id'] == $products[$i]['id']) {
				$new_quantity['quantity'] = intval($products[$i]['quantity']) + intval($product['quantity']);
				$new_quantity['index'] = $i;
			}
		}
		return $new_quantity;
	}
	protected function cart_count(){ 
	/*This will give us the cart count*/
		$quantity = 0;
		if($this->session->userdata('cart') !== null){
			$carts = $this->session->userdata('cart');
			foreach ($carts as $cart) {
				$quantity += $cart['quantity'];
			}
		}
		return $quantity;
	}
	
}
?>