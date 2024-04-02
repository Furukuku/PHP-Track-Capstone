<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carts extends CI_Controller {
    /**
     * Renders and displays the products dashboard
     * @return void
     */
    public function index() {
        $this->load->view("partials/customer/header");
        $this->load->view("partials/customer/nav");
        $this->load->view("carts/index");
        $this->load->view("partials/customer/footer");
    }
}