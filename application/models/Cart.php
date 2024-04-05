<?php
class Cart extends CI_Model {
    /**
     * Loads the necessary models
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model("Product");
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
        $query = "UPDATE carts SET quantity = ?, updated_at = NOW() WHERE id = ?;";
        return $this->db->query($query, array($data["quantity"], $data["item_id"]));
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
     * Gets all the user's item in cart
     * @return array Array of items of the user
     */
    public function getAllItemInCart() {
        return $this->db->query(
            "SELECT carts.*, FORMAT(carts.quantity * products.price, 2) AS amount, products.name AS name, products.price AS price, JSON_UNQUOTE(products.img_links->'$.default') AS img
            FROM carts 
            LEFT JOIN products ON carts.product_id = products.id
            WHERE carts.user_id = 4 
            ORDER BY created_at DESC;", 
            array($this->session->userdata("user")["id"])
        )->result_array();
    }
}