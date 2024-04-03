<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
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
}