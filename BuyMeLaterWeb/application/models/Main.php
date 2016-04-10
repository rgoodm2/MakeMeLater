<?php 

class Main extends CI_Model {
     function get_all_products()
     {
         return $this->db->query("SELECT * FROM courses")->result_array();
     }
     function get_product_by_id($course_id)
     {
         return $this->db->query("SELECT * FROM courses WHERE id = ?", array($course_id))->row_array();
     }
     function add_product($course)
     {
         $query = "INSERT INTO Courses (name, description, created_at) VALUES (?,?,?)";
         $values = array($course['name'], $course['description'], date("Y-m-d, H:i:s")); 
         return $this->db->query($query, $values);
     }
     function remove_product($id)
     {
         $query = "DELETE FROM Courses WHERE id = ?";
         return $this->db->query($query, $id);
     }
}


?>