<?php defined('BASEPATH') OR exit('No direct script access allowed');

class fields extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();
		
		$this->viewdata['controller'] = 'fields';
		$this->viewdata['mod_alias'] = 'fields';
		$this->page = 'fields';

	
	}
	public function index()
	{
		$res = $this->input->server('REQUEST_METHOD');
		$this->general->blocked_page($this->page);

		if($res == 'GET')
		{
			$this->viewdata['branches'] = $this->general->get_table('branches','', ['id', 'name']);
			$this->viewdata['title'] = 'Soccer Fields';
			$this->viewdata['content'] = 'fields/table';
			$this->load->view($this->template, $this->viewdata);
		}
		else
		{
			
			$all_post = $this->general->all_post();

			$data = [];

			$no = $_POST['start'];

			$this->general->column_search = ['f.name', 'f.branch_id', 'f.status'];
			$this->general->column_order = ['f.name', 'f.branch_id', 'f.status'];


			$this->general->table = 'fields as f';
			$this->db->join('branches as b', 'b.id = f.branch_id', 'inner');
			$this->db->select(['f.name', 'f.branch_id', 'f.id', 'f.status', 'b.name as branch']);
			$list = $this->general->get_datatables();

			foreach ($list as $val) {
				$action = '';
				$row = array();
				$row['name'] = $val->name;
				$row['branch'] = $val->branch_id;
				$row['branch_name'] = $val->branch;
				$row['status'] = $val->status  == 1 ? '<label class="label label-info">Active</label>' : '<label class="label label-warning">Inactive</label>';
				$row['status_val'] = $val->status;
			

				if($this->general->mod_access($this->page, 'alter')){
					$action .= ' <button class="btn btn-default btn-sm modal_action" data-id="'.$val->id.'" data-toggle="modal" data-target="#modal_action" data-type="edit" data-header="Edit Branch"><i class="fa fa-pencil"></i> Edit</button>';

				}
				if($this->general->mod_access($this->page, 'drop')){
					$action .= ' <button class="btn btn-default md-trigger btn-sm waves-effect waves-light" data-datatable="#fields_datatable" data-id="'.$val->id.'" data-toggle="modal" data-target="#modal_delete"><i class="fa fa-trash"></i> Delete</button>';
				}
				$row['action'] = $action;
				$data[] = $row;
			}

			$this->db->join('branches as b', 'b.id = f.branch_id', 'inner');
			$x = $this->db->get('fields as f')->num_rows();
			$total =$x;

			$this->db->join('branches as b', 'b.id = f.branch_id', 'inner');
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
			$fv->set_rules('status', 'status', 'required');
			$fv->set_rules('branch', 'branch', 'required');

			if($fv->run() == TRUE)
			{
				 $this->db->where('branch_id', $all_post->branch);
				 $branch = $this->general->get_table('fields', ['name' => $all_post->name]);

				 if($branch->num_rows() > 0)
				 {
				 	  exit($this->general->json_msg('error', 'Name is Already Taken'));
				 }

				 $insert_data = [
			    				'name' => $all_post->name
			    				,'status' => $all_post->status
			    				,'branch_id' => $all_post->branch
			    			   ];
			    $this->general->insert_table('fields', $insert_data);

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
			$fv->set_rules('status', 'status', 'required');
			$fv->set_rules('branch', 'branch', 'required');
		

			if($fv->run() == TRUE)
			{
				 $this->db->where('id !=', $all_post->id);
			 	 $this->db->where('branch_id', $all_post->branch);
				 $branch = $this->general->get_table('fields', ['name' => $all_post->name]);
				 if($branch->num_rows() > 0)
				 {
				 	  exit($this->general->json_msg('error', 'Name is Already Taken'));
				 }
				 $update_data = [
			    				'name' => $all_post->name
			    				,'status' => $all_post->status
			    				,'branch_id' => $all_post->branch
			    			   ];
			    $this->general->update_table('fields', ['id' => $all_post->id],$update_data);

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
		$this->general->delete_table('fields', ['id' => $all_post->id]);

		exit($this->general->json_msg('success', 'Successfully Deleted'));
	}
	

	
}