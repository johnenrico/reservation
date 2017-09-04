<?php defined('BASEPATH') OR exit('No direct script access allowed');

class settings extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();
		
		$this->viewdata['modid'] = $this->general->get_modid('Settings');
		$this->viewdata['controller'] = 'settings';
	}

	function index()
	{

		
		$this->viewdata['incremental'] = $this->general->get_table('settings', ['name' => 'incremental'], 'data')->row()->data;
		$this->viewdata['title'] = 'Settings';
		$this->viewdata['content'] = 'settings/content';
		$this->load->view($this->template, $this->viewdata);
	}
	
	function update()
	{
		$all_post = $this->general->all_post();
		switch ($all_post->type) {
			case 'incremental':
			foreach ($all_post as &$value) {
				echo $value;
			}

			exit();
			break;
			
		}

	}
	
}