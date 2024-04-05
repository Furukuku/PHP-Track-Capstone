<?php
class Product extends CI_Model {
    /**
     * Loads the necessary models, helpers, and libraries
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->helper('file');
    }

    /**
     * Gets all the products
     * @return array Array of products
     */
    public function getAllProducts() {
        return $this->db->query(
            "SELECT products.*, FORMAT(products.price, 2) AS formatted_price, JSON_UNQUOTE(products.img_links->'$.default') AS display_img, categories.name AS category_name, COALESCE(SUM(orders.quantity), 0) AS sold
            FROM products
            LEFT JOIN categories ON products.category_id = categories.id
            LEFT JOIN orders ON products.id = orders.product_id
            GROUP BY products.id 
            ORDER BY products.created_at DESC 
            LIMIT 0, 5;"
            )->result_array();
    }

    /**
     * Gets all product based on category
     * @param int Id of category
     * @return array Array of products
     */
    public function getAllProductsByCategory($id) {
        return $this->db->query(
            "SELECT products.*, FORMAT(products.price, 2) AS formatted_price, JSON_UNQUOTE(products.img_links->'$.default') AS display_img, categories.name AS category_name, COALESCE(SUM(orders.quantity), 0) AS sold
            FROM products
            LEFT JOIN categories ON products.category_id = categories.id
            LEFT JOIN orders ON products.id = orders.product_id
            WHERE products.category_id = ? 
            GROUP BY products.id
            ORDER BY products.created_at DESC;",
            array($id)
        )->result_array();
    }

    /**
     * Gets a product based on id
     * @param int Id of the product
     * @return array Array of the products and it count
     */
    public function getProductById($id) {
        return $this->db->query("SELECT * FROM products WHERE id = ? LIMIT 1;", array($id))->row_array();
    }

    /**
     * Searches products based on the keyword
     * @param string Keyword to search
     * @param int Id of the current category
     * @return array Array of searched products 
     */
    public function searchProducts($keyword = "", $id = "All", $offset = 0) {
        $products = array();

        if ($id === "All") {
            $products = $this->db->query(
                "SELECT products.*, FORMAT(products.price, 2) AS formatted_price, JSON_UNQUOTE(products.img_links->'$.default') AS display_img, categories.name AS category_name, COALESCE(SUM(orders.quantity), 0) AS sold
                FROM products
                LEFT JOIN categories ON products.category_id = categories.id
                LEFT JOIN orders ON products.id = orders.product_id
                WHERE products.name LIKE ? OR products.description LIKE ? OR categories.name LIKE ? 
                GROUP BY products.id
                ORDER BY products.created_at DESC 
                LIMIT ?, 5;",
                array("%{$keyword}%", "%{$keyword}%", "%{$keyword}%", $offset)
            )->result_array();
        } else {
            $products = $this->db->query(
                "SELECT products.*, FORMAT(products.price, 2) AS formatted_price, JSON_UNQUOTE(products.img_links->'$.default') AS display_img, categories.name AS category_name, COALESCE(SUM(orders.quantity), 0) AS sold
                FROM products
                LEFT JOIN categories ON products.category_id = categories.id
                LEFT JOIN orders ON products.id = orders.product_id
                WHERE products.category_id = ?  
                GROUP BY products.id 
                HAVING products.name LIKE ? OR products.description LIKE ? OR categories.name LIKE ? 
                ORDER BY products.created_at DESC 
                LIMIT ?, 5;",
                array($id, "%{$keyword}%", "%{$keyword}%", "%{$keyword}%", $offset)
            )->result_array();
        }

        return array(
            "products" => $products,
            "count" => $this->countProducts($id, $keyword)
        );
    }

    /**
     * Counts all the product
     * @param int Id of a category
     * @return int Number of product count
     */
    public function countProducts($category_id = "All", $keyword) {
        if ($category_id === "All") {
            return $this->db->query(
                "SELECT COUNT(products.id) AS count
                FROM products
                LEFT JOIN categories ON products.category_id = categories.id
                LEFT JOIN orders ON products.id = orders.product_id
                WHERE products.name LIKE ? OR products.description LIKE ? OR categories.name LIKE ?;", 
                array("%{$keyword}%", "%{$keyword}%", "%{$keyword}%")
            )->row_array();
        } else {
            return $this->db->query(
                "SELECT COUNT(products.id) AS count
                FROM products
                LEFT JOIN categories ON products.category_id = categories.id
                LEFT JOIN orders ON products.id = orders.product_id
                WHERE products.category_id = ? AND (products.name LIKE ? OR products.description LIKE ? OR categories.name LIKE ?);", 
                array($category_id, "%{$keyword}%", "%{$keyword}%", "%{$keyword}%")
            )->row_array();
        }
    }

    /**
     * Creates a new product
     * @param array Array of the product details to create
     * @return bool True if the creation was success
     */
    public function createProduct($data) {
        $user = $this->session->userdata("user");
        $images = json_encode($data["images"]);
        $query = 
            "INSERT INTO products (user_id, category_id, img_links, name, description, price, inventory, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW());";
        
        $values = array($user["id"], $data["details"]["category"], $images, $data["details"]["name"], $data["details"]["description"], $data["details"]["price"], $data["details"]["inventory"]);
        return $this->db->query($query, $values);
    }

