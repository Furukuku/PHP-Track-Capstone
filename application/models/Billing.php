<?php
class Billing extends CI_Model {
    /**
     * Creates a new billing informations based on the order
     * @param array Array of billing informations
     * @return int Id of the newly created billing info
     */
    public function createBilling($data) {
        $query = "INSERT INTO billing_informations (first_name, last_name, address_1, address_2, city, state, zip_code, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW());";
        $values = array();

        if (!isset($data["same_billing"])) {
            $values[] = $data["billing_first_name"];
            $values[] = $data["billing_last_name"];
            $values[] = $data["billing_address_1"];
            $values[] = $data["billing_address_2"];
            $values[] = $data["billing_city"];
            $values[] = $data["billing_state"];
            $values[] = $data["billing_zip_code"];
        } else {
            $values[] = $data["shipping_first_name"];
            $values[] = $data["shipping_last_name"];
            $values[] = $data["shipping_address_1"];
            $values[] = $data["shipping_address_2"];
            $values[] = $data["shipping_city"];
            $values[] = $data["shipping_state"];
            $values[] = $data["shipping_zip_code"];
        }

        if ($this->db->query($query, $values)) {
            return $this->db->insert_id();
        }

        return false;
    }
}