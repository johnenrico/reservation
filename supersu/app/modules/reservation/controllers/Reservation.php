<?php defined('BASEPATH') OR exit('No direct script access allowed');

class reservation extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

	    $this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();
		
		$this->viewdata['controller'] = 'reservation';
		$this->viewdata['mod_alias'] = 'reservation';
		$this->page = 'reservation';

	
	}
	public function index()
	{
		$res = $this->input->server('REQUEST_METHOD');
		$this->general->blocked_page($this->page);

		if($res == 'GET')
		{
			$this->viewdata['slots'] = $this->general->get_table('time_slots','', ['id', 'start', 'end']);
			$this->viewdata['branches'] = $this->general->get_table('branches','', ['id', 'name']);
			$this->viewdata['title'] = 'Reservations';
			$this->viewdata['content'] = 'reservation/table';
			$this->load->view($this->template, $this->viewdata);
		}
	
	}

	public function get_grids()
	{
		$this->general->blocked_page($this->page);
		$all_post = $this->general->all_post();

		$this->db->where('status', 1);
		$fields = $this->general->get_table('fields', ['branch_id' => $all_post->branch_id]);

		$date = date('Y-m-d', strtotime($all_post->date));

		$data = [];
		$this->db->order_by('start', 'asc');
		$time = $this->general->get_table('time_slots');
		$i = 0;
		foreach ($fields->result() as $vals) 
		{
			$data[$i]['fields'] = $vals->name;
			$data[$i]['id'] = $vals->id;
			$sub = [];
			$j = 0;
			foreach ($time->result() as $t) 
			{
				$sub[$j]['time'] = date('H:i a', strtotime($t->start)).' to '.date('H:i a', strtotime($t->end));
				$sub[$j]['amount'] = $t->amount;

				$status = $this->general->get_table('reservation', ['date_reserved' => $date, 'field_id' => $vals->id,'time_slot' => $t->id, 'status' => 1]);

				$sub[$j]['status'] = $status->num_rows() > 0 ? 'reserved' : 0;
				$sub[$j]['reservation_id'] = $status->num_rows() > 0 ? $status->row()->id : null;
				$sub[$j]['time_id'] = $t->id;
				$j++;
			}
			$data[$i]['sub'] = $sub;
			$i ++;
		}
		exit($this->general->json_msg('success', $data));

	}
	public function latest_appointment()
	{
		$this->db->order_by('updated_at', 'desc');
		$reserve = $this->general->get_table('reservation', '', ['id']);
		exit($this->general->json_msg('success', $reserve->row()->id));
	}

	public function save()
	{
		$all_post = $this->general->all_post();
		$fv = $this->form_validation;

			$fv->set_rules('name', 'name', 'required');
			$fv->set_rules('date', 'date', 'required');
			$fv->set_rules('timeslot', 'timeslot', 'required');
			$fv->set_rules('field', 'field', 'required');
			
		if($fv->run() == TRUE)
		{
			$this->db->where('passport_id', $all_post->name);
			$this->db->or_where('username', $all_post->name);
			$user = $this->general->get_table('customers');
			if($user->num_rows() == 0)
			{
				exit($this->general->json_msg('error', 'Customer Not Found'));
			}

			$this->db->where('activation IS NULL', null, false);
			$this->db->where('passport_id', $all_post->name);
			$this->db->or_where('username', $all_post->name);
			$user = $this->general->get_table('customers');
			if($user->num_rows() == 0)
			{
				exit($this->general->json_msg('error', 'Customer Not Activated'));
			}



			$insert_data = [
							'field_id' => $all_post->field
							,'time_slot' => $all_post->timeslot
							,'customer_id' => $user->row()->id
							,'date_reserved' => date('Y-m-d',strtotime($all_post->date))
							,'status' => 1
							,'updated_at' => $this->general->datetime
							];

			$this->general->insert_table('reservation', $insert_data);

			exit($this->general->json_msg('success', 'Successfully Saved'));

		}
		else
		{
			exit($this->general->json_msg('error', $this->form_validation->error_array()));
		}
	}

	public function view($id)
	{

		$this->general->blocked_page($this->page);
		$this->db->join('fields as f' ,'f.id = r.field_id', 'inner');
		$this->db->join('branches as g' ,'g.id = f.branch_id', 'inner');
		$this->db->join('time_slots as t' ,'t.id = r.time_slot', 'inner');
		$this->db->join('customers as c' ,'c.id = r.customer_id', 'inner');
		$this->viewdata['data'] = $this->general->get_table('reservation as r', '',['r.date_reserved','r.field_id','r.time_slot', 'r.customer_id','f.branch_id as branch','g.name as branch_name', 'c.name','c.phone','c.email', 'c.username','c.passport_id','t.start', 't.end','t.amount','f.name as field_name'])->row();

		$this->viewdata['id'] = $id;

	

		
		
		$field = $this->general->get_table('reservation as r', ['r.date_reserved' => $this->viewdata['data']->date_reserved,'r.field_id' => $this->viewdata['data']->field_id], 'r.time_slot');
		$field_val = [];
		
		foreach ($field->result() as $vals) 
		{
			
				array_push($field_val, $vals->time_slot);	
			
			
		}
			
		$this->db->where_not_in('id', $field_val);
		$this->db->order_by('start', 'asc');
		$this->viewdata['time'] = $this->general->get_table('time_slots', '',['id','start','end']);

		$this->viewdata['fields'] = $this->general->get_table('fields', ['branch_id' => $this->viewdata['data']->branch]);

		$this->viewdata['title'] = 'Reservations';
		$this->viewdata['content'] = 'reservation/form_view';
		$this->load->view($this->template, $this->viewdata);

	}
	public function get_time_available()
	{
		$this->general->blocked_page($this->page);
		$all_post = $this->general->all_post();

		$this->db->where('id !=', $all_post->id);
		$time = $this->general->get_table('reservation', ['date_reserved' => $all_post->date, 'field_id' => $all_post->fields], 'time_slot');
		$data = [];
		foreach ($time->result() as $vals) 
		{
			array_push($data, $vals->time_slot);
		}

		$this->db->where_not_in('id', $data);
		$avail_time = $this->general->get_table('time_slots', '','*');

		
		exit($this->general->json_msg('success', $avail_time->result()));
	}
	public function update()
	{
		$this->general->blocked_page($this->page, 'alter');
		$all_post = $this->general->all_post();
		$this->db->where('id !=',$all_post->id);
		$is_avail = $this->general->get_table('reservation', ['time_slot' => $all_post->time_slot, 'field_id' => $all_post->field_id, 'date_reserved' => $all_post->date_reserved]);
		if($is_avail->num_rows() > 0)
		{
			exit($this->general->json_msg('error', 'Slots is Already Taken'));
		}
		$update_data = [
		'time_slot' => $all_post->time_slot
		,'field_id' => $all_post->field_id
		,'date_reserved' => $all_post->date_reserved
		];
		$this->general->update_table('reservation', ['id' => $all_post->id], $update_data);
		exit($this->general->json_msg('success', 'Successfully Updated'));	

	}
	public function cancel()
	{
		$this->general->blocked_page($this->page, 'drop');
		$all_post = $this->general->all_post();
		$this->general->update_table('reservation', ['id' => $all_post->id], ['status' => 0]);

		exit($this->general->json_msg('success', 'Successfully Canceled', site_url('').'/'.$this->page));
	}
	
	
}