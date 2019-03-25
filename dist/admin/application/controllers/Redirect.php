<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
	}

	public function index()
	{
		header("Location: ".site_url('management/ecosystem')); /* Redirect browser */
		die();
	}
}
