<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    /**
     * Loads all the necessary models
     * @return void
     */
    public function __construct() { 
        parent::__construct();
        $this->load->model("Category");
        $this->load->model("Product");
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
            $product_count = count($this->Product->getAllProducts());
            $category_label = "All Products ({$product_count})";
            $this->load->view("partials/customer/header");
            $this->load->view("partials/customer/nav", array("user" => $user));
            $this->load->view("products/index", array(
                "categories" => $this->Category->getAllCategories(),
                "products" => $this->Product->getAllProducts(),
                "csrf" => $csrf,
                "category_label" => $category_label,
                "success" => $this->session->flashdata("success")
            ));
            $this->load->view("partials/customer/footer");
        } else {
            return redirect("login");
        }
    }

    /**
     * Handles the process for filtering products based on category
     * @return void
     */
    public function filter() {
        $user = $this->session->userdata("user");
        
        if ($user) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $category = $this->Category->getCategoryById($this->input->get("category"));
            $product_count = count($this->Product->getAllProductsByCategory($this->input->get("category")));
            
            if ($category == null) {
                return redirect("products");
            }

            $category_label = "{$category["name"]} ({$product_count})";
            $this->load->view("partials/customer/header");
            $this->load->view("partials/customer/nav", array("user" => $user));
            $this->load->view("products/index", array(
                "categories" => $this->Category->getAllCategories(),
                "products" => $this->Product->getAllProductsByCategory($this->input->get("category")),
                "csrf" => $csrf,
                "category_label" => $category_label,
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
        $user = $this->session->userdata("user");
        
        if ($user) {
            $product = $this->Product->getProductById($id);
            $images = json_decode($product["img_links"]);
            $this->load->view("partials/customer/header");
            $this->load->view("partials/customer/nav", array("user" => $user));
            $this->load->view("products/view", array(
                "product" => $product,
                "images" => $images
            ));
            $this->load->view("partials/customer/footer");
        } else {
            return redirect("login");
        }
    }

    /**
     * Renders and displays the form for adding product
     * @return void
     */
    public function addProductHtml() {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view("partials/forms/add-product", array(
            "csrf" => $csrf,
            "categories" => $this->Category->getAllCategories(),
            "errors" =>  $this->session->flashdata("errors"),
            "images" =>  $this->session->flashdata("images")
        ));
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
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->load->view("partials/admin/header");
            $this->load->view("partials/admin/nav", array(
                "user" => $user,
                "csrf" => $csrf,
                "categories" => $this->Category->getAllCategories()
            ));
            $this->load->view("products/my-products", array(
                "categories" => $this->Category->getAllCategories(),
                "products" => $this->Product->getAllProducts(),
                "csrf" => $csrf,
                "success" => $this->session->flashdata("success")
            ));
            $this->load->view("partials/admin/footer");
        } else {
            return redirect("products");
        }
    }

    /**
     * Handles the creation process of a product
     */
    public function create() {
        $product = $this->Product->validateProduct($this->input->post(), $_FILES["images"]);
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        if ($product && $this->Product->createProduct($product)) {
            $this->session->set_flashdata("success", "Product added succesfully!");
            return redirect("my-products");
        } else {
            $this->load->view("partials/forms/add-product", array(
                "csrf" => $csrf,
                "categories" => $this->Category->getAllCategories(),
                "errors" =>  $this->session->flashdata("errors"),
                "images" =>  $this->session->flashdata("images")
            ));
        }

    }
}