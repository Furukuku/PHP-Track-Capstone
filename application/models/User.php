<?php
class User extends CI_Model {
    /**
     * Loads the necessary libraries
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->library("form_validation");
    }

    /**
     * Creates a new user
     * @param array Array of user details to be created
     * @return array Array of
     */
    public function createUser($data) {
        $query = 
            "INSERT INTO users (first_name, last_name, is_admin, email, password, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
        $is_admin = $this->countUsers() == 0 ? 1 : 0;
        $hashed_password = password_hash($data["password"], PASSWORD_BCRYPT);
        $values = array($data["first_name"], $data["last_name"], $is_admin, $data["email"], $hashed_password);

        if ($this->db->query($query, $values)) {
            $user_id = $this->db->insert_id();
            $user = $this->getUserById($user_id);

            if ($user) {
                $this->session->set_userdata("user", $user);
                return true;
            }
        }

        return false;
    }

    /**
     * Validates the inputted data of the user if it is correct
     * @param array Array of the inputted data of the user
     * @return bool True if the the inputted data are correct
     */
    public function validateUserToLogin($data) {
        $this->form_validation->set_rules("email", "Email", "required");
        $this->form_validation->set_rules("password", "Password", "required");
        $filtered_data = $this->xssFilter($data);
        $user = $this->getUserByEmail($filtered_data["email"]);

        if (!$this->form_validation->run()) {
            $this->form_validation->set_error_delimiters('<p class="text-danger error">', '</p>');
            $this->session->set_flashdata("errors", array(
                "email" => form_error("email"),
                "password" => form_error("password")
            ));
            return false;
        }

        if ($user && password_verify($filtered_data["password"], $user["password"])) {
            $this->session->set_userdata("user", $user);
            return true;
        } else {
            $this->session->set_flashdata("invalid", '<p class="text-danger error">The email or password is incorrect</p>');
            return false;
        }
    }

    /**
     * Gets the data of a specific user of the matched email
     * @param int Id of the user
     * @return array Array of user's data
     */
    private function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = ?";
        return $this->db->query($query, array($id))->row_array();
    }

    /**
     * Gets the data of a specific user
     * @param string Email of user
     * @return array Array of user's data
     */
    private function getUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = ?";
        return $this->db->query($query, array($email))->row_array();
    }

    /**
     * Counts the user in the database
     * @return int Count of the user
     */
    public function countUsers() {
        $users = $this->db->query("SELECT COUNT(*) AS count FROM users;")->row_array();
        return (int)$users["count"];
    }

    /**
     * Validates the data of user to create
     * @param array Array of user details to validate
     * @return array Array of validated data of the user
     */
    public function validateUser($data) {
        $this->form_validation->set_rules("first_name", "First Name", "trim|required|min_length[2]|max_length[45]");
        $this->form_validation->set_rules("last_name", "Last Name", "trim|required|min_length[2]|max_length[45]");
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[users.email]|max_length[100]");
        $this->form_validation->set_rules("password", "Password", "required|min_length[8]|max_length[50]");
        $this->form_validation->set_rules("confirm_password", "Password Confirmation", "matches[password]");

        if (!$this->form_validation->run()) {
            $this->form_validation->set_error_delimiters('<p class="text-danger error">', '</p>');
            $this->session->set_flashdata("errors", array(
                "fname" => form_error("first_name"),
                "lname" => form_error("last_name"),
                "email" => form_error("email"),
                "password" => form_error("password"),
                "confirm_password" => form_error("confirm_password")
            ));
            return false;
        }

        return $this->xssFilter($data);
    }

    /**
     * XSS Filters the data of the user
     * @param array Array of user's data
     * @return array Array of cleaned user's data
     */
    private function xssFilter($data) {
        $filtered_data = array();

        foreach ($data as $key => $item) {
            $filtered_data[$key] = $this->security->xss_clean($item);
        }

        return $filtered_data;
    }

}