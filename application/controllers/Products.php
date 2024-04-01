<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    /**
     * Renders and displays the products dashboard
     * @return void
     */
    public function index() {
        $this->load->view("partials/header");
        $this->load->view("partials/nav");
        $this->load->view("products/index");
        $this->load->view("partials/footer");
    }

    /**
     * Renders and displays a specific product
     * @return void
     */
    public function viewProduct($id) {
        $this->load->view("partials/header");
        $this->load->view("partials/nav");
        $this->load->view("products/view");
        $this->load->view("partials/footer");
    }
}