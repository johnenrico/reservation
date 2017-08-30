<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller
{

	function index()
	{
		$this->viewdata = $this->general->viewdata();
		$res = $this->input->server('REQUEST_METHOD');

		if($res == 'GET')
		{

			if(!$this->session->userdata('session_uid')){
				redirect('/');
			}

			$this->viewdata['page'] = 'users';
			$this->viewdata['title'] = 'Users';
			$this->viewdata['content'] = 'users/table';
			$this->load->view('users/table', $this->viewdata);
		}
		else
		{
			$all_post = $this->general->all_post();

			$data = [];

			$no = $_POST['start'];

			$this->general->column_search = ['b.name', 'f.name', 'ts.amount'];
			$this->general->column_order = [null, 'b.name', 'f.name', 'r.date_reserved'];

			$this->db->join('time_slots as ts', 'r.time_slot = ts.id', 'inner');
			$this->db->join('fields as f', 'r.field_id = f.id', 'inner');
			$this->db->join('branches as b', 'f.branch_id = b.id', 'inner');
			$this->db->where('customer_id', $this->session->userdata('session_uid'));
			$this->general->table = 'reservation as r';
			$this->db->select(['b.name as branch_name','f.name as field_name', 'r.date_reserved', 'ts.start', 'ts.end', 'ts.amount']);

			$list = $this->general->get_datatables();
			foreach ($list as $val)
			{

				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $val->branch_name;
				$row[] = $val->field_name;
				$row[] = date_format(date_create($val->date_reserved), 'F d, Y');
				$row[] = $val->start;
				$row[] = $val->end;
				$row[] = $val->amount;

				$data[] = $row;
			}

			
			$this->db->join('time_slots as ts', 'r.time_slot = ts.id', 'inner');
			$this->db->join('fields as f', 'r.field_id = f.id', 'inner');
			$this->db->join('branches as b', 'f.branch_id = b.id', 'inner');
			$this->db->where('customer_id', $this->session->userdata('session_uid'));

			$filtered = $this->general->count_filtered();

			$x = $this->db->get('reservation as r')->num_rows();
			$total =$x;

			$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filtered,
			"data" => $data,
			];

			return $this->general->__gzip(json_encode($output));

		}
	}
	
}