<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carts extends CI_Controller {
    /**
     * Renders and displays the products dashboard
     * @return void
     */
    public function index() {
        $user = $this->session->userdata("user");
        
        if ($user) {
            $this->load->view("partials/customer/header");
            $this->load->view("partials/customer/nav", array("user" => $user));
            $this->load->view("carts/index");
            $this->load->view("partials/customer/footer");
        } else {
            return redirect("login");
        }
    }
}