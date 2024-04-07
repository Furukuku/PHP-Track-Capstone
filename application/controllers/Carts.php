<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carts extends CI_Controller {
    private $shipping_fee = 5;

    /**
     * Loads the necessary models
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model("Cart");
        $this->load->model("Order");
    }

    /**
     * Renders and displays the products dashboard
     * @return void
     */
    public function index() {
        $user = $this->session->userdata("user");
        $this->session->unset_userdata("order_info");
        
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
            $this->load->view("carts/index", array(
                "csrf" => $csrf,
                "shipping_fee" => $this->shipping_fee,
                "total_amount" => $this->Cart->countTotalAmountToPay()
            ));
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
            "items" => $this->Cart->searchItemInCart()
        ));
    }

    /**
     * Renders the forms for order informations
     * @return void
     */
    // REMOVE THIS LATER
    public function orderFormHtml() {
        $this->load->view("partials/forms/order-information", array(
            "values" => $this->input->post(),
            "shipping_fee" => $this->shipping_fee,
            "total_amount" => $this->Cart->countTotalAmountToPay(),
            "errors" => $this->session->flashdata("errors")
        ));
    }

    /**
     * Handles the searching in cart
     * @return void
     */
    public function search() {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view("partials/customer/cart-list", array(
            "csrf" => $csrf,
            "items" => $this->Cart->searchItemInCart($this->input->get("keyword"))
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
                $this->session->set_flashdata("cart_add_success", "Item added to cart successfully!");
            } else {
                $this->session->set_flashdata("cart_add_error", "Something went wrong, please try again");
            }
        }

        $response = array(
            "cart" => $this->Cart->countItemInCart(),
            "toast" => $this->toast("cart_add_success", "cart_add_error")
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
            $this->Cart->updateItemInCart($this->input->post());
            $response = array(
                "shipping_fee" => $this->shipping_fee,
                "total_amount" => $this->Cart->countTotalAmountToPay(),
                "to_pay" => $this->shipping_fee + $this->Cart->countTotalAmountToPay()
            );
            echo json_encode($response);
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
                $this->session->set_flashdata("cart_remove_success", "Item removed successfully!");
            } else {
                $this->session->set_flashdata("cart_remove_error", "Something went wrong, please try again");
            }
        }

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $html = $this->load->view("partials/customer/cart-list", array(
            "csrf" => $csrf,
            "items" => $this->Cart->searchItemInCart()
        ), TRUE);
        $checkout = array(
            "shipping_fee" => $this->shipping_fee,
            "total_amount" => $this->Cart->countTotalAmountToPay(),
            "to_pay" => $this->shipping_fee + $this->Cart->countTotalAmountToPay()
        );
        $response = array(
            "html" => $html,
            "checkout" => $checkout,
            "cart" => $this->Cart->countItemInCart(),
            "toast" => $this->toast("cart_remove_success", "cart_remove_error")
        );
        echo json_encode($response);
    }

    /**
     * Handles the process on checking out items
     * @return void
     */
    public function checkout() {
        $order_info = $this->Order->validateOrderInformation($this->input->post());

        if (!$order_info) {
            $html = $this->load->view("partials/forms/order-information", array(
                "values" => $this->input->post(),
                "shipping_fee" => $this->shipping_fee,
                "total_amount" => $this->Cart->countTotalAmountToPay(),
                "errors" => $this->session->flashdata("errors")
            ), TRUE);
            $response = array(
                "status" => "error",
                "html" => $html
            );
            echo json_encode($response);
        } else {
            $orders = $this->Cart->searchItemInCart();
            $checkouts = array();

            foreach ($orders as $order) {
                $checkouts[] = array(
                    "quantity" => $order["quantity"], 
                    "price_data" => array(
                        "currency" => "usd",
                        "unit_amount" => $order["price"] * 100,
                        "product_data" => array("name" => $order["name"])
                    )
                );
            }

            if ($checkouts) {
                $this->session->set_userdata("order_info", $order_info);
                include_once("./vendor/autoload.php");
                $stripe = new \Stripe\StripeClient($this->config->item("stripe_api_key")); // configure your api key in config.php file
                $checkout_session = $stripe->checkout->sessions->create([
                    'line_items' => $checkouts,
                    'mode' => 'payment',
                    'shipping_options' => [
                        [
                            'shipping_rate_data' => [
                                'display_name' => 'Standard Fee',
                                'type' => 'fixed_amount',
                                'fixed_amount' => [
                                    'amount' => $this->shipping_fee * 100,
                                    'currency' => 'usd'
                                ]
                            ]
                        ]
                    ],
                    'success_url' => 'http://capstone.ci/order/success-payment',
                    'cancel_url' => 'http://capstone.ci/cart'
                ]);

                $response = array(
                    "status" => "success",
                    "url" => $checkout_session->url
                );
                echo json_encode($response);
            } else {
                $this->session->set_flashdata("no_items_to_pay", "You have no items to pay!");
                $response = array(
                    "status" => "invalid",
                    "toast" => $this->toast("items_paid", "no_items_to_pay")
                );
                echo json_encode($response);
            }
        }
        
    }

    /**
     * Renders the toasters
     * @param string Name of success flashdata
     * @param string Name of error flashdata
     * @return html HTML toasters
     */
    private function toast($success, $error) {
        return $this->load->view("partials/toast", array(
            "success" => $this->session->flashdata($success),
            "error" => $this->session->flashdata($error)
        ), TRUE);
    }
}