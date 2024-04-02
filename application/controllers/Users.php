<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    /**
     * Renders and displays the login page
     * @return void
     */
    public function login() {
        $this->load->view("partials/customer/header");
        $this->load->view("users/login");
        $this->load->view("partials/customer/footer");
    }

    /**
     * Renders and displays the sign up page
     * @return void
     */
    public function signup() {
        $this->load->view("partials/customer/header");
        $this->load->view("users/sign-up");
        $this->load->view("partials/customer/footer");
    }
}