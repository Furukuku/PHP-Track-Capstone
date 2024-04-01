<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Displays the navigations for the features of the system and their percentages
	 * @return void Renders the index view
	 */
	public function index()
	{
		$this->load->view('index');
	}
}
