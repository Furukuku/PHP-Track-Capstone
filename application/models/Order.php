<?php
class Order extends CI_Model {
    /**
     * Loads the necessary models and libries
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model("User");
        $this->load->model("Cart");
        $this->load->model("Billing");
        $this->load->model("Shipping");
        $this->load->library("form_validation");
    }

    /**
     * Adds the ordered items to orders table
     * @return bool True if successfully added
     */
    public function createOrder() {
        $orders = $this->Cart->searchItemInCart();
        $order_info = $this->session->userdata("order_info");
        $billing_id = $this->Billing->createBilling($order_info);
        $shipping_id = $this->Shipping->createShipping($order_info);
        
        if ($billing_id !== false && $shipping_id !== false) {
            $query = "INSERT INTO orders (product_id, billing_information_id, shipping_information_id, quantity, amount, created_at, updated_at) VALUES ";
            $values = array();
            
            foreach ($orders as $key => $order) {
                $query .= $key == (count($orders) - 1) ? "(?, ?, ?, ?, ?, NOW(), NOW());" : " (?, ?, ?, ?, ?, NOW(), NOW()),";
                $values[] = $order["product_id"];
                $values[] = $billing_id;
                $values[] = $shipping_id;
                $values[] = $order["quantity"];
                $values[] = $order["amount"];
            }

            $this->db->query($query, $values);

            $this->Cart->removeItemsInCart();
            return true;
        }

        return false;
    }

    /**
     * Validates the user's order information
     * @param array Array of the inputted user's order information
     * @return array Sanitized user's order information
     */
    public function validateOrderInformation($data) {
        if (isset($data["same_billing"]) && $data["same_billing"] === "on") {
            $this->runValidation("shipping");

            if (!$this->form_validation->run()) {
                $this->form_validation->set_error_delimiters('<p class="text-danger error">', '</p>');
                $this->session->set_flashdata("errors", array(
                    "shipping_first_name" => form_error("shipping_first_name"),
                    "shipping_last_name" => form_error("shipping_last_name"),
                    "shipping_address_1" => form_error("shipping_address_1"),
                    "shipping_address_2" => form_error("shipping_address_2"),
                    "shipping_city" => form_error("shipping_city"),
                    "shipping_state" => form_error("shipping_state"),
                    "shipping_zip_code" => form_error("shipping_zip_code")
                ));
                return false;
            }
        } else {
            $this->runValidation("shipping");
            $this->runValidation("billing");

            if (!$this->form_validation->run()) {
                $this->form_validation->set_error_delimiters('<p class="text-danger error">', '</p>');
                $this->session->set_flashdata("errors", array(
                    "shipping_first_name" => form_error("shipping_first_name"),
                    "shipping_last_name" => form_error("shipping_last_name"),
                    "shipping_address_1" => form_error("shipping_address_1"),
                    "shipping_address_2" => form_error("shipping_address_2"),
                    "shipping_city" => form_error("shipping_city"),
                    "shipping_state" => form_error("shipping_state"),
                    "shipping_zip_code" => form_error("shipping_zip_code"),
                    "billing_first_name" => form_error("billing_first_name"),
                    "billing_last_name" => form_error("billing_last_name"),
                    "billing_address_1" => form_error("billing_address_1"),
                    "billing_address_2" => form_error("billing_address_2"),
                    "billing_city" => form_error("billing_city"),
                    "billing_state" => form_error("billing_state"),
                    "billing_zip_code" => form_error("billing_zip_code")
                ));
                return false;
            }
        }

        return $this->User->xssFilter($data);
    }

    /**
     * Sets the validation
     * @param string Name of the form
     * @return void
     */
    private function runValidation($form_name) {
        $this->form_validation->set_rules("{$form_name}_first_name", "First Name", "trim|required|max_length[45]|alpha");
        $this->form_validation->set_rules("{$form_name}_last_name", "Last Name", "trim|required|max_length[45]|alpha");
        $this->form_validation->set_rules("{$form_name}_address_1", "Address 1", "trim|required|max_length[150]");
        $this->form_validation->set_rules("{$form_name}_address_2", "Address 2", "trim|required|max_length[150]");
        $this->form_validation->set_rules("{$form_name}_city", "City", "trim|required|max_length[45]");
        $this->form_validation->set_rules("{$form_name}_state", "State", "trim|required|max_length[45]");
        $this->form_validation->set_rules("{$form_name}_zip_code", "Zip Code", "trim|required|max_length[45]");
    }
}