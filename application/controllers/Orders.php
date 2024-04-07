<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
    /**
     * Loads the necessary models
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model("Order");
    }

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
            $this->load->view("products/orders", array(
                "orders" => $this->Order->getAllOrders()["orders"],
                "all_count" => $this->Order->countOrdersByStatus("All Products"),
                "pending_count" => $this->Order->countOrdersByStatus("Pending"),
                "process_count" => $this->Order->countOrdersByStatus("On-process"),
                "shipped_count" => $this->Order->countOrdersByStatus("Shipped"),
                "delivered_count" => $this->Order->countOrdersByStatus("Delivered")
            ));
            $this->load->view("partials/admin/footer", array("toast" => $this->toast("success", "error")));
        } else {
            return redirect("products");
        }
    }

    /**
     * Renders the order list
     * @return void
     */
    public function orderList($status) {
        $orders = $status ? $this->Order->getAllOrders($status)["orders"] : $this->Order->getAllOrders()["orders"];
        $count = count($orders);
        $category_label = $status ? "{$status} ({$count})" : "All Orders ({$count})"; 
        $this->load->view("partials/admin/order-list", array(
            "orders" => $orders,
            "category_label" => $category_label
        ));
    }

    /**
     * Renders the order category list
     * @return void
     */
    public function categoryList() {
        $this->load->view("partials/admin/order-categories", array(
            "all_count" => $this->Order->countOrdersByStatus("All Orders"),
            "pending_count" => $this->Order->countOrdersByStatus("Pending"),
            "process_count" => $this->Order->countOrdersByStatus("On-process"),
            "shipped_count" => $this->Order->countOrdersByStatus("Shipped"),
            "delivered_count" => $this->Order->countOrdersByStatus("Delivered")
        ));
    }

    /**
     * Handles the searching process of orders
     * @return void
     */
    public function searchOrders($status) {
        $category = urldecode($status);
        $orders = $this->Order->getAllOrders($category, $this->input->get("keyword"), (($this->input->get("offset") - 1) * 5))["orders"];
        $count = count($orders);
        $category_label = $category ? "{$category} ({$count})" : "All Orders ({$count})"; 
        $this->load->view("partials/admin/order-list", array(
            "orders" => $orders,
            "category_label" => $category_label
        ));
    }

    /**
     * Renders the pagination for orders
     * @return void
     */
    public function paginationHtml($current_page) {
        $orders = 0;
        
        if ($this->input->get()) {
            $orders = $this->Order->getAllOrders($this->input->get("status"), $this->input->get("keyword"))["count"];
            // var_dump($orders);
            // die();
        } else {
            $orders = $this->Order->getAllOrders()["count"];
        }

        $this->load->view("partials/admin/order-pagination", array(
            "total_pages" => ceil($orders / 5),
            "current_page" => $current_page
        ));
    }

    /**
     * Handles the success process of placing order
     * @return void
     */
    public function successPayment() {
        if ($this->Order->createOrder()) {
            $this->session->set_flashdata("payment_success", "Order successfully paid!");
        } else {
            $this->session->set_flashdata("payment_error", "Something went wrong, please try again");
        }

        return redirect("cart");
    }

    /**
     * Handles the filtering of category of order status
     * @return void
     */
    public function categoryFilter() {
        $this->orderList($this->input->get("status"));
    }

    /**
     * Handles the updation process of order status
     * @return void
     */
    public function updateStatus() {
        if ($this->Order->updateOrderStatus($this->input->post())) {
            $this->session->set_flashdata("update_status_success", "Status updated successfully");
        } else {
            $this->session->set_flashdata("update_status_error", "Something went wrong, please try again");
        }

        echo json_encode($this->toast("update_status_success", "update_status_error"));
    }

    /**
     * Renders the toasters
     * @return html HTML toasters
     */
    private function toast($success, $error) {
        return $this->load->view("partials/toast", array(
            "success" => $this->session->flashdata($success),
            "error" => $this->session->flashdata($error)
        ), TRUE);
    }
}