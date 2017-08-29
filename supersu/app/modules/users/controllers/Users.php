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


		$this->viewdata['controller'] = 'users';
		$this->viewdata['mod_alias'] = 'users';
		$this->page = 'users';

		
	}

	function index()
	{
		$res = $this->input->server('REQUEST_METHOD');
		$this->general->blocked_page($this->page);

		if($res == 'GET')
		{
			$this->viewdata['roles'] = $this->general->get_table('user_group','', ['guid', 'gname']);
			$this->viewdata['branch'] = $this->general->get_table('branches','', ['id', 'name']);
			$this->viewdata['title'] = 'Users';
			$this->viewdata['content'] = 'users/table';
			$this->load->view($this->template, $this->viewdata);
		}
		else
		{
			$all_post = $this->general->all_post();

			$data = [];

			$no = $_POST['start'];

			$this->general->column_search = ['u.username', 'u.name', 'u.email', 'u.phone', 'u.password', 'ug.gname'];
			$this->general->column_order = ['u.username', 'u.name', 'u.email', 'u.phone', 'u.password', 'ug.gname'];

			$this->db->join('user_group as ug', 'ug.guid = u.guid', 'inner');
			$this->general->table = 'users as u';
			$this->db->select(['u.id','u.username', 'u.name', 'u.email', 'u.phone', 'u.password', 'ug.gname', 'ug.guid', 'u.branch_id']);

			$list = $this->general->get_datatables();
			foreach ($list as $val) {

				$pass  = base64_decode(base64_decode($val->password));
				$password = '<span class="cursor show_pass">'.substr($pass, 0, strlen($pass) - 6).'<i data-value="'.substr($pass,  6 - strlen($pass) ).'">******</i></span>'; 		

				$action = '';
				$row = array();
				$row['username'] = $val->username;
				$row['name'] = $val->name;
				$row['email'] = $val->email;
				$row['phone'] = $val->phone;
				$row['password'] = $password;	
				$row['gname'] = $val->gname;	
				$row['guid'] = $val->guid;	
				$row['branch'] = $val->branch_id;	


				if($this->general->mod_access($this->page, 'alter')){
					$action .= ' <button class="btn btn-default btn-sm modal_action" data-id="'.$val->id.'" data-toggle="modal" data-target="#modal_action" data-type="edit" data-header="Edit Fields"><i class="fa fa-pencil"></i> Edit</button>';

				}
				if($this->general->mod_access($this->page, 'drop')){
					$action .= ' <button class="btn btn-default md-trigger btn-sm waves-effect waves-light" data-datatable="#users_datatable" data-id="'.$val->id.'" data-toggle="modal" data-target="#modal_delete"><i class="fa fa-trash"></i> Delete</button>';
				}
				$row['action'] = $action;
				$data[] = $row;
			}

			
			$this->db->join('user_group as ug', 'ug.guid = u.guid', 'inner');
			$x = $this->db->get('users as u')->num_rows();
			$total =$x;

			$this->db->join('user_group as ug', 'ug.guid = u.guid', 'inner');
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
			$fv->set_rules('name', 'name', 'required|is_unique[users.name]');
			$fv->set_rules('phone', 'phone', 'required|is_unique[users.phone]');
			$fv->set_rules('email', 'email', 'required|is_unique[users.email]|valid_email');
			$fv->set_rules('role', 'role', 'required');
			$fv->set_rules('username', 'username', 'required|min_length[6]|is_unique[users.username]');
			$fv->set_rules('password', 'password', 'required|min_length[6]|max_length[12]');
			$fv->set_rules('rpassword', 'rpassword', 'required|min_length[6]|max_length[12]');

			if($fv->run() == TRUE)
			{
				 $insert_data = [
			    				'name' => $all_post->name
			    				,'phone' => $all_post->phone
			    				,'email' => $all_post->email
			    				,'guid' => $all_post->role
			    				,'branch_id' => $all_post->branch
			    				,'username' => $all_post->username
			    				,'password' => base64_encode(base64_encode($all_post->password))
			    			   ];
			    $this->general->insert_table('users', $insert_data);

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
			$fv->set_rules('phone', 'phone', 'required');
			$fv->set_rules('email', 'email', 'required|valid_email');
			$fv->set_rules('role', 'role', 'required');
			$fv->set_rules('username', 'username', 'required|min_length[6]');
			$fv->set_rules('password', 'password', 'required|min_length[6]|max_length[12]');
			$fv->set_rules('rpassword', 'rpassword', 'required|min_length[6]|max_length[12]');

			if($fv->run() == TRUE)
			{
			     $this->db->where('id !=', $all_post->id);
				 $branch = $this->general->get_table('users', ['name' => $all_post->name]);
				 if($branch->num_rows() > 0)
				 {
				 	  exit($this->general->json_msg('error', 'Name is Already Taken'));
				 }

			     $this->db->where('id !=', $all_post->id);
				 $branch = $this->general->get_table('users', ['phone' => $all_post->phone]);
				 if($branch->num_rows() > 0)
				 {
				 	  exit($this->general->json_msg('error', 'Phone is Already Taken'));
				 }


				 $this->db->where('id !=', $all_post->id);
				 $branch = $this->general->get_table('users', ['email' => $all_post->email]);
				 if($branch->num_rows() > 0)
				 {
				 	  exit($this->general->json_msg('error', 'Email is Already Taken'));
				 }

			     $this->db->where('id !=', $all_post->id);
				 $branch = $this->general->get_table('users', ['username' => $all_post->username]);
				 if($branch->num_rows() > 0)
				 {
				 	  exit($this->general->json_msg('error', 'Username is Already Taken'));
				 }
				 $update_data = [
			    				'name' => $all_post->name
			    				,'phone' => $all_post->phone
			    				,'email' => $all_post->email
			    				,'guid' => $all_post->role
			    				,'branch_id' => $all_post->branch
			    				,'username' => $all_post->username
			    				,'password' => base64_encode(base64_encode($all_post->password))
			    			   ];
			
			    $this->general->update_table('users', ['id' => $all_post->id],$update_data);

			    exit($this->general->json_msg('success', 'Succesfully Updated'));
			}	
			else
			{
				exit($this->general->json_msg('error', $this->form_validation->error_array()));
			}

		}

	}
	public function delete()
	{
		$this->general->blocked_page($this->page, 'drop');
		$all_post = $this->general->all_post();
		if($all_post->confirmation != 'CONFIRM')
		{
			exit($this->general->json_msg('error', 'Please Enter Confirm to Delete'));
		}
		$this->general->delete_table('users', ['id' => $all_post->id]);

		exit($this->general->json_msg('success', 'Successfully Deleted'));
	}
}