    /**
     * Updates a product
     * @param array Array of inputted product details
     * @return bool True if the creation was success
     */
    public function updateProduct($data) {
        $user = $this->session->userdata("user");
        $product = $this->getProductById($data["details"]["id"]);
        $values = array();
        $query = "UPDATE products SET name = ?, description = ?, category_id = ?, price = ?, inventory = ?, updated_at = NOW(), img_links = ?";
        
        foreach ($data["details"] as $key => $detail) {
            if ($key !== "default_img" && $key !== "id" && $key !== "csrf_test_name") {
                $values[] = $detail;
            }
        }

        if (isset($data["images"])) {
            $values[] = json_encode($data["images"]);
            $images = json_decode($product["img_links"]);

            foreach ($images->subs as $image) {
                unlink("./uploads/products/{$image}");
            }
        } else {
            $images = json_decode($product["img_links"]);
            $images->default = $data["details"]["default_img"];
            $values[] = json_encode($images);
        }

        $query .= " WHERE id = ?;";
        $values[] = $data["details"]["id"];
        return $this->db->query($query, $values);
    }

    /**
     * Deletes a product based on the id
     * @param int Id of a product
     * @return bool True if successfully deleted
     */
    public function deleteProduct($id) {
        $product = $this->getProductById($id);

        if ($product) {
            $images = json_decode($product["img_links"]);

            foreach ($images->subs as $image) {
                unlink("./uploads/products/{$image}");
            }
        }

        return $this->db->query("DELETE FROM products WHERE id = ?", array($id));
    }

    /**
     * Validates the inputted product details and the images
     * @param array Array of the product details to validate
     * @param array Array of the product images to validate
     * @return array Array of validated product details and images
     */
    public function validateProduct($data, $images) {
        $product_details = $this->validateProductDetails();

        if (!$product_details) {
            return false;
        }
        
        $product_imgs = $this->validateProductImages($images, $data["default_img"]);

        if (!$product_imgs) {
            return false;
        }

        return array(
            "details" => $this->xssFilter($data), 
            "images" => $product_imgs
        );
    }

    /**
     * Validates the inputted product details and the images
     * @param array Array of the product details to validate
     * @param array Array of the product images to validate
     * @return array Array of validated product details and images
     */
    public function validateProductToUpdate($data, $images) {
        if (!$this->validateProductDetails()) {
            return false;
        }
        
        if (!empty($images["name"][0])) {
            $product_imgs = $this->validateProductImages($images, $data["default_img"]);

            if (!$product_imgs) {
                return false;
            }

            return array(
                "details" => $this->xssFilter($data), 
                "images" => $product_imgs
            );
        }

        return array("details" => $this->xssFilter($data));
    }

    /**
     * Validates the product details
     * @return bool True if the product details met the requirements
     */
    private function validateProductDetails() {
        $this->form_validation->set_rules("name", "Name", "trim|required|max_length[45]");
        $this->form_validation->set_rules("description", "Description", "trim|required|max_length[1000]");
        $this->form_validation->set_rules(
            "category", 
            "Category", 
            array(
                "trim",
                "required",
                array(
                    "isValidCategory",
                    function($category) {
                        return $this->Category->isCategoryExists($category);
                    }
                )
            ),
            array("isValidCategory" => "The %s does not exists.")
        );
        $this->form_validation->set_rules("price", "Price", "required|numeric|greater_than[0]");
        $this->form_validation->set_rules("inventory", "Inventory", "required|is_natural_no_zero");
        $this->form_validation->set_rules("default_img", "Default Image", "required");

        if (!$this->form_validation->run()) {
            $this->form_validation->set_error_delimiters('<p class="text-danger error">', '</p>');
            $this->session->set_flashdata("errors", array(
                "name" => form_error("name"),
                "description" => form_error("description"),
                "category" => form_error("category"),
                "price" => form_error("price"),
                "inventory" => form_error("inventory"),
                "default_img" => form_error("default_img")
            ));
            return false;
        }

        return true;
    }

    /**
     * XSS cleans all the inputted data
     * @param array Array of the inputted data
     * @return array Array of cleaned data
     */
    private function xssFilter($data) {
        $cleaned_data = array();
        
        foreach ($data as $key => $item) {
            $cleaned_data[$key] = $item;
        }

        return $cleaned_data;
    }

    /**
     * Validates the product images
     * @param array Array of the inputted images
     * @param string Name of the default image
     * @return array Array of names of the uploaded images
     */
    private function validateProductImages($images, $default_img) {
        $image_count = count($images["name"]);
        $images_names = array();

        if (!empty($images) && $image_count < 6) {
            for ($i = 0; $i < $image_count; $i++) {
                $_FILES["image"]["name"] = $images["name"][$i];  
                $_FILES["image"]["type"] = $images["type"][$i];  
                $_FILES["image"]["tmp_name"] = $images["tmp_name"][$i];  
                $_FILES["image"]["error"] = $images["error"][$i];  
                $_FILES["image"]["size"] = $images["size"][$i];  
                $image_data = $this->uploadProductImage("image");
                
                if ($image_data === false) {
                    $this->session->set_flashdata("images", $this->upload->display_errors('<p class="text-danger error">', '</p>'));
                    return false;
                }

                if ($default_img === $images["name"][$i]) {
                    $images_names["default"] = $image_data;
                }
                
                $images_names["subs"][] = $image_data;
            }

            return $images_names;
        } else if ($image_count == 0) {
            $this->session->set_flashdata("images", '<p class="text-danger error">Product image is required.</p>');
        } else {
            $this->session->set_flashdata("images", '<p class="text-danger error">Product images must not exceed 5 photos.</p>');
        }

        return false;
    }

    /**
     * Uploads the product image
     * @param string Key name of the image to be uploaded
     * @return string Encrypted name of the uploaded image
     */
    private function uploadProductImage($image) {
        $path = "./uploads/products/";

        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);
        }

        $config["upload_path"] = $path;
        $config["allowed_types"] = "gif|jpg|jpeg|png";
        $config["max_size"] = 2048;
        $config["encrypt_name"] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload($image)) {
            $uploaded_img = $this->upload->data();
            return $uploaded_img["file_name"];
        }

        return false;
    }
}