<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends CI_Controller {

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
		$data['title'] = 'contact';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('contact', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/contact',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/contact');
		$this->load->view('notifys');
		$this->load->view('messages');
	}

	public function contact()
	{
		if(strpos($this->loginuser->privileges, ',ctedit,') !== false && in_array('CT',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$this->lang->load('contact', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
		//$data['users'] = $this->Admin_mo->get('users');
		$this->load->view('headers/contact',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/contact',$data);
		$this->load->view('footers/contact');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'contact';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('contact', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/contact',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/contact');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function contactedit()
	{
		if(strpos($this->loginuser->privileges, ',ctedit,') !== false && in_array('CT',$this->sections))
		{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('address', 'العنوان' , 'trim');
		$this->form_validation->set_rules('phone', 'الهاتف' , 'trim|max_length[255]');
		$this->form_validation->set_rules('mobile', 'الموبايل' , 'trim|max_length[255]');
		$this->form_validation->set_rules('email', 'البريد الالكتروني' , 'trim');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$this->lang->load('contact', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$this->load->view('headers/contact',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/contact',$data);
			$this->load->view('footers/contact');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$this->load->library('notifications');
			$update_array = array('ctuid'=>$this->session->userdata('uid'), 'ctaddress'=>set_value('address'), 'ctphone'=>set_value('phone'), 'ctmobile'=>set_value('mobile'), 'ctmap'=>set_value('map'), 'ctemail'=>set_value('email'), 'ctactive'=>set_value('active'), 'cttime'=>time());
			if($this->Admin_mo->update('contact', $update_array, array('ctid'=>'1')))
			{
				$this->notifications->addNotify($this->session->userdata('uid'),'CT',' عدل على بيانات التواصل '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and usertypes.utprivileges like "%,ctedit,%"');
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('contactus/contact', 'refresh');
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('contactus/contact', 'refresh');
			}
		}
		//redirect('about/add', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'contact';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('contact', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/contact',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/contact');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function socialmedia()
	{
		if(strpos($this->loginuser->privileges, ',smedit,') !== false && in_array('SM',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$this->lang->load('contact', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
		//$data['users'] = $this->Admin_mo->get('users');
		$this->load->view('headers/socialmedia',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/socialmedia',$data);
		$this->load->view('footers/socialmedia');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'socialmedia';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('contact', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/socialmedia',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/socialmedia');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function socialmediaedit()
	{
		if(strpos($this->loginuser->privileges, ',smedit,') !== false && in_array('SM',$this->sections))
		{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('facebook', 'فيسبوك' , 'trim|valid_url');
		$this->form_validation->set_rules('googleplus', 'جوجل بلاس' , 'trim|valid_url');
		$this->form_validation->set_rules('twitter', 'تويتر' , 'trim|valid_url');
		$this->form_validation->set_rules('instagram', 'انستجرام' , 'trim|valid_url');
		$this->form_validation->set_rules('youtube', 'يوتيوب' , 'trim|valid_url');
		$this->form_validation->set_rules('linkedin', 'لينكدان' , 'trim|valid_url');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$this->lang->load('contact', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$this->load->view('headers/socialmedia',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/socialmedia',$data);
			$this->load->view('footers/socialmedia');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$this->load->library('notifications');
			$update_array = array('smuid'=>$this->session->userdata('uid'), 'smfacebook'=>set_value('facebook'), 'smgoogleplus'=>set_value('googleplus'), 'smtwitter'=>set_value('twitter'), 'sminstagram'=>set_value('instagram'), 'smyoutube'=>set_value('youtube'), 'smlinkedin'=>set_value('linkedin'), 'smactive'=>set_value('active'), 'smtime'=>time());
			if($this->Admin_mo->update('contact', $update_array, array('ctid'=>'1')))
			{
				$this->notifications->addNotify($this->session->userdata('uid'),'SM',' عدل على وسائل الاعلام الاجتماعية ','inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and usertypes.utprivileges like "%,smedit,%"');
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('contactus/socialmedia', 'refresh');
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('contactus/socialmedia', 'refresh');
			}
		}
		//redirect('about/add', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'socialmedia';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('contact', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/socialmedia',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/socialmedia');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
}