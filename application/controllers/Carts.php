<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carts extends CI_Controller {
    /**
     * Renders and displays the products dashboard
     * @return void
     */
    public function index() {
        $this->load->view("partials/header");
        $this->load->view("partials/nav");
        $this->load->view("carts/index");
        $this->load->view("partials/footer");
    }
}