<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();

		$this->viewdata['modid'] = $this->general->get_modid('users');
		$this->viewdata['controller'] = 'users';

		
	}

	function index()
	{
		$this->general->blocked_page('users');

		$this->viewdata['title'] = 'Users';
		$this->viewdata['content'] = 'users/table';
		$this->load->view($this->template, $this->viewdata);
	}



	public function create()
	{

	}
	public function store()
	{

	}
	public function edit($id)
	{

	}
	public function update()
	{

	}


	
	
}