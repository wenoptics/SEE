<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		/* Standard Libraries of codeigniter are required */
		$this->load->database();
		$this->load->helper('url');
		/* ------------------ */

		$this->load->library('grocery_CRUD');

	}

	public function index()
	{
		echo "<h1>Welcome to the world of Codeigniter</h1>";//Just an example to ensure that we get into the function
		die();
	}


	public function ecosystem()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('ecosystem');
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}

	public function node()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('node');
		$crud->set_subject('Image Node');

		// relation to the actual image file
		//$crud->set_relation('fk_image_id','image','name');
		//$crud->set_relation('fk_image_id','image','original_name');

		$crud->callback_column('fk_image_id', array($this, '_callback_fk_image_id'));
		$crud->display_as('fk_image_id', 'Image');
		$crud->display_as('fk_ecosystem_id', 'Ecosystem ID');

		$output = $crud->render();
		$this->_example_output($output);
	}

	function _callback_fk_image_id($value, $row)
	{
		 return "<img width='80' src='/data/ImageSecure/image.php?id=" . $value . "' title='".$value."'/>";
		// return "<div class='tooltip'>
		// 			<img width='80' src='/data/ImageSecure/image.php?id=" . $value . "'/>
		// 			<span class='tooltiptext'>".$value."</span>
		// 		</div>";
	}

	function _example_output($output = null)
	{
		$this->load->view('grocerycrud_view_template.php',$output);
	}

}
