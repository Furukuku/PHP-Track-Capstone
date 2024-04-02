<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    /**
     * Loads the necessary models
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model("User");
    }

    /**
     * Renders and displays the login page
     * @return void
     */
    public function login() {
        if (!$this->session->userdata("user")) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->load->view("partials/customer/header");
            $this->load->view("users/login", array(
                "csrf" => $csrf,
                "errors" => $this->session->flashdata("errors"),
                "invalid" => $this->session->flashdata("invalid")
            ));
            $this->load->view("partials/customer/footer");
        } else if ($this->session->userdata("user")["is_admin"] == 1) {
            return redirect("my-products");
        } else {
            return redirect("products");
        }
    }

    /**
     * Handles the process of logging in a user
     * @return redirect Redirects to products page if the login validation was succeeded
     */
    public function loginUser() {
        $user = $this->User->validateUserToLogin($this->input->post());

        if ($user) {
            $this->session->set_flashdata("success", "Welcome back! {$this->session->userdata("user")["first_name"]}");

            if ($this->session->userdata("user")["is_admin"] == 1){
                return redirect("my-products");
            } else {
                return redirect("products");
            }
        }

        return redirect("login");
    }

    /**
     * Renders and displays the sign up page
     * @return void
     */
    public function signup() {
        if (!$this->session->userdata("user")) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->load->view("partials/customer/header");
            $this->load->view("users/sign-up", array(
                "csrf" => $csrf,
                "errors" => $this->session->flashdata("errors"),
                "values" => $this->session->flashdata("values")
            ));
            $this->load->view("partials/customer/footer");
        } else if ($this->session->userdata("user")["is_admin"] == 1) {
            return redirect("my-products");
        } else {
            return redirect("products");
        }
    }

    /**
     * Handles the process of creating new user
     * @return redirect Redirects to products page if the creation was succeeded
     */
    public function create() {
        $user = $this->User->validateUser($this->input->post());

        if ($user && $this->User->createUser($user)) {
            $this->session->set_flashdata("success", "Hello! {$user["first_name"]}");

            if ($this->session->userdata("user")["is_admin"] == 1){
                return redirect("my-products");
            } else {
                return redirect("products");
            }
        }

        $this->session->set_flashdata("values", $this->input->post());
        return redirect("sign-up");
    }

    /**
     * Logs out the user
     * @return redirect Redirects to login page
     */
    public function logout() {
        $this->session->sess_destroy();
        return redirect("login");
    }
}