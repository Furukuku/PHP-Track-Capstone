<?php
class Shipping extends CI_Model {
    /**
     * Creates a new shipping informations based on the order
     * @param array Array of shipping informations
     * @return int Id of the newly created shipping info
     */
    public function createShipping($data) {
        $query = "INSERT INTO shipping_informations (first_name, last_name, address_1, address_2, city, state, zip_code, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW());";
        $values = array(
            $data["shipping_first_name"], 
            $data["shipping_last_name"], 
            $data["shipping_address_1"], 
            $data["shipping_address_2"], 
            $data["shipping_city"], 
            $data["shipping_state"], 
            $data["shipping_zip_code"]
        );

        if ($this->db->query($query, $values)) {
            return $this->db->insert_id();
        }

        return false;
    }
}