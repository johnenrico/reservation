<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Model
{
	public $session_front;

	function __construct()
	{
	
		parent::__construct();
		
		date_default_timezone_set('Asia/Manila');
		$this->datetime		= date('Y-m-d H:i:s');

		$this->session_uid		= $this->session->userdata('session_uid');
		$this->tempname 		= 'ui';

		$this->template 		= $this->tempname.DS.'template';
		$this->template_login 	= $this->tempname.DS.'login';


		$this->email_gateway = null;
  		$this->password_gateway = null;
  		$this->device_id = null;

		if(!defined('THEME')){
			define('THEME', TEMP.$this->tempname.'/');
		}
	   $this->table = null;
	   $this->column_order = null; 
	   $this->column_search = null; 
       $this->order = null; 
		
	}
	 public function check_user(){
		if(!$this->session_uid){
			redirect('login');
		}
		else{
			$this->db->join('user_group as ug', 'ug.guid = u.guid', 'inner');
			$users = $this->get_table('users as u', array('u.id' => $this->session_uid), 'u.*, ug.gname')->row();
			return $users;
		}
	}


	public function viewdata()
	{
		$viewdata = array(
			'site_name' => 'reservation',
			'admin_domain' => 'reservation',
			'site_domain' => 'reservation',
			'protocol' => ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http")."://",
			'controller' => $this->uri->segment(1),
			'tempname' => $this->tempname
			);

		return $viewdata;
	}




	function flash_message()
	{
		$msg = NULL;
		// <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		if($this->session->flashdata('msg_error') != null){
			$msg = '<div class="alert alert-danger">'.$this->session->flashdata('msg_error').'</div>';
		}
		if($this->session->flashdata('msg_success') != null){
			$msg = '<div class="alert alert-success">'.$this->session->flashdata('msg_success').'</div>';
		}
		if($this->session->flashdata('msg_info') != null){
			$msg = '<div class="alert alert-info">'.$this->session->flashdata('msg_info').'</div>';
		}
		
		
		return $msg;

	}

	function all_post()
	{
		return (object) $this->input->post();

	}

	function all_get()
	{
		return (object) $this->input->get();

	}

	
	public function __gzip($data = '')
	{
		$offset = 60 * 60;
		$expire = "expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
		header('HTTP/1.0 200 OK');
		header('HTTP/1.1 200 OK');
		header('Server: EUIS GEULIS');
		header('Content-Encoding: gz');
		header("Content-Type: application/json; charset=utf-8");
		header("Cache-Control: private, no-cache, no-store, must-revalidate");
		header( $expire );
		header('Vary: Accept-Encoding');
		header('Pragma: no-cache');
		echo trim($data);
	}
	/*
	 */
	
	// SELECT * FROM USERS
	function get_table($table, $where = '', $select = '', $option = '')
	{
		if($select)
		{
			$this->db->select($select);	
		}
		if($where)
		{
			$this->db->where($where);	
		}
		$option;
		return $this->db->get($table);	
	}


	function insert_table($table, $data)
	{
		return $this->db->insert($table, $data);	
	}	
	
	function update_table($table, $where ='', $data)
	{	
		if($where){
			$this->db->where($where);
		}
		return $this->db->update($table, $data);	
	}
	
	function delete_table($table, $where)
	{
		$this->db->where($where);
		return $this->db->delete($table);	
	}


	// Access Level

	function active_user()
	{
		$this->db->select('users.*, user_group.gname, user_group.role');
		$this->db->where('ID', $this->session_uid);
		$this->db->join('user_group', 'user_group.guid = users.guid');
		
		return $this->db->get('users')->row();

	}

	function get_module($where = '')
	{
		if($where)
		{
			$this->db->where($where);	
		}
		$this->db->order_by('mod_order', 'asc');
		return $this->db->get('module');
	}

	function get_modid($alias)
	{
		$get_module = $this->get_module(array('mod_alias' => $alias))->row();

		if(!$get_module->modid)
		{
			return show_404();
		}

		return $get_module->modid;
	}
	function list_module_showed($modid = 0)
	{
		$get_module = $this->get_module(array('parent_id' => $modid, 'published' => 'y'), 'mod_alias');

		$count_showed = 0;
		if($get_module->num_rows() > 0)
		{
			foreach($get_module->result() as $val)
			{
				if($this->mod_access($val->mod_alias) == TRUE)
				{
					$count_showed = $count_showed + 1;
				}
			}
		}

		return $count_showed;
	}
	
	function list_module($parent_id = 0, $modid = '')
	{
		$get_module = $this->get_module(array('parent_id' => $parent_id, 'published' => 'y'));
		$template   = NULL;
		
		$controller = $this->uri->segment(1);

		if($parent_id == 0)
		{
			$template .= '<ul>';

			if($controller == 'home')
			{
				$active = 'class="active"';
			}

			$template .= '<li><a href="'.site_url('home').'" class="'.($controller == 'home' ? 'active' : '').'"><i class="md md-home"></i><span>Dashboard</span></a></li>';
		}
		else
		{
			$template .= '<li>';
		} 

		if($get_module->num_rows())
		{
			foreach($get_module->result() as $val)
			{
				$active 	= NULL;
				$get_sub_module = $this->get_module(array('parent_id' => $val->modid));

				$count_showed = $this->list_module_showed($val->modid);

				$template .= ($get_sub_module->num_rows() > 0 && $count_showed > 0) ? '<li>' : NULL;

				if($get_sub_module->num_rows() > 0 && $count_showed > 0 && $val->parent_id == 0)
				{
					if($val->permalink)
					{
						$template .= anchor($val->permalink, '<i class="'.$val->icon.'"></i> <span>'.$val->mod_name.'</span>', $active);
					}
					else
					{
						$template .= '<span>'.$val->mod_name.'</span>';
					}
				}

				if($this->mod_access($val->mod_alias) == TRUE)
				{
					if($get_sub_module->num_rows() == 0)
					{
						if($modid == $val->modid)
						{
							$active = ' class="active"';
						}
						$template .= '<li>';	
					}
					else
					{
						if($modid == $val->modid)
						{
							$active = ' active';
						}
						$template .= '<li class="panel">';	
					}
					
					$template .= anchor($val->permalink, '<i class="'.$val->icon.'"></i> <span>'.$val->mod_name.'</span>', $active);
					
					$template .= '</li>';
				}

				if($get_sub_module->num_rows() > 0)
				{
					$template .= $this->list_module($val->modid, $modid);
				}

				$template .= ($get_sub_module->num_rows() > 0 && $count_showed > 0) ? '</li>' : NULL;
			}
		}

		$template .= '</ul>';

		return $template;

	}
	
	function role_mod($role = 'view', $show_role = FALSE)
	{
		$data_user = $this->active_user();

		$roles = json_decode($data_user->role);


		switch($role)
		{
			case 'create':
			$role = explode(',', $roles->create);
			break;
			case 'alter':
			$role = explode(',', $roles->alter);
			break;
			case 'drop':
			$role = explode(',', $roles->drop);
			break;
			default:
			$role = explode(',', $roles->view);
		}

		if(is_array($role))
		{
			foreach($role as $val)
			{
				$get_mod = $this->get_table('module', array('modid' => $val), 'mod_alias' );

				if($get_mod->num_rows() == 1)
				{
					$role_mod[$val] = $get_mod->row()->mod_alias;
				}
			}
		}

		return $role_mod;
	}

	function mod_access($alias = '', $role = 'view')
	{
		$access = FALSE;
		$role_mod = $this->role_mod($role);

		if(is_array($role_mod) && in_array($alias, $role_mod))
		{
			$access = TRUE;
		}

		return $access;
	}

	function blocked_page($alias = '', $role = 'view')
	{
		if(!$alias)
		{
			return show_404();
		}

		if($this->mod_access($alias, $role) == FALSE )
		{
			return show_error("You don't have permission to access <strong>".current_url()."</strong> on this server.", 403, 'Forbidden');
		}
	}

	// DATATABLE QUERY
  private function _get_datatables_query()
    {

        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
    	
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
	function json_msg($type = 'success', $msg = '', $url = '')
	{

		$data = json_encode(['status' => $type, 'message' => $msg, 'redirect' => $url]);
		$offset = 60 * 60;
		$expire = "expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
		header('HTTP/1.0 200 OK');
		header('HTTP/1.1 200 OK');
		header('Server: EUIS GEULIS');
		header('Content-Encoding: gz');
		header("Content-Type: application/json; charset=utf-8");
		header("Cache-Control: private, no-cache, no-store, must-revalidate");
		header( $expire );
		header('Vary: Accept-Encoding');
		header('Pragma: no-cache');
		return trim($data);
	}


    function send_sms($to, $body ) {


    	if(is_array($to) >0){
    		for ($i=0; $i < sizeof($to); $i++) { 
    			$data[] = array(
    			'device' => $this->device_id
    			,'number' => $to[$i]
    			,'body' => $body
    			);
    		}		

    		$result = $this->sendManyMessages($data);

    	}
    	else{

    		$result = $this->sendMessageToNumber($to, $body, $this->device_id);
    	}


    }
  


    private function makeRequest ($url, $method, $fields= array()) {

    	$fields['email'] = $this->email_gateway ;
    	$fields['password'] = $this->password_gateway ;

  		
    	$url = 'https://smsgateway.me'.$url;

    	$fieldsString = http_build_query($fields);


    	$ch = curl_init();

    	if($method == 'POST')
    	{
    		curl_setopt($ch,CURLOPT_POST, count($fields));
    		curl_setopt($ch,CURLOPT_POSTFIELDS, $fieldsString);
    	}
    	else
    	{
    		$url .= '?'.$fieldsString;
    	}

    	curl_setopt($ch, CURLOPT_URL,$url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_HEADER , false);  // we want headers
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $result = curl_exec ($ch);

            $return['response'] = json_decode($result,true);

            if($return['response'] == false)
            	$return['response'] = $result;

            $return['status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close ($ch);

            return $return;
        }


	 	function sendMessageToNumber($to, $message, $device, $options=array()) {
            $query = array_merge(array('number'=>$to, 'message'=>$message, 'device' => $device), $options);
            return $this->makeRequest('/api/v3/messages/send','POST',$query);
        }

        function sendMessageToManyNumbers ($to, $message, $device, $option=array()) {
            $query = array_merge(array('number'=>$to, 'message'=>$message, 'device' => $device), $options);
            return $this->makeRequest('/api/v3/messages/send','POST', $query);
        }

        function sendMessageToContact ($to, $message, $device, $option=array()) {
            $query = array_merge(array('contact'=>$to, 'message'=>$message, 'device' => $device), $options);
            return $this->makeRequest('/api/v3/messages/send','POST', $query);
        }

        function sendMessageToManyContacts ($to, $message, $device, $option=array()) {
            $query = array_merge(array('contact'=>$to, 'message'=>$message, 'device' => $device), $options);
            return $this->makeRequest('/api/v3/messages/send','POST', $query);
        }

        function sendManyMessages ($data) {
            $query['data'] = $data;
            return $this->makeRequest('/api/v3/messages/send','POST', $query);
        }




    }