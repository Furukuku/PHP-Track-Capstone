<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    /**
     * Renders and displays the products dashboard
     * @return void
     */
    public function index() {
        $this->load->view("partials/customer/header");
        $this->load->view("partials/customer/nav");
        $this->load->view("products/index");
        $this->load->view("partials/customer/footer");
    }

    /**
     * Renders and displays a specific product
     * @return void
     */
    public function viewProduct($id) {
        $this->load->view("partials/customer/header");
        $this->load->view("partials/customer/nav");
        $this->load->view("products/view");
        $this->load->view("partials/customer/footer");
    }

    /**
     * Renders and displays the product dashboard of the admin
     * @return void
     */
    public function myProducts() {
        $this->load->view("partials/admin/header");
        $this->load->view("partials/admin/nav");
        $this->load->view("products/my-products");
        $this->load->view("partials/admin/footer");
    }

    /**
     * Renders and displays the product dashboard of the admin
     * @return void
     */
    public function orders() {
        $this->load->view("partials/admin/header");
        $this->load->view("partials/admin/nav");
        $this->load->view("products/orders");
        $this->load->view("partials/admin/footer");
    }
}