<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		// $this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();
		
		$this->viewdata['controller'] = 'branch';
		$this->viewdata['mod_alias'] = 'branch';
		$this->page = 'branch';

	
	}
	public function index()
	{
		$res = $this->input->server('REQUEST_METHOD');
		$this->general->blocked_page($this->page);
		if($res == 'GET')
		{
			$this->viewdata['title'] = 'Branches';
			$this->viewdata['content'] = 'branch/table';
			$this->load->view($this->template, $this->viewdata);
		}
		else
		{
			
			$all_post = $this->general->all_post();

			$data = [];

			$no = $_POST['start'];

			$this->general->column_search = ['name', 'address', 'location', 'phone', 'contact_person'];
			$this->general->column_order = ['name', 'address', 'location', 'phone', 'contact_person'];


			$this->general->table = 'branches';
			$this->db->select(['id','name', 'address', 'location', 'phone', 'contact_person']);
			$list = $this->general->get_datatables();
			

			foreach ($list as $val) {
				$action = '';
				$row = array();
				$row['name'] = $val->name;
				$row['address'] = $val->address;
				$row['location'] = $val->location;
				$row['phone'] = $val->phone;
				$row['contact_person'] = $val->contact_person;			


				if($this->general->mod_access($this->page, 'alter')){
					$action .= ' <button class="btn btn-default btn-sm modal_action" data-id="'.$val->id.'" data-toggle="modal" data-target="#modal_action" data-type="edit" data-header="Edit Branch"><i class="fa fa-pencil"></i> Edit</button>';

				}
				if($this->general->mod_access($this->page, 'drop')){
					$action .= ' <button class="btn btn-default md-trigger btn-sm waves-effect waves-light game_delete" data-id="'.$val->id.'" data-toggle="modal" data-target="#modal_delete"><i class="fa fa-trash"></i> Delete</button>';
				}
				$row['action'] = $action;
				$data[] = $row;
			}

			

			$x = $this->db->get('branches')->num_rows();
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
			$fv->set_rules('name', 'name', 'required|is_unique[branches.name]');
			$fv->set_rules('person', 'person', 'required');
			$fv->set_rules('phone', 'phone', 'required');
			$fv->set_rules('address', 'address', 'required');


			if($fv->run() == TRUE)
			{
				 $insert_data = [
			    				'name' => $all_post->name
			    				,'address' => $all_post->address
			    				,'phone' => $all_post->phone
			    				,'contact_person' => $all_post->person
			    			   ];
			    $this->general->insert_table('branches', $insert_data);

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
			$fv->set_rules('person', 'person', 'required');
			$fv->set_rules('phone', 'phone', 'required');
			$fv->set_rules('address', 'address', 'required');

			if($fv->run() == TRUE)
			{
				 $this->db->where('id !=', $all_post->id);
				 $branch = $this->general->get_table('branches', ['name' => $all_post->name]);

				 if($branch->num_rows() > 0)
				 {
				 	  exit($this->general->json_msg('error', 'Name is Already Taken'));
				 }
				 $update_data = [
			    				'name' => $all_post->name
			    				,'address' => $all_post->address
			    				,'phone' => $all_post->phone
			    				,'contact_person' => $all_post->person
			    			   ];
			    $this->general->update_table('branches', ['id' => $all_post->id],$update_data);

			    exit($this->general->json_msg('success', 'Succesfully Updated'));
			}	
			else
			{
				exit($this->general->json_msg('error', $this->form_validation->error_array()));
			}

		}
		

	}
	
	
}