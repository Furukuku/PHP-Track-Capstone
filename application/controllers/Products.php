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
        $this->load->model("Cart");
    }

/* ------------------------------------------ Start of Customer Methods ------------------------------------------ */
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
            $this->load->view("partials/customer/nav", array(
                "user" => $user,
                "cart_count" => $this->Cart->countItemInCart()
            ));
            $this->load->view("products/index", array(
                "csrf" => $csrf,
                "toast" => $this->toast(),
            ));
            $this->load->view("partials/customer/footer");
        } else {
            return redirect("login");
        }
    }

    /**
     * Renders and displays the category list for customer
     * @return void
     */
    public function customerCategoryListHtml() {
        if ($this->session->userdata("user")) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $products = $this->Product->searchProducts()["count"];
            $product_count = $products["count"];
            $category_label = "All Products ({$product_count})";
            $this->load->view("partials/customer/product-categories", array(
                "categories" => $this->Category->getAllCategories(),
                "product_count" => $product_count,
                "csrf" => $csrf
            ));
        }
    }

    /**
     * Handles the process for searching a product for customer
     * @param int Id of a category
     * @param int Offset for pagination
     * @return void
     */
    public function customerSearch($category_id, $offset) {
        if ($this->session->userdata("user")) {
            $category = $category_id === "All" ? array("name" => "All Products") : $this->Category->getCategoryById($category_id);
            $products = $this->Product->searchProducts($this->input->get("keyword"), $category_id, (($offset - 1) * 5))["products"];
            $product_count = count($products);
            $category_label = "{$category["name"]} ({$product_count})";
            $this->load->view("partials/customer/product-list", array(
                "products" => $products,
                "category_label" => $category_label
            ));
        }
    }

    /**
     * 
     */
    public function searchSimilarProducts() {
        $product = $this->Product->getProductById($this->input->get("id"));

        if ($product) {
            $this->load->view("partials/customer/similar-products", array(
                "similar_products" => $this->Product->getSimilarProducts($product["id"], $product["category_id"], $this->input->get("keyword"))
            ));
        }
    }

    /**
     * Renders the list of products for customer
     * @return void
     */
    public function customerProductListHtml() {
        if ($this->session->userdata("user")) {
            $products = $this->Product->getAllProducts();
            $product_count = count($products);
            $category_label = "All Products ({$product_count})";
            $this->load->view("partials/customer/product-list", array(
                "products" => $products,
                "category_label" => $category_label
            ));
        }
    }

    /**
     * Renders and displays the products pagination for customer
     * @param int Current page of pagination
     * @return void
     */
    public function customerPaginationHtml($current_page) {
        $products = array();

        if ($this->input->get("keyword") && $this->input->get("category")) {
            $products = $this->Product->searchProducts($this->input->get("keyword"), $this->input->get("category"))["count"];
        } else if ($this->input->get("keyword")) {
            $products = $this->Product->searchProducts($this->input->get("keyword"))["count"];
        } else if ($this->input->get("category")) {
            $products = $this->Product->searchProducts("", $this->input->get("category"))["count"];
        } else {
            $products = $this->Product->searchProducts()["count"];
        }

        $this->load->view("partials/customer/pagination", array(
            "total_pages" => ceil($products["count"] / 5),
            "current_page" => $current_page
        ));
    }

    /**
     * Handles the process for filtering products based on category on customer side
     * @return void
     */
    // REMOVE THIS LATER
    public function filter() {
        $user = $this->session->userdata("user");
        
        if ($user) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $category = $this->Category->getCategoryById($this->input->get("category"));

            if ($category == null) {
                return redirect("products");
            }

            $product_count = count($this->Product->getAllProductsByCategory($this->input->get("category")));
            $category_label = "{$category["name"]} ({$product_count})";
            $this->load->view("partials/customer/header");
            $this->load->view("partials/customer/nav", array("user" => $user));
            $this->load->view("products/index", array(
                "categories" => $this->Category->getAllCategories(),
                "products" => $this->Product->getAllProductsByCategory($this->input->get("category")),
                "csrf" => $csrf,
                "product_count" => count($this->Product->getAllProducts()),
                "category_label" => $category_label,
                "success" => $this->session->flashdata("success"),
                "error" => $this->session->flashdata("error")
            ));
            $this->load->view("partials/customer/footer");
        } else {
            return redirect("login");
        }
    }

    /**
     * Renders and displays a specific product
     * @param int Id of a product
     * @return void
     */
    public function viewProduct($id) {
        $user = $this->session->userdata("user");
        
        if ($user) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $product = $this->Product->getProductById($id);
            $similar_products = $product ? $this->Product->getSimilarProducts($product["id"], $product["category_id"]) : array();
            $images = json_decode($product["img_links"]);
            $this->load->view("partials/customer/header");
            $this->load->view("partials/customer/nav", array(
                "user" => $user,
                "cart_count" => $this->Cart->countItemInCart()
            ));
            $this->load->view("products/view", array(
                "csrf" => $csrf,
                "product" => $product,
                "images" => $images,
                "similar_products" => $similar_products
            ));
            $this->load->view("partials/customer/footer", array(
                "toast" => $this->toast()
            ));
        } else {
            return redirect("login");
        }
    }

/* ------------------------------------------ End of Customer Methods ------------------------------------------ */

