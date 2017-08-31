<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends MX_Controller
{

	function __construct()
	{


	}

	function index()
	{

		$this->viewdata = $this->general->viewdata();

	  	//if there is session
		if($this->session->userdata('session_uid') != ''){
			redirect('/');
		}

		$this->viewdata['page'] = 'registration';
		$this->viewdata['title'] = 'Registration';
		$this->load->view('registration/registration', $this->viewdata);
	}

	function do_register() {

		$all_post = $this->general->all_post();
		// exit(var_dump($all_post));
		// will old data into flash session
		foreach($all_post as $key => $val)
		{
			$this->session->set_flashdata($key, $val);
		}
		$url = $_SERVER['HTTP_REFERER'];
		// THIS IS server side validation
		$fv = $this->form_validation;
		$fv->set_rules('name', 'name', 'required');
		$fv->set_rules('passport_id', 'passport_id', 'required|is_unique[customers.passport_id]');
		$fv->set_rules('email', 'email', 'required|is_unique[customers.email]|valid_email');
		$fv->set_rules('phone', 'phone', 'required|is_unique[customers.phone]');
		$fv->set_rules('username', 'username', 'required|min_length[6]|is_unique[customers.username]');
		$fv->set_rules('password', 'password', 'required|min_length[6]|max_length[12]');
		$fv->set_rules('rpassword', 'confirm password', 'required|matches[password]|min_length[6]|max_length[12]');

		if($fv->run() == TRUE)
		{
			$insert_data = [
			'name' => $all_post->name
			,'phone' => $all_post->phone
			,'email' => $all_post->email
			,'passport_id' => $all_post->passport_id
			,'username' => $all_post->username
			,'password' => base64_encode(base64_encode($all_post->password))
			,'created_at' => $this->general->datetime
			];
			$this->general->insert_table('customers', $insert_data);

			echo json_encode(array("status" => TRUE));

		}
		else
		{

		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();

			foreach ($this->form_validation->error_array() as $key => $value) {
				$data['inputerror'][] = $key;
				$data['error_string'][] = $value;
			}

			exit(json_encode($data));		
		}


	}




	
}