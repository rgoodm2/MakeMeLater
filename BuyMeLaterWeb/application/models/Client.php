<?php 

class Client extends CI_Model {

	public function get_images($count){
		/*Here we get can limit the amount of images we return*/
		$query = "SELECT * FROM images LEFT JOIN products ON products.id = images.product_id LIMIT ?";
		$values = $count;
		return $this->db->query($query, $values)->result_array();
	}
	public function get_images_by_category_id($id){
		/*is it all products?*/
		if ($id == 0) {
			$query = "SELECT image, products.name, products.price, products.id FROM images LEFT JOIN products ON products.id = images.product_id";
		}else{
			$query = "SELECT image, products.name, products.price, products.id FROM images LEFT JOIN products ON products.id = images.product_id WHERE products.category_id = ?";
		}
		$values = $id;
		return $this->db->query($query,$values)->result_array();
	}
	public function get_category_by_category_id($id){
		/*is it all products?*/
		if ($id == 0){
			return 'ALL PRODUCTS';
		}else{
			$query = "SELECT category FROM categories WHERE id = ?";
			$values = $id;
			return $this->db->query($query,$values)->row_array();
		}
	}
	public function get_show($id){
		$query = "SELECT * FROM products LEFT JOIN images ON images.product_id = products.id WHERE products.id = ?";
		$values = $id;
		return $this->db->query($query,$values)->row_array();
	}
	public function add_order($order,$products){
		$query = "INSERT INTO orders (first_name, last_name, address, city, state, zipcode, stripeToken, stripeTokenType, stripeEmail, created_at, updated_at, status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
		$values = array($order['first_name'],$order['last_name'], $order['address'], $order['city'], $order['state'], $order['zipcode'], $order['stripeToken'], $order['stripeTokenType'], $order['stripeEmail'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"), 'Order in');
		$this->db->query($query,$values);
		$id = $this->db->insert_id();
		$query = "INSERT INTO products_has_order (quantity, product_id, order_id) VALUES(?,?,?)";
		foreach ($products as $product) {
			$values = array($product['quantity'], $product['id'], $id);
			$this->db->query($query,$values);
		}
	}
}