/* ------------------------------------------ Start of Admin Methods ------------------------------------------ */

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
     * Renders and displays the form for editing product
     * @param int Id of a product
     * @return void
     */
    public function editProductHtml($id) {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $product = $this->Product->getProductById($id);
        $images_name = json_decode($product["img_links"]);
        $this->load->view("partials/forms/edit-product", array(
            "csrf" => $csrf,
            "product" => $product,
            "images_name" => $images_name,
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
                "csrf" => $csrf
            ));
            $this->load->view("products/my-products", array("csrf" => $csrf));
            $this->load->view("partials/admin/footer", array("toast" => $this->toast()));
        } else {
            return redirect("products");
        }
    }

    /**
     * Renders the list of products
     * @return void
     */
    public function adminProductListHtml() {
        $user = $this->session->userdata("user");

        if ($user && $user["is_admin"] == 1) {
            $products = $this->Product->getAllProducts();
            $product_count = count($products);
            $category_label = "All Products ({$product_count})";
            $this->load->view("partials/admin/product-list", array(
                "products" => $products,
                "category_label" => $category_label
            ));
        }
    }

    /**
     * Renders and displays the pagination of products for admin
     * @param int Current page of pagination
     * @return void
     */
    public function paginationHtml($current_page) {
        $products = array();

        if ($this->input->get("keyword") && $this->input->get("category")) {
            $products = $this->Product->searchProducts($this->input->get("keyword"), $this->input->get("category"))["count"];
        } else if ($this->input->get("keyword")) {
            $products = $this->Product->searchProducts($this->input->get("keyword"))["count"];
        } else if ($this->input->get("category")) {
            $products = $this->Product->searchProducts("", $this->input->get("category"))["count"];
        } else {
            $products = $this->Product->searchProducts()["count"];
        }

        $this->load->view("partials/admin/pagination", array(
            "total_pages" => ceil($products["count"] / 5),
            "current_page" => $current_page
        ));
    }

    /**
     * Renders the list of product categories
     * @return void
     */
    public function adminCategoryListHtml() {
        $user = $this->session->userdata("user");

        if ($user && $user["is_admin"] == 1) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $products = $this->Product->searchProducts()["count"];
            $product_count = $products["count"];
            $category_label = "All Products ({$product_count})";
            $this->load->view("partials/admin/product-categories", array(
                "categories" => $this->Category->getAllCategories(),
                "product_count" => $product_count,
                "csrf" => $csrf
            ));
        }
    }

    /**
     * Handles the process for filtering products based on category
     * @return void
     */
    //REMOVE THIS LATER
    public function adminFilter() {
        $user = $this->session->userdata("user");

        if ($this->input->get("category") === "All") {
            $this->adminProductListHtml();
        } else if ($user && $user["is_admin"] == 1) {
            $category = $this->Category->getCategoryById($this->input->get("category"));
            $products = $this->Product->getAllProductsByCategory($this->input->get("category"));
            $product_count = count($products);
            $category_label = "{$category["name"]} ({$product_count})";
            $this->load->view("partials/admin/product-list", array(
                "products" => $products,
                "category_label" => $category_label
            ));
        }
    }

    /**
     * Handles the process for searching a product for admin
     * @param int Id of a category
     * @param int Offset of pagination
     * @return void
     */
    public function adminSearch($category_id, $offset) {
        $user = $this->session->userdata("user");

        if ($user && $user["is_admin"] == 1) {
            $category = $category_id === "All" ? array("name" => "All Products") : $this->Category->getCategoryById($category_id);
            $products = $this->Product->searchProducts($this->input->get("keyword"), $category_id, (($offset - 1) * 5))["products"];
            $product_count = count($products);
            $category_label = "{$category["name"]} ({$product_count})";
            $this->load->view("partials/admin/product-list", array(
                "products" => $products,
                "category_label" => $category_label
            ));
        }
    }

    /**
     * Handles the creation process of a product
     * @return void Redirects to admin's dashboard if success
     */
    public function create() {
        $product = $this->Product->validateProduct($this->input->post(), $_FILES["images"]);
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $response = array();

        if ($product && $this->Product->createProduct($product)) {
            $this->session->set_flashdata("success", "Product added succesfully!");
            $response["status"] = "success";
            $response["html"] = $this->toast();
        } else {
            $html = $this->load->view("partials/forms/add-product", array(
                "csrf" => $csrf,
                "categories" => $this->Category->getAllCategories(),
                "errors" =>  $this->session->flashdata("errors"),
                "images" =>  $this->session->flashdata("images")
            ), TRUE);
            $response["status"] = "error";
            $response["html"] = $html;
        }

        echo json_encode($response);
    }

    /**
     * Handles the updating process of a product
     * @return void Redirects to admin's dashboard if success
     */
    public function update() {
        $product = $this->Product->validateProductToUpdate($this->input->post(), $_FILES["images"]);
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $response = array();

        if ($product && $this->Product->updateProduct($product)) {
            $this->session->set_flashdata("success", "Product succesfully updated!");
            $response["status"] = "success";
            $response["html"] = $this->toast();
        } else {
            $product = $this->Product->getProductById($this->input->post("id"));
            $images_name = json_decode($product["img_links"]);
            $html = $this->load->view("partials/forms/edit-product", array(
                "csrf" => $csrf,
                "product" => $product,
                "images_name" => $images_name,
                "categories" => $this->Category->getAllCategories(),
                "errors" =>  $this->session->flashdata("errors"),
                "images" =>  $this->session->flashdata("images")
            ), TRUE);
            $response["status"] = "error";
            $response["html"] = $html;
        }
        
        echo json_encode($response);
    }

    /**
     * Handles the deletion process of a product
     * @param int Id of a product
     * @return void Redirects to admin's dashboard if success
     */
    public function delete($id) {
        if ($this->Product->deleteProduct($id)) {
            $this->session->set_flashdata("success", "Product deleted succesfully!");
        } else {
            $this->session->set_flashdata("error", "Something went wrong, please try again");
        }

        echo json_encode($this->toast());
    }

/* ------------------------------------------ End of Admin Methods ------------------------------------------ */

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