<?php defined('BASEPATH') OR exit('No direct script access allowed');

class home extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		// $this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();
		
		$this->viewdata['controller'] = 'home';

	
	}
	public function index()
	{
		

		$daily_reservation = $this->general->get_table('reservation', ['date_reserved' => date('Y-m-d')])->num_rows();
		$active = $this->general->get_table('customers', ['activation' => null])->num_rows();
		$inactive = $this->general->get_table('customers', ['activation !=' => null])->num_rows();
		$time_slots = $this->general->get_table('time_slots')->num_rows();

		$this->viewdata['reservation'] = $daily_reservation;
		$this->viewdata['active'] = $active;
		$this->viewdata['inactive'] = $inactive;
		$this->viewdata['time_slots'] = $time_slots;
		


		$this->viewdata['title'] = 'Dashboard';
		$this->viewdata['content'] = 'home/content';
		$this->load->view($this->template, $this->viewdata);

	}

	public function recent_reservation()
	{
		$all_post = $this->general->all_post();

		$data = [];

		$this->general->column_search = ['c.name', 'c.username', 'r.id'];
		$this->general->column_order = ['c.name', 'c.username', 'r.id'];

		$this->db->join('time_slots as t', 't.id = r.time_slot','inner');
		$this->db->join('customers as c', 'c.id = r.customer_id', 'inner');
		$this->general->table = 'reservation as r';
		$this->db->select(['c.name', 'c.username','t.start', 't.end', 'c.name', 'c.username','r.date_reserved','r.id']);
		$list = $this->general->get_datatables();

		foreach ($list as $val) {
			$action = '';
			$row = array();
			$row['time'] = date('H:i a',strtotime($val->start)).' to '. date('H:i a',strtotime($val->end));
			$row['users'] = $val->name.'<br/><small>'.$val->username.'</small>';
			$row['date_reserved'] = date('F d, Y', strtotime($val->date_reserved));
			$row['id'] = $val->id;

			$data[] = $row;
		}



		$this->db->join('time_slots as t', 't.id = r.time_slot','inner');
		$this->db->join('customers as c', 'c.id = r.customer_id', 'inner');
		$x = $this->db->get('reservation as r')->num_rows();
		$total =$x;

		$this->db->join('time_slots as t', 't.id = r.time_slot','inner');
		$this->db->join('customers as c', 'c.id = r.customer_id', 'inner');
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