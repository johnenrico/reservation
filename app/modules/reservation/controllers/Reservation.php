<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation extends MX_Controller
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
		} else {
			exit(var_dump("expression"));
		}
	
	}

	public function get_grids()
	{
		$all_post = $this->general->all_post();

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

				$status = $this->general->get_table('reservation', ['date_reserved' => $date, 'field_id' => $vals->id,'time_slot' => $t->id, '']);

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

	public function save()
	{

		if(!$this->session->userdata('session_uid')) {
			$this->session->set_flashdata('msg_error', 'Please login first before to book a reservation.');
			exit(json_encode(array('login' => TRUE)));
		}

		$this->db->where('date_reserved >=', date('Y-m-d'));
		$this->db->where('status', 1);
		$this->db->where('customer_id', $this->session->userdata('session_uid'));
		$res = $this->db->get('reservation');

		if ($res->num_rows() == 3) {
			$this->session->set_flashdata('msg_error', 'You cannot booked 3 consecutive reservation.');
			exit(json_encode(array('users' => TRUE)));
		}

		$all_post = $this->general->all_post();

		$insert_data = [
		'field_id' => $all_post->fields
		,'time_slot' => $all_post->timeslot
		,'customer_id' => $this->session->userdata('session_uid')
		,'date_reserved' => $all_post->date
		,'status' => 1
		,'updated_at' => $this->general->datetime
		];

		$this->general->insert_table('reservation', $insert_data);

		exit($this->general->json_msg('success', 'Successfully Saved'));

	}

	public function view($id)
	{

	
		$this->db->join('fields as f' ,'f.id = r.field_id', 'inner');
		$this->db->join('branches as g' ,'g.id = f.branch_id', 'inner');
		$this->db->join('time_slots as t' ,'t.id = r.time_slot', 'inner');
		$this->db->join('customers as c' ,'c.id = r.customer_id', 'inner');
		$this->viewdata['data'] = $this->general->get_table('reservation as r', '',['r.date_reserved','r.field_id','r.time_slot', 'r.customer_id','f.branch_id as branch','g.name as branch_name', 'c.name','c.phone','c.email', 'c.username','c.passport_id','t.start', 't.end','t.amount','f.name as field_name'])->row();

		$this->viewdata['id'] = $id;

	

		$this->db->group_by('r.field_id');
		$this->db->join('fields as f' ,'f.id = r.field_id', 'inner');
		$field = $this->general->get_table('reservation as r', ['r.date_reserved' => $this->viewdata['data']->date_reserved,'f.branch_id' => $this->viewdata['data']->branch], 'r.field_id');
		$field_val = [];
		foreach ($field->result() as $vals) 
		{
			if($this->viewdata['data']->field_id != $vals->field_id)
			{
				array_push($field_val, $vals->field_id);	
			}
			
		}
	
		$this->db->where_not_in('id', $field_val);
		$this->db->order_by('start', 'asc');
		$this->viewdata['time'] = $this->general->get_table('time_slots', '',['id','start','end']);

		$this->viewdata['fields'] = $this->general->get_table('fields', ['branch_id' => $this->viewdata['data']->branch]);

		$this->viewdata['title'] = 'Reservations';
		$this->viewdata['content'] = 'reservation/form_view';
		$this->load->view($this->template, $this->viewdata);

	}

	public function get_date_available()
	{
		$all_post = $this->general->all_post();

		$count_field = $this->general->get_table('fields', ['branch_id' => $all_post->branch_id], '*')->num_rows();

		$avail_time = $this->general->get_table('time_slots', '', '*')->num_rows();


		$max_slot = $count_field * $avail_time;

		$this->db->where('date_reserved >=', date('Y-m-d'));
		$this->db->where('status', 1);
		$this->db->group_by('date_reserved');
		$date = $this->general->get_table('reservation', '', 'date_reserved');

		$data = [];

		foreach ($date->result() as $key => $value) {
			array_push($data, $value->date_reserved);
		}

		for ($x = 1; $x < 30; $x++) { 
			array_push($data, date('Y-m-d', strtotime('+'. $x .' day')));
		}

		$dateSet['available_slots'] = [];
		$i = 0;
		foreach ($data as $key => $value) {
			$this->db->where('date_reserved', $value);
			$res = $this->general->get_table('reservation', ['status' => 1], 'date_reserved')->num_rows();
			$slots =  $max_slot - $res;
			$dateSet['available_slots'][$i]['date'][] = date_format(date_create($value), 'm-d-Y');
			$dateSet['available_slots'][$i]['slot'][] = $slots;
		}

		exit(json_encode($dateSet));

	}

	public function get_fields_available()
	{
		$all_post = $this->general->all_post();

		$fields = $this->general->get_table('fields', ['branch_id' => $all_post->branch_id]);

		$data = [];
		$i = 0;
		foreach ($fields->result() as $vals) 
		{
			$data[$i]['fields'] = $vals->name;
			$data[$i]['id'] = $vals->id;;
			$i ++;
		}
		exit($this->general->json_msg('success', $data));
	}

	public function get_time_available()
	{
		$all_post = $this->general->all_post();

		$time = $this->general->get_table('reservation', ['date_reserved' => $all_post->date, 'field_id' => $all_post->fields, 'status' => 1], 'time_slot');
		$data = [];
		foreach ($time->result() as $vals) 
		{
			array_push($data, $vals->time_slot);
		}

		if ($data != null) {
			$this->db->where_not_in('id', $data);
		}
		$avail_time = $this->general->get_table('time_slots', '','*');

		
		exit($this->general->json_msg('success', $avail_time->result()));
	}

}