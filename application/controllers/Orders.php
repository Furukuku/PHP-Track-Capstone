<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
    /**
     * Loads the necessary models
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model("Order");
    }

    /**
     * Renders and displays the product dashboard of the admin
     * @return void
     */
    public function index() {
        $user = $this->session->userdata("user");

        if (!$user) {
            return redirect("login");
        } else if ($user["is_admin"] == 1) {
            $this->load->view("partials/admin/header");
            $this->load->view("partials/admin/nav", array("user" => $user));
            $this->load->view("products/orders");
            $this->load->view("partials/admin/footer");
        } else {
            return redirect("products");
        }
    }

    /**
     * Handles the success process of placing order
     * @return void
     */
    public function successPayment() {
        // if ($this->Order->createOrder()) {
        // }
        $this->Order->createOrder();
        return redirect("cart"); //CONTINUE HERE
    }
}