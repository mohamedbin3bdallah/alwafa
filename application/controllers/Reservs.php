<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservs extends CI_Controller {

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

	function __construct()
    {
		parent::__construct();
	    if(!$this->session->userdata('uid'))
	    { 
			redirect('home');
	    }
		else
		{
			$this->loginuser = $this->Admin_mo->getrowjoinLeftLimit('users.*,usertypes.utprivileges as privileges','users',array('usertypes'=>'users.uutid=usertypes.utid'),array('users.uid'=>$this->session->userdata('uid')),'');
			$this->sections = array();
			$sections = $this->Admin_mo->getwhere('sections',array('scactive'=>'1'));
			if(!empty($sections))
			{
				foreach($sections as $section) { $this->sections[$section->scid] = $section->sccode; }
			}
		}
	}

	public function index()
	{
		if(strpos($this->loginuser->privileges, ',rssee,') !== false && in_array('RS',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$this->lang->load('reservs', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid]['name'] = $employee->uname; $data['employees'][$employee->uid]['email'] = $employee->uemail; $data['employees'][$employee->uid]['phone'] = $employee->uphone; $data['employees'][$employee->uid]['type'] = $employee->utype; }
		$data['reservs'] = $this->Admin_mo->getjoinLeft('reservs.*,doctors.drid as drid,doctors.drtitle as drtitle,departs.dpid as dpid,departs.dptitle as dptitle','reservs',array('doctors'=>'doctors.drid=reservs.rsdrid','departs'=>'departs.dpid=reservs.rsdpid'),array());
		$this->load->view('calenderdate');
		$this->load->view('headers/reservs',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/reservs',$data);
		$this->load->view('footers/reservs');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'reservs';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('reservs', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/reservs',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/reservs');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function getdoctors()
	{
		echo '<select name="doctor" class="form-control" required="required"><option value="">اختر</option>';
		$day = strtolower(date("D", strtotime($_POST['date'])));
		$time = date("H:i", strtotime($_POST['date']));
		$doctors = $this->Admin_mo->getjoinR('doctors.*','doctors',array('doctorappoints'=>'doctorappoints.dadrid=doctors.drid'),array('doctors.drdpid'=>$_POST['id'],'doctors.dractive'=>'1','doctorappoints.daday'=>$day,'doctorappoints.dafrom <'=>$time,'doctorappoints.dato >'=>$time));
		if(!empty($doctors))
		{
			foreach($doctors as $doctor)
			{
				echo '<option value="'.$doctor->drid.'">'.$doctor->drtitle.'</option>';
			}
		}
		echo '</select>';
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',rsedit,') !== false && in_array('RS',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$this->lang->load('reservs', 'arabic');
		$id = abs((int)($id));
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['reserv'] = $this->Admin_mo->getrow('reservs',array('rsid'=>$id));
		if(!empty($data['reserv']))
		{
			$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid]['name'] = $employee->uname; $data['employees'][$employee->uid]['email'] = $employee->uemail; $data['employees'][$employee->uid]['phone'] = $employee->uphone; $data['employees'][$employee->uid]['type'] = $employee->utype; }
			if(in_array('DP',$this->sections))
			{
				$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
				if(in_array('DR',$this->sections)) $data['doctors'] = $this->Admin_mo->getwhere('doctors',array('drdpid'=>$data['reserv']->rsdpid,'dractive'=>'1'));
			}
			$this->load->view('headers/reserv-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/reserv-edit',$data);
			$this->load->view('footers/reserv-edit');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'reservs';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/reservs',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/reservs');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'reservs';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('reservs', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/reservs',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/reservs');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function editreserv($id)
	{
		if(strpos($this->loginuser->privileges, ',rsedit,') !== false && in_array('RS',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('date', 'اليوم' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('notes', 'الملاحظات' , 'trim|required');
			if(in_array('DP',$this->sections))
			{
				$this->form_validation->set_rules('depart', 'القسم' , 'trim|required|max_length[255]');
				if(in_array('DR',$this->sections)) $this->form_validation->set_rules('doctor', 'الطبيب' , 'trim|required|max_length[255]');
			}
			if($this->form_validation->run() == FALSE)
			{
				$this->load->library('notifications');
				$data = $this->notifications->notifys($this->session->userdata('uid'));
				$this->lang->load('gallery', 'arabic');
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['reserv'] = $this->Admin_mo->getrow('reservs',array('rsid'=>$id));
				$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid]['name'] = $employee->uname; $data['employees'][$employee->uid]['email'] = $employee->uemail; $data['employees'][$employee->uid]['phone'] = $employee->uphone; $data['employees'][$employee->uid]['type'] = $employee->utype; }
				if(in_array('DP',$this->sections))
				{
					$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
					if(in_array('DR',$this->sections)) $data['doctors'] = $this->Admin_mo->getwhere('doctors',array('drdpid'=>$data['reserv']->rsdpid,'dractive'=>'1'));
				}
				$this->load->view('headers/reserv-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/reserv-edit',$data);
				$this->load->view('footers/reserv-edit');
				$this->load->view('notifys');
				$this->load->view('messages');
			}
			else
			{
				$this->load->library('notifications');
				$update_array = array('rsuid'=>$this->session->userdata('uid'), 'rsdate'=>strtotime(set_value('date')), 'rsnotes'=>set_value('notes'), 'rstime'=>time());
				if(in_array('DP',$this->sections))
				{
					$update_array['rsdpid'] = set_value('depart');
					if(in_array('DR',$this->sections)) $update_array['rsdrid'] = set_value('doctor');
				}
				if($this->Admin_mo->update('reservs', $update_array, array('rsid'=>$id)))
				{
					$this->notifications->addNotify($this->session->userdata('uid'),'RS',' عدل الحجز  ','inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,rssee,%" or usertypes.utprivileges like "%,rsedit,%")');
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				}
				redirect('reservs', 'refresh');
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('reservs', 'refresh');
		}
		//redirect('reservs', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'reservs';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('reservs', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/reservs',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/reservs');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',rsdelete,') !== false && in_array('RS',$this->sections))
		{
		$reserv = $this->Admin_mo->getrow('reservs', array('rsid'=>$id));
		if(!empty($reserv))
		{
			$this->load->library('notifications');
			$this->Admin_mo->del('reservs', array('rsid'=>$id));
			$this->notifications->addNotify($this->session->userdata('uid'),'RS',' حذف الحجز  '.$reserv->rsid,'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,rssee,%" or usertypes.utprivileges like "%,rsdelete,%")');
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('reservs', 'refresh');
		}
		else
		{
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$data['title'] = 'reservs';
			$data['admessage'] = 'youhavenoprivls';
			$this->lang->load('reservs', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$this->load->view('headers/reservs',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/reservs');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'reservs';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('reservs', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/reservs',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/reservs');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
}