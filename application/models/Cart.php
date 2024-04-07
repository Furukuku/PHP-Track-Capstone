<?php
class Cart extends CI_Model {
    /**
     * Loads the necessary models and libraries
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model("Product");
        $this->load->library("form_validation");
    }

    /**
     * Adds an item to cart
     * @param array Array of product details to add
     * @return bool True if added successfully
     */
    public function addToCart($data) {
        $item = $this->getItemByIdAndUserId($data["product_id"]);
        $product = $this->Product->getProductById($data["product_id"]);

        if ($item) {
            $total_quantity = $item["quantity"] + $data["quantity"];
            $total_quantity = $total_quantity > $product["inventory"] ? $product["inventory"] : $total_quantity;
            $query = "UPDATE carts SET quantity = ?, updated_at = NOW() WHERE user_id = ? AND product_id = ?;";
            return $this->db->query($query, array($total_quantity, $this->session->userdata("user")["id"], $data["product_id"]));
        } else {
            $query = "INSERT INTO carts (user_id, product_id, quantity, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW());";
            return $this->db->query($query, array($this->session->userdata("user")["id"], $data["product_id"], $data["quantity"]));
        }
    }

    /**
     * Updates an item in cart
     * @param array Array of product details to update
     * @return bool True if updated successfully
     */
    public function updateItemInCart($data) {
        $product = $this->Product->getProductById($data["product_id"]);
        $total_quantity = $data["quantity"] > $product["inventory"] ? $product["inventory"] : $data["quantity"];
        $query = "UPDATE carts SET quantity = ?, updated_at = NOW() WHERE id = ?;";
        return $this->db->query($query, array($total_quantity, $data["item_id"]));
    }

    /**
     * Removes an item in cart
     * @param int Id of an item to remove
     * @return bool True if deleted successfully
     */
    public function deleteItemInCart($id) {
        return $this->db->query("DELETE FROM carts WHERE id = ?;", $id);
    }

    /**
     * Counts the item of a user in cart
     * @return int Count of item
     */
    public function countItemInCart() {
        $item = $this->db->query("SELECT COUNT(*) AS count FROM carts WHERE user_id = ?;", array($this->session->userdata("user")["id"]))->row_array();
        return $item["count"];
    }

    /**
     * Gets the item on the cart based on product id and user id
     * @param int Id of product
     * @return array Array of the product in cart
     */
    public function getItemByIdAndUserId($product_id) {
        return $this->db->query("SELECT * FROM carts WHERE user_id = ? AND product_id = ?;", array($this->session->userdata("user")["id"], $product_id))->row_array();
    }

    /**
     * Gets an item in cart based on id
     * @param int Id of an item in cart
     * @param array Array of details of the item
     */
    public function getItemById($id) {
        return $this->db->query(
            "SELECT carts.*, FORMAT(carts.quantity * products.price, 2) AS amount 
            FROM carts
            LEFT JOIN products ON carts.product_id = products.id
            WHERE carts.id = ?;", 
            array($id)
        )->row_array();
    }

    /**
     * Gets all the user's item in cart
     * @return array Array of items of the user
     */
    // REMOVE THIS LATER
    public function getAllItemInCart() {
        return $this->db->query(
            "SELECT carts.*, FORMAT(carts.quantity * products.price, 2) AS amount, products.name AS name, products.price AS price, JSON_UNQUOTE(products.img_links->'$.default') AS img
            FROM carts 
            LEFT JOIN products ON carts.product_id = products.id
            WHERE carts.user_id = ? 
            ORDER BY created_at DESC;", 
            array($this->session->userdata("user")["id"])
        )->result_array();
    }

    /**
     * Searches user's item in cart
     * @param string keyword to search
     * @return array Array of items of the user
     */
    public function searchItemInCart($keyword = "") {
        return $this->db->query(
            "SELECT carts.*, FORMAT(carts.quantity * products.price, 2) AS amount, products.name AS name, products.price AS price, products.inventory AS stocks, JSON_UNQUOTE(products.img_links->'$.default') AS img
            FROM carts 
            LEFT JOIN products ON carts.product_id = products.id
            WHERE carts.user_id = ? AND products.name LIKE ?
            ORDER BY carts.created_at DESC;", 
            array($this->session->userdata("user")["id"], "%{$keyword}%")
        )->result_array();
    }

    /**
     * Counts the total amount of the items in cart
     * @return int Total amount to pay
     */
    public function countTotalAmountToPay() {
        $amount = $this->db->query(
            "SELECT SUM(FORMAT(carts.quantity * products.price, 2)) AS total_amount
            FROM carts 
            LEFT JOIN products ON carts.product_id = products.id
            WHERE carts.user_id = ?
            GROUP BY carts.user_id;", 
            array($this->session->userdata("user")["id"])
        )->row_array();
        return $amount ? $amount["total_amount"] : 0;
    }

    /**
     * Removes all ordered items in cart
     * @return bool True if successfully removed
     */
    // REMOVE THIS LATER
    public function removeItemsInCart() {
        return $this->db->query("DELETE FROM carts WHERE user_id = ?;", array($this->session->userdata("user")["id"]));
    }

    /**
     * Validates the items to place order
     * @param array Array of the order details
     * @param int Shipping fee
     * @return string URL of checkout page of stripe api
     */
    public function validateCheckoutItems($order_info, $shipping_fee) {
        $orders = $this->searchItemInCart();
        $checkouts = array();
        $cart_ids = array();
        
        foreach ($orders as $order) {
            $product = $this->Product->getProductById($order["product_id"]);
            
            if ($product["inventory"] > 0 && ($product["inventory"] - $order["quantity"]) >= 0) {
                $cart_ids[] = $order["id"];
                $checkouts[] = array(
                    "quantity" => $order["quantity"], 
                    "price_data" => array(
                        "currency" => "usd",
                        "unit_amount" => $order["price"] * 100,
                        "product_data" => array("name" => $order["name"])
                    )
                );
            }
        }

        if ($checkouts) {
            $this->session->set_userdata("cart_ids", $cart_ids);
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
                                'amount' => $shipping_fee * 100,
                                'currency' => 'usd'
                            ]
                        ]
                    ]
                ],
                'success_url' => 'http://capstone.ci/order/success-payment',
                'cancel_url' => 'http://capstone.ci/cart'
            ]);

            return $checkout_session->url;
        }

        return false;
    }

    /**
     * Validates items to be added to cart
     * @param array Array of the product details
     * @return bool True if it meets the requirements
     */
    public function validateProductToAdd($data) {
        $product = $this->Product->getProductById($data["product_id"]);

        if ($product) {
            $this->form_validation->set_rules("quantity", "Quantity", "trim|required|greater_than[0]|less_than_equal_to[{$product["inventory"]}]");

            if (!$this->form_validation->run()) {
                $this->form_validation->set_error_delimiters('', '');
                $this->session->set_flashdata("cart_add_error", form_error("quantity"));
                return false;
            }

            return true;
        }

        $this->session->set_flashdata("cart_add_error", "Something went wrong, please try again");
        return false;
    }
}