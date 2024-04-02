<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    /**
     * Renders and displays the products dashboard
     * @return void
     */
    public function index() {
        $user = $this->session->userdata("user");
        if ($user) {
            $this->load->view("partials/customer/header");
            $this->load->view("partials/customer/nav", array("user" => $user));
            $this->load->view("products/index", array(
                "success" => $this->session->flashdata("success")
            ));
            $this->load->view("partials/customer/footer");
        } else {
            return redirect("login");
        }
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
        $user = $this->session->userdata("user");
        if (!$user) {
            return redirect("login");
        } else if ($user["is_admin"] == 1) {
            $this->load->view("partials/admin/header");
            $this->load->view("partials/admin/nav", array("user" => $user));
            $this->load->view("products/my-products", array(
                "success" => $this->session->flashdata("success")
            ));
            $this->load->view("partials/admin/footer");
        } else {
            return redirect("products");
        }
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