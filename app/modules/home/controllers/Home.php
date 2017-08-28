<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		// $this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();
		
		$this->viewdata['controller'] = 'home';

	
	}
	public function index()
	{
		
		$this->viewdata['title'] = 'Dashboard';
		$this->viewdata['content'] = 'home/content';
		$this->load->view($this->template, $this->viewdata);

	}

	public function dashboard_data()
	{
		$all_post = $this->general->all_post();

		// switch ($all_post->type) 
		// {
		// 	case 'reservation':
				
		// 	break;
		// 	case 'customers':
				
		// 	break;
		// 	case 'branch':
				
		// 	break;
		// 	case 'fields':
				
		// 	break;
			
			
		// }

	}
	

	
	
}