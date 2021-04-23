<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctors extends CI_Controller {

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
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'doctors';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('doctors', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/doctors',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/doctors');
		$this->load->view('notifys');
		$this->load->view('messages');
	}

	public function depart($id)
	{
		if(strpos($this->loginuser->privileges, ',drsee,') !== false && in_array('DR',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$data['id'] = abs((int)($id));
		$this->lang->load('doctors', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		//$data['doctors'] = $this->Admin_mo->getwhere('doctors',array('drdpid'=>$data['id']));
		$doctors = $this->Admin_mo->getjoinR('doctors.*,doctorappoints.*','doctors',array('doctorappoints'=>'doctorappoints.dadrid=doctors.drid'),array('doctors.drdpid'=>$data['id']));
		if(!empty($doctors))
		{
			for($i=0;$i<count($doctors);$i++)
			{
				$data['doctors'][$doctors[$i]->drid]['id'] = $doctors[$i]->drid;
				$data['doctors'][$doctors[$i]->drid]['uid'] = $doctors[$i]->druid;
				$data['doctors'][$doctors[$i]->drid]['title'] = $doctors[$i]->drtitle;
				$data['doctors'][$doctors[$i]->drid]['desc'] = $doctors[$i]->drdesc;
				$data['doctors'][$doctors[$i]->drid]['phone'] = $doctors[$i]->drphone;
				$data['doctors'][$doctors[$i]->drid]['active'] = $doctors[$i]->dractive;
				$data['doctors'][$doctors[$i]->drid]['time'] = $doctors[$i]->drtime;
				$data['doctors'][$doctors[$i]->drid]['appoints'][$i]['day'] = $doctors[$i]->daday;
				$data['doctors'][$doctors[$i]->drid]['appoints'][$i]['from'] = $doctors[$i]->dafrom;
				$data['doctors'][$doctors[$i]->drid]['appoints'][$i]['to'] = $doctors[$i]->dato;
			}
		}
		else $data['doctors'] = $doctors;
		$this->load->view('calenderdate');
		//$data['users'] = $this->Admin_mo->rate('*','users',' where id <> 1');
		$this->load->view('headers/doctors',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/doctors',$data);
		$this->load->view('footers/doctors');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'doctors';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('doctors', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/doctors',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/doctors');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function add($id)
	{
		if(strpos($this->loginuser->privileges, ',dradd,') !== false && in_array('DR',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$data['id'] = abs((int)($id));
		$this->lang->load('doctors', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		//$data['users'] = $this->Admin_mo->get('users');
		$this->load->view('headers/doctor-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/doctor-add',$data);
		$this->load->view('footers/doctor-add');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'doctors';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('doctors', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/doctors',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/doctors');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',dradd,') !== false && in_array('DR',$this->sections))
		{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('title', 'العنوان' , 'trim|required|max_length[255]|is_unique[doctors.drtitle]');
		$this->form_validation->set_rules('desc', 'الوصف' , 'trim|required');
		$this->form_validation->set_rules('mobile', 'الموبايل' , 'trim|max_length[50]|numeric');
		$this->form_validation->set_rules('day[]', 'اليوم' , 'trim|required');
		$this->form_validation->set_rules('from[]', 'من الوقت' , 'trim|required');
		$this->form_validation->set_rules('to[]', 'الى الوقت' , 'trim|required');
		$this->form_validation->set_rules('dpid', 'القسم' , 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$this->lang->load('doctors', 'arabic');
			$data['id'] = set_value('dpid');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$this->load->view('headers/doctor-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/doctor-add',$data);
			$this->load->view('footers/doctor-add');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$this->load->library('notifications');
			$set_arr = array('drdpid'=>set_value('dpid'), 'druid'=>$this->session->userdata('uid'), 'drtitle'=>set_value('title'), 'drdesc'=>set_value('desc'), 'drphone'=>set_value('mobile'), 'dractive'=>set_value('active'), 'drtime'=>time());
			$drid = $this->Admin_mo->set('doctors', $set_arr);
			if(empty($drid))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('doctors/add/'.set_value('dpid'), 'refresh');
			}
			else
			{
				for($i=0;$i<count(set_value('day'));$i++)
				{
					$this->Admin_mo->set('doctorappoints', array('dadrid'=>$drid,'daday'=>set_value('day')[$i],'dafrom'=>set_value('from')[$i],'dato'=>set_value('to')[$i]));
				}
				$this->Admin_mo->update('departs', array('child'=>'1'), array('dpid'=>set_value('dpid')));
				$this->notifications->addNotify($this->session->userdata('uid'),'DR',' اضاف الطبيب '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,drsee,%" or usertypes.utprivileges like "%,dradd,%")');
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('doctors/depart/'.set_value('dpid'), 'refresh');
			}
		}
		//redirect('doctors/add', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'doctors';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('doctors', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/doctors',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/doctors');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',dredit,') !== false && in_array('DR',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$this->lang->load('doctors', 'arabic');
		$id = abs((int)($id));
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$doctor = $this->Admin_mo->getjoinR('doctors.*,doctorappoints.*','doctors',array('doctorappoints'=>'doctorappoints.dadrid=doctors.drid'),array('doctors.drid'=>$id));
		if(!empty($doctor))
		{
			for($i=0;$i<count($doctor);$i++)
			{
				$data['doctor']['id'] = $doctor[$i]->drid;
				$data['doctor']['uid'] = $doctor[$i]->druid;
				$data['doctor']['title'] = $doctor[$i]->drtitle;
				$data['doctor']['desc'] = $doctor[$i]->drdesc;
				$data['doctor']['phone'] = $doctor[$i]->drphone;
				$data['doctor']['active'] = $doctor[$i]->dractive;
				$data['doctor']['time'] = $doctor[$i]->drtime;
				$data['doctor']['appoints'][$i]['day'] = $doctor[$i]->daday;
				$data['doctor']['appoints'][$i]['from'] = $doctor[$i]->dafrom;
				$data['doctor']['appoints'][$i]['to'] = $doctor[$i]->dato;
			}
			$this->load->view('headers/doctor-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/doctor-edit',$data);
			$this->load->view('footers/doctor-edit');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'doctors';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/doctors',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/doctors');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'doctors';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('doctors', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/doctors',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/doctors');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function editdoctor($id)
	{
		if(strpos($this->loginuser->privileges, ',dredit,') !== false && in_array('DR',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('title', 'العنوان' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('desc', 'الوصف' , 'trim|required');
			$this->form_validation->set_rules('mobile', 'الموبايل' , 'trim|max_length[50]|numeric');
			$this->form_validation->set_rules('day[]', 'اليوم' , 'trim|required');
			$this->form_validation->set_rules('from[]', 'من الوقت' , 'trim|required');
			$this->form_validation->set_rules('to[]', 'الى الوقت' , 'trim|required');
			if($this->form_validation->run() == FALSE)
			{
				$this->load->library('notifications');
				$data = $this->notifications->notifys($this->session->userdata('uid'));
				$this->lang->load('doctors', 'arabic');
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['doctor'] = $this->Admin_mo->getrow('doctors',array('drid'=>$id));
				$this->load->view('headers/doctor-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/doctor-edit',$data);
				$this->load->view('footers/doctor-edit');
				$this->load->view('notifys');
				$this->load->view('messages');
			}
			else
			{
				if($this->Admin_mo->exist('doctors','where drid <> '.$id.' and drtitle like "'.set_value('title').'"',''))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'nameexist';
					redirect('doctors/edit/'.$id, 'refresh');
				}
				else
				{
					$this->load->library('notifications');
					$update_array = array('druid'=>$this->session->userdata('uid'), 'drtitle'=>set_value('title'), 'drdesc'=>set_value('desc'), 'drphone'=>set_value('mobile'), 'dractive'=>set_value('active'), 'drtime'=>time());
					if($this->Admin_mo->update('doctors', $update_array, array('drid'=>$id)))
					{
						$this->Admin_mo->del('doctorappoints', array('dadrid'=>$id));
						for($i=0;$i<count(set_value('day'));$i++)
						{
							$this->Admin_mo->set('doctorappoints', array('dadrid'=>$id,'daday'=>set_value('day')[$i],'dafrom'=>set_value('from')[$i],'dato'=>set_value('to')[$i]));
						}
						$this->notifications->addNotify($this->session->userdata('uid'),'DR',' عدل الطبيب  '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,drsee,%" or usertypes.utprivileges like "%,dredit,%")');
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					}
					else
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					}
					redirect('departs/', 'refresh');
				}
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('doctors', 'refresh');
		}
		//redirect('doctors', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'doctors';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('doctors', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/doctors',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/doctors');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',drdelete,') !== false && in_array('DR',$this->sections))
		{
		$doctor = $this->Admin_mo->getrow('doctors', array('drid'=>$id));
		if(!empty($doctor))
		{
			$this->load->library('notifications');
			$this->Admin_mo->del('doctors', array('drid'=>$id));
			$this->Admin_mo->del('doctorappoints', array('dadrid'=>$id));
			if($this->Admin_mo->exist('doctors','where drdpid = '.$doctor->drdpid,'') == 0) $this->Admin_mo->update('departs', array('child'=>'0'), array('dpid'=>$doctor->drdpid));
			$this->notifications->addNotify($this->session->userdata('uid'),'DR',' حذف الطبيب '.$doctor->drtitle,'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,drsee,%" or usertypes.utprivileges like "%,drdelete,%")');
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('departs', 'refresh');
		}
		else
		{
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$data['title'] = 'doctors';
			$data['admessage'] = 'youhavenoprivls';
			$this->lang->load('doctors', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$this->load->view('headers/doctors',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/doctors');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'doctors';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('doctors', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/doctors',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/doctors');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
}