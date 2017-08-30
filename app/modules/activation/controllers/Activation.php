<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Activation extends MX_Controller
{

	function index()
	{
		$this->viewdata['title'] = 'Account Activation';
		$this->load->view('activation/activation', $this->viewdata);
	}

	function do_activate()
	{



	}
	
	
}