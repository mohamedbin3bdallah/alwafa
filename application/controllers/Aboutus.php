<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aboutus extends CI_Controller {

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
		if(strpos($this->loginuser->privileges, ',absee,') !== false && in_array('AB',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$this->lang->load('about', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		$data['abouts'] = $this->Admin_mo->get('about');
		$this->load->view('calenderdate');
		//$data['users'] = $this->Admin_mo->rate('*','users',' where id <> 1');
		$this->load->view('headers/about',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/about',$data);
		$this->load->view('footers/about');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'about';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('about', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/about',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/about');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',abadd,') !== false && in_array('AB',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$this->lang->load('about', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		//$data['users'] = $this->Admin_mo->get('users');
		$this->load->view('headers/about-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/about-add',$data);
		$this->load->view('footers/about-add');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'about';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('about', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/about',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/about');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',abadd,') !== false && in_array('AB',$this->sections))
		{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('title', 'العنوان' , 'trim|required|max_length[255]');
		$this->form_validation->set_rules('desc', 'الوصف' , 'trim|required');
		$this->form_validation->set_rules('page', 'صفحة الواجهة' , 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$this->lang->load('about', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$this->load->view('headers/about-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/about-add',$data);
			$this->load->view('footers/about-add');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$this->load->library('notifications');
			$set_arr = array('abuid'=>$this->session->userdata('uid'), 'abtitle'=>set_value('title'), 'abdesc'=>set_value('desc'), 'abpage'=>set_value('page'), 'abactive'=>set_value('active'), 'abtime'=>time());
			if(set_value('icon') != '' && set_value('page') == 'الرسائل') $set_arr['abicon'] = set_value('icon');
			$abid = $this->Admin_mo->set('about', $set_arr);
			if(empty($abid))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('aboutus/add', 'refresh');
			}
			else
			{
				$this->notifications->addNotify($this->session->userdata('uid'),'AB',' اضاف سجل في صفحة عنا '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,absee,%" or usertypes.utprivileges like "%,abadd,%")');
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('aboutus', 'refresh');
			}
		}
		//redirect('about/add', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'about';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('about', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/about',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/about');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',abedit,') !== false && in_array('AB',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$this->lang->load('about', 'arabic');
		$id = abs((int)($id));
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['about'] = $this->Admin_mo->getrow('about',array('abid'=>$id));
		if(!empty($data['about']))
		{
			$this->load->view('headers/about-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/about-edit',$data);
			$this->load->view('footers/about-edit');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'about';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/about',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/about');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'about';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('about', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/about',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/about');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function editabout($id)
	{
		if(strpos($this->loginuser->privileges, ',abedit,') !== false && in_array('AB',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('title', 'العنوان' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('desc', 'الوصف' , 'trim|required');
			$this->form_validation->set_rules('page', 'صفحة الواجهة' , 'trim|required');
			if($this->form_validation->run() == FALSE)
			{
				$this->load->library('notifications');
				$data = $this->notifications->notifys($this->session->userdata('uid'));
				$this->lang->load('about', 'arabic');
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['about'] = $this->Admin_mo->getrow('about',array('abid'=>$id));
				$this->load->view('headers/about-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/about-edit',$data);
				$this->load->view('footers/about-edit');
				$this->load->view('notifys');
				$this->load->view('messages');
			}
			else
			{
				$this->load->library('notifications');
				$update_array = array('abuid'=>$this->session->userdata('uid'), 'abtitle'=>set_value('title'), 'abdesc'=>set_value('desc'), 'abpage'=>set_value('page'), 'abactive'=>set_value('active'), 'abtime'=>time());
				if(set_value('icon') != '' && set_value('page') == 'الرسائل') $update_array['abicon'] = set_value('icon');
				if($this->Admin_mo->update('about', $update_array, array('abid'=>$id)))
				{
					$this->notifications->addNotify($this->session->userdata('uid'),'AB',' عدل على سجل في صفحة عنا  '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,absee,%" or usertypes.utprivileges like "%,abedit,%")');
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				}
				redirect('aboutus', 'refresh');
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('aboutus', 'refresh');
		}
		//redirect('aboutus', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'about';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('about', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/about',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/about');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',abdelete,') !== false && in_array('AB',$this->sections))
		{
		$about = $this->Admin_mo->getrow('about', array('abid'=>$id));
		if(!empty($about))
		{
			$this->load->library('notifications');
			$this->Admin_mo->del('about', array('abid'=>$id));
			$this->notifications->addNotify($this->session->userdata('uid'),'AB',' حذف سجل على صفحة عنا  '.$about->abtitle,'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,absee,%" or usertypes.utprivileges like "%,abdelete,%")');
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('aboutus', 'refresh');
		}
		else
		{
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$data['title'] = 'about';
			$data['admessage'] = 'youhavenoprivls';
			$this->lang->load('about', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$this->load->view('headers/about',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/about');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'about';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('about', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/about',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/about');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
}