<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		// $this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();
		
		$this->viewdata['controller'] = 'reservation';
		$this->page = 'reservation';

	
	}
	public function index()
	{
		$res = $this->input->server('REQUEST_METHOD');
		$this->general->blocked_page($this->page);

		if($res == 'GET')
		{
			$this->viewdata['title'] = 'Reservations';
			$this->viewdata['content'] = 'reservation/table';
			$this->load->view($this->template, $this->viewdata);
		}
		else
		{
			
			$all_post = $this->general->all_post();

			$data = [];

			$no = $_POST['start'];

			$this->general->column_search = ['g.name', 'g.draw1_start', 'g.draw1_end', 'g.draw2_start', 'g.draw2_end'];
			$this->general->column_order = ['g.name', 'g.draw1_start', 'g.draw1_end', 'g.draw2_start', 'g.draw2_end'];


			$this->general->table = 'game as g';
			$this->db->join('users as s', 's.id = g.uid', 'inner');
			$this->db->select('g.id, g.name, g.draw1_start, g.draw1_end, g.draw2_start, g.draw2_end, g.created_at');
			$list = $this->general->get_datatables();

			foreach ($list as $val) {
				$action = '';
				$row = array();
				$row['name'] = $val->name;
				$row['draw1_start'] = $val->draw1_start;
				$row['draw1_end'] = $val->draw1_end;
				$row['draw2_start'] = $val->draw2_start;
				$row['draw2_end'] = $val->draw2_end;
				$row['created_at'] = date("F d, Y", strtotime($val->created_at));


				if($this->general->mod_access('game', 'alter')){
					$action .= ' <a href="'.site_url('game/edit/'.$val->id).'" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Edit</a>';

				}
				if($this->general->mod_access('game', 'drop')){
					$action .= ' <button class="btn btn-default md-trigger   btn-sm waves-effect waves-light game_delete" data-id="'.$val->id.'" data-toggle="modal" data-target="#modal_delete"><i class="fa fa-trash"></i> Delete</button>';
				}
				$row['action'] = $action;
				$data[] = $row;
			}

			$this->db->join('users as s', 's.id = g.uid', 'inner');
			$x = $this->db->get('game as g')->num_rows();
			$total =$x;

			$this->db->join('users as s', 's.id = g.uid', 'inner');
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

	public function create()
	{

	}
	public function store()
	{

	}
	public function edit($id)
	{

	}
	public function update()
	{

	}
	
}