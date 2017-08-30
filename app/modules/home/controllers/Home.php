<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller
{

	public function __contruct()
	{
		
		
	}

	public function index()
	{
		
		$this->viewdata = $this->general->viewdata();

		$data = $this->db->get('branches')->result();

		$this->viewdata['branches'] = $data;
		$this->viewdata['page'] = 'home';
		$this->viewdata['title'] = 'Home';
		$this->load->view('home/content', $this->viewdata);

	}

	public function dashboard_data()
	{

	}
	
	
}