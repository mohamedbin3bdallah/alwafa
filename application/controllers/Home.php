<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if($this->session->userdata('uid') != FALSE)
		{
			$this->loginuser = $this->Admin_mo->getrowjoinLeftLimit('users.*,usertypes.utprivileges as privileges','users',array('usertypes'=>'users.uutid=usertypes.utid'),array('users.uid'=>$this->session->userdata('uid')),'');
			$this->sections = array();
			$sections = $this->Admin_mo->getwhere('sections',array('scactive'=>'1'));
			if(!empty($sections))
			{
				foreach($sections as $section) { $this->sections[$section->scid] = $section->sccode; }
			}
			$this->load->library('arabictools');
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$data['admessage'] = '';
			$this->lang->load('home', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$calender = array('ar'=>'date','hj'=>'hdate');
			$currentyear = $this->arabictools->arabicDate($data['system']->calendar.' Y', time());

			$data['activesections'] = array(0=>array('name'=>'','count'=>0),1=>array('name'=>'','count'=>0),2=>array('name'=>'','count'=>0),3=>array('name'=>'','count'=>0),4=>array('name'=>'','count'=>0));
			$cprepare = $this->Admin_mo->rate('logsystem.section as name,COUNT(logsystem.id) as count','logsystem','GROUP BY logsystem.section limit 5');
			foreach ($cprepare as $ckey => $cvalue)
			{
				$data['activesections'][$ckey]['name'] = $cvalue->name;
				$data['activesections'][$ckey]['count'] = $cvalue->count;
			}
			
			$data['activeusers'] = array(0=>array('name'=>'','count'=>0),1=>array('name'=>'','count'=>0),2=>array('name'=>'','count'=>0),3=>array('name'=>'','count'=>0),4=>array('name'=>'','count'=>0));
			$uprepare = $this->Admin_mo->rate('users.uname as name,COUNT(logsystem.id) as count','logsystem','LEFT OUTER JOIN users ON users.uid = logsystem.user GROUP BY logsystem.user limit 5');
			foreach ($uprepare as $ukey => $uvalue)
			{
				$data['activeusers'][$ukey]['name'] = $uvalue->name;
				$data['activeusers'][$ukey]['count'] = $uvalue->count;
			}

			$data['users'] = $this->Admin_mo->get('users');		
			$this->load->view('headers/home',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/home',$data);
			$this->load->view('footers/home');
			$this->load->view('notifys');
		}
		else
		{
			$data['message'] = '';
			$this->lang->load('home', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			//$this->lang->load('nemu', 'arabic');
			$this->load->view('headers/login',$data);
			$this->load->view('admin/login',$data);
			$this->load->view('footers/login');
		}
	}
	
	public function login()
	{
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->form_validation->set_rules('username', 'Username' , 'trim|required|alpha');
		$this->form_validation->set_rules('password', 'Password' , 'required');
		if($this->form_validation->run() == FALSE)
		{
			$this->lang->load('home', 'arabic');
			$data['message'] = 'all_inputs_required';
			$this->load->view('headers/login',$data);
			$this->load->view('admin/login',$data);
			$this->load->view('footers/login');
		}
		else
		{
			$data['result'] = $this->Admin_mo->getrow('users', array('username'=>set_value('username')));
			if(empty($data['result'])) 
			{
				$this->lang->load('home', 'arabic');
				$data['message'] = 'user_not_exist';
				$this->load->view('headers/login',$data);
				$this->load->view('admin/login',$data);
				$this->load->view('footers/login');
			}
			elseif(!password_verify(set_value('password'), $data['result']->upassword))
			{
				$this->lang->load('home', 'arabic');
				$data['message'] = 'wrong_password';
				$this->load->view('headers/login',$data);
				$this->load->view('admin/login',$data);
				$this->load->view('footers/login');
			}
			elseif($data['result']->uactive != '1')
			{
				$this->lang->load('home', 'arabic');
				$data['message'] = 'account_ot_Active';
				$this->load->view('headers/login',$data);
				$this->load->view('admin/login',$data);
				$this->load->view('footers/login');
			}
			else
			{
				$this->session->set_userdata('uid', $data['result']->uid);
				redirect('home', 'refresh');
			}
		}
	}
	
	public function logout()
	{
		unset(
			$_SESSION['uid']
		);
		redirect('home', 'refresh');
	}
	
	public function read()
	{
		$this->Admin_mo->updateM1('logsystem',array('seen'=>'1'),'notifyuser = '.$this->session->userdata('uid'));
	}
}
