<?php
class Category extends CI_Model {
    /**
     * Gets all the product categories
     * @return array Array of fetched categories
     */
    public function getAllCategories() {
        return $this->db->query(
            "SELECT categories.*, COUNT(products.id) AS product_count
            FROM categories
            LEFT JOIN products ON categories.id = products.category_id
            GROUP BY categories.id;"
        )->result_array();
    }

    /**
     * Gets the category based on id
     * @param int Id of a category
     * @return array Array of category details
     */
    public function getCategoryById($id) {
        return $this->db->query("SELECT * FROM categories WHERE id = ? LIMIT 1;", array($id))->row_array();
    }

    /**
     * Checks the category if exists
     * @param int Id of a category
     * @return bool True if it is exists
     */
    public function isCategoryExists($id) {
        $query = "SELECT * FROM categories WHERE id = ? LIMIT 1;";
        $category = $this->db->query($query, array($id))->row_array();
        return $category ? true : false;
    }
}