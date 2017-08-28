<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();
		
		$this->viewdata['controller'] = 'customers';
		$this->viewdata['mod_alias'] = 'customers';
		$this->page = 'customers';

	
	}
	public function index()
	{
		$res = $this->input->server('REQUEST_METHOD');
		$this->general->blocked_page($this->page);

		if($res == 'GET')
		{
			$this->viewdata['title'] = 'Customers';
			$this->viewdata['content'] = 'customers/table';
			$this->load->view($this->template, $this->viewdata);
		}
		else
		{
			
			$all_post = $this->general->all_post();

			$data = [];

			$no = $_POST['start'];

			$this->general->column_search = ['c.username','c.password','c.name', 'c.email', 'c.phone', 'c.passport_id', 'c.created_at'];
			$this->general->column_order = ['c.username','c.password','c.name', 'c.email', 'c.phone', 'c.passport_id', 'c.created_at'];


			$this->general->table = 'customers as c';
			$this->db->select(['c.id','c.name','c.username','c.password','c.name', 'c.email', 'c.phone', 'c.passport_id', 'c.created_at']);
			$list = $this->general->get_datatables();

			foreach ($list as $val) {

				$passport  = $val->passport_id;
				$passport_format = '<span class="cursor show_pass">'.substr($passport, 0, strlen($passport) - 6).'<i data-value="'.substr($passport,  6 - strlen($passport) ).'">******</i></span>';

				$pass  = base64_decode(base64_decode($val->password));
				$password = '<span class="cursor show_pass">'.substr($pass, 0, strlen($pass) - 6).'<i data-value="'.substr($pass,  6 - strlen($pass) ).'">******</i></span>'; 	 	


				$action = '';
				$row = array();
				$row['name'] = $val->name;
				$row['username'] = $val->username.'<br/>'.$passport_format;
				$row['contact'] = $val->email.'<br/>'.$val->phone;
				$row['password'] = $password;
				$row['passport_id'] = $passport;
				$row['created_at'] = date("F d, Y", strtotime($val->created_at));
				$row['username_val'] = $val->username;
				$row['passport_id_val'] = $val->passport_id;
				$row['email'] = $val->email;
				$row['phone'] = $val->phone;


				if($this->general->mod_access($this->page, 'alter')){
					$action .= ' <button class="btn btn-default btn-sm modal_action" data-id="'.$val->id.'" data-toggle="modal" data-target="#modal_action" data-type="edit" data-header="Edit Customer"><i class="fa fa-pencil"></i> Edit</button>';

				}
				if($this->general->mod_access($this->page, 'drop')){
					$action .= ' <button class="btn btn-default md-trigger btn-sm waves-effect waves-light game_delete" data-id="'.$val->id.'" data-toggle="modal" data-target="#modal_delete"><i class="fa fa-trash"></i> Delete</button>';
				}
				$row['action'] = $action;
				$row['action'] = $action;
				$data[] = $row;
			}

			$x = $this->db->get('customers as c')->num_rows();
			$total =$x;

			$filtered = $this->general->count_filtered();

			$output = [
				"draw" => $_POST['draw'],
				"recordsTotal" => $total,
				"recordsFiltered" => $filtered,
				"data" => $data,
				];

			return $this->general->__gzip(json_encode($output));

		}
	}

	public function save()
	{

		$all_post = $this->general->all_post();
		if($all_post->type == 'create')
		{
			$this->general->blocked_page($this->page, 'create');
			$fv = $this->form_validation;
			$fv->set_rules('name', 'name', 'required');
			$fv->set_rules('passport_id', 'passport_id', 'required|is_unique[customers.passport_id]');
			$fv->set_rules('email', 'email', 'required|is_unique[customers.email]|valid_email');
			$fv->set_rules('phone', 'phone', 'required|is_unique[customers.phone]');
			$fv->set_rules('username', 'username', 'required|min_length[6]|is_unique[customers.username]');
			$fv->set_rules('password', 'password', 'required|min_length[6]|max_length[12]');
			$fv->set_rules('rpassword', 'rpassword', 'required|min_length[6]|max_length[12]');

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

			    exit($this->general->json_msg('success', 'Succesfully Save'));	
				
			}	
			else
			{
			   exit($this->general->json_msg('error', $this->form_validation->error_array()));		
			}


		}
		else
		{
		
			$this->general->blocked_page($this->page, 'alter');
			$fv = $this->form_validation;
			$fv->set_rules('name', 'name', 'required');
			$fv->set_rules('passport_id', 'passport_id', 'required');
			$fv->set_rules('email', 'email', 'required|valid_email');
			$fv->set_rules('phone', 'phone', 'required');
			$fv->set_rules('username', 'username', 'required|min_length[6]');
			$fv->set_rules('password', 'password', 'required|min_length[6]|max_length[12]');
			$fv->set_rules('rpassword', 'rpassword', 'required|min_length[6]|max_length[12]');

			if($fv->run() == TRUE)
			{
			     $this->db->where('id !=', $all_post->id);
				 $passport = $this->general->get_table('customers', ['passport_id' => $all_post->passport_id]);
				 if($passport->num_rows() > 0)
				 {
				 	  exit($this->general->json_msg('error', 'Passport is Already Taken'));
				 }
				 $this->db->where('id !=', $all_post->id);
				 $email = $this->general->get_table('customers', ['email' => $all_post->email]);
				 if($email->num_rows() > 0)
				 {
				 	  exit($this->general->json_msg('error', 'Email is Already Taken'));
				 }
				 $this->db->where('id !=', $all_post->id);
				 $phone = $this->general->get_table('customers', ['phone' => $all_post->phone]);
				 if($phone->num_rows() > 0)
				 {
				 	  exit($this->general->json_msg('error', 'Phone is Already Taken'));
				 }
				 $this->db->where('id !=', $all_post->id);
				 $username = $this->general->get_table('customers', ['username' => $all_post->username]);
				 if($phone->num_rows() > 0)
				 {
				 	  exit($this->general->json_msg('error', 'Username is Already Taken'));
				 }

				 $update_data = [
			    				'name' => $all_post->name
			    				,'phone' => $all_post->phone
			    				,'email' => $all_post->email
			    				,'passport_id' => $all_post->passport_id
			    				,'username' => $all_post->username
			    				,'password' => base64_encode(base64_encode($all_post->password))
			    				,'updated_at' => $this->general->datetime
			    			   ];
			    $this->general->update_table('customers', ['id' => $all_post->id],$update_data);

			    exit($this->general->json_msg('success', 'Succesfully Updated'));
			}	
			else
			{
				exit($this->general->json_msg('error', $this->form_validation->error_array()));
			}

		}

	}
	
}