<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carts extends CI_Controller {
    /**
     * Loads the necessary models
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model("Cart");
    }

    /**
     * Renders and displays the products dashboard
     * @return void
     */
    public function index() {
        $user = $this->session->userdata("user");
        
        if ($user) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->load->view("partials/customer/header");
            $this->load->view("partials/customer/nav", array(
                "user" => $user,
                "cart_count" => $this->Cart->countItemInCart()
            ));
            $this->load->view("carts/index", array("csrf" => $csrf));
            $this->load->view("partials/customer/footer");
        } else {
            return redirect("login");
        }
    }

    

    /**
     * Renders the item list in the cart
     * @return void
     */
    public function itemListHtml() {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view("partials/customer/cart-list", array(
            "csrf" => $csrf,
            "items" => $this->Cart->getAllItemInCart()
        ));
    }

    /**
     * Handles the process of adding item to cart
     * @return void
     */
    public function add() {
        $user = $this->session->userdata("user");

        if ($user) {
            if ($this->Cart->addToCart($this->input->post())) {
                $this->session->set_flashdata("success", "Item added to cart successfully!");
            } else {
                $this->session->set_flashdata("error", "Something went wrong, please try again");
            }
        }

        $response = array(
            "cart" => $this->Cart->countItemInCart(),
            "toast" => $this->toast()
        );
        echo json_encode($response);
    }

    /**
     * Handles the process of updating items on the cart
     * @return void
     */
    public function update() {
        $user = $this->session->userdata("user");

        if ($user) {
            if ($this->Cart->updateItemInCart($this->input->post())) {
                $this->session->set_flashdata("success", "Item updated successfully!");
            } else {
                $this->session->set_flashdata("error", "Something went wrong, please try again");
            }
        }
    }

    /**
     * Handles the process of removing an item on the cart
     * @return void
     */
    public function remove() {
        $user = $this->session->userdata("user");

        if ($user) {
            if ($this->Cart->deleteItemInCart($this->input->post("item_id"))) {
                $this->session->set_flashdata("success", "Item removed successfully!");
            } else {
                $this->session->set_flashdata("error", "Something went wrong, please try again");
            }
        }

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $html = $this->load->view("partials/customer/cart-list", array(
            "csrf" => $csrf,
            "items" => $this->Cart->getAllItemInCart()
        ), TRUE);

        $response = array(
            "html" => $html,
            "toast" => $this->toast()
        );
        echo json_encode($response);
    }

    /**
     * Renders the toasters
     * @return html HTML toasters
     */
    private function toast() {
        return $this->load->view("partials/toast", array(
            "success" => $this->session->flashdata("success"),
            "error" => $this->session->flashdata("error")
        ), TRUE);
    }
}