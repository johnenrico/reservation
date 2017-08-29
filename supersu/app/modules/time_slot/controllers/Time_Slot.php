<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Time_Slot extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		// $this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();
		
		$this->viewdata['controller'] = 'time_slot';
		$this->viewdata['mod_alias'] = 'time_slot';
		$this->page = 'time_slot';

	
	}
	public function index()
	{
		$res = $this->input->server('REQUEST_METHOD');
		$this->general->blocked_page($this->page);

		if($res == 'GET')
		{
			$this->viewdata['title'] = 'Time Slots';
			$this->viewdata['content'] = 'time_slot/table';
			$this->load->view($this->template, $this->viewdata);
		}
		else
		{
			
			$all_post = $this->general->all_post();

			$data = [];

			$no = $_POST['start'];

			$this->general->column_search = ['t.start', 't.end', 't.amount'];
			$this->general->column_order = ['t.start', 't.end', 't.amount'];


			$this->general->table = 'time_slots as t';
			$this->db->select(['t.start', 't.end', 't.amount', 't.id']);
			$list = $this->general->get_datatables();

			foreach ($list as $val) {
				$action = '';
				$row = array();
				$row['start'] = date('H:i a',strtotime($val->start));
				$row['end'] = date('H:i a',strtotime($val->end));
				$row['amount'] = number_format($val->amount);
		
				if($this->general->mod_access($this->page, 'alter')){
					$action .= ' <button class="btn btn-default btn-sm modal_action" data-id="'.$val->id.'" data-toggle="modal" data-target="#modal_action" data-type="edit" data-header="Edit Time Slot"><i class="fa fa-pencil"></i> Edit</button>';

				}
				if($this->general->mod_access($this->page, 'drop')){
					$action .= ' <button class="btn btn-default md-trigger btn-sm waves-effect waves-light" data-datatable="#time_slots_datatable" data-id="'.$val->id.'" data-toggle="modal" data-target="#modal_delete"><i class="fa fa-trash"></i> Delete</button>';
				}
				$row['action'] = $action;
				$data[] = $row;
			}

	
			$x = $this->db->get('time_slots as g')->num_rows();
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
			$fv->set_rules('start', 'start', 'required');
			$fv->set_rules('end', 'end', 'required');
			$fv->set_rules('amount', 'amount', 'required');

			$start = date("H:i", strtotime($all_post->start));

			if($fv->run() == TRUE)
			{	
				$start = date("H:i", strtotime($all_post->start));
				$end = date("H:i", strtotime($all_post->end));

				if(strtotime($start) > strtotime($end))
				{
					  exit($this->general->json_msg('error', 'Invalid Time Range'));
				}

				$this->db->where('(start = "'.$start.'" OR end = "'.$end.'")', FALSE, FALSE);
				$time = $this->general->get_table('time_slots', '', '1');

				if($time->num_rows() > 0)
				{
					 exit($this->general->json_msg('error', 'Time is Already Taken'));
				}
				 $insert_data = [
			    				'start' => $start
			    				,'end' => $end
			    				,'amount' => str_replace(',', '', $all_post->amount)
			    			   ];
			    $this->general->insert_table('time_slots', $insert_data);

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
			$fv->set_rules('start', 'start', 'required');
			$fv->set_rules('end', 'end', 'required');
			$fv->set_rules('amount', 'amount', 'required');

			if($fv->run() == TRUE)
			{

				$start = date("H:i", strtotime($all_post->start));
				$end = date("H:i", strtotime($all_post->end));

				if(strtotime($start) > strtotime($end))
				{
					  exit($this->general->json_msg('error', 'Invalid Time Range'));

				}
			
				$this->db->where('(start = "'.$start.'" OR end = "'.$end.'")', FALSE, FALSE);
				$this->db->where('id !=', $all_post->id);
				$time = $this->general->get_table('time_slots', '', '1');

				if($time->num_rows() > 0)
				{
					 exit($this->general->json_msg('error', 'Time is Already Taken'));
				}

				 $update_data = [
		    					'start' => $start
			    				,'end' => $end
			    				,'amount' => str_replace(',', '', $all_post->amount)
			    			   ];
			    $this->general->update_table('time_slots', ['id' => $all_post->id],$update_data);

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
		$this->general->delete_table('time_slots', ['id' => $all_post->id]);
		$this->general->delete_table('reservation', ['time_slot' => $all_post->id]);

		exit($this->general->json_msg('success', 'Successfully Deleted'));
	}
	
	
}