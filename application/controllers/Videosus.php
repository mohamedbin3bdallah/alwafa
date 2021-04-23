<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videosus extends CI_Controller {

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
		if(strpos($this->loginuser->privileges, ',vdsee,') !== false && in_array('VD',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$this->lang->load('videos', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		$data['videos'] = $this->Admin_mo->get('videos');
		$this->load->view('calenderdate');
		//$data['users'] = $this->Admin_mo->rate('*','users',' where id <> 1');
		$this->load->view('headers/videos',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/videos',$data);
		$this->load->view('footers/videos');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'videos';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('videos', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/videos',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/videos');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',vdadd,') !== false && in_array('VD',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$this->lang->load('videos', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		//$data['users'] = $this->Admin_mo->get('users');
		$this->load->view('headers/video-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/video-add',$data);
		$this->load->view('footers/video-add');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'videos';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('videos', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/videos',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/videos');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',vdadd,') !== false && in_array('VD',$this->sections))
		{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('title', 'العنوان' , 'trim|required|max_length[255]');
		$this->form_validation->set_rules('desc', 'الوصف' , 'trim|required');
		$this->form_validation->set_rules('link', 'رابط اليوتيوب' , 'trim|required|valid_url|callback_youtubeURL');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$this->lang->load('videos', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$this->load->view('headers/video-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/video-add',$data);
			$this->load->view('footers/video-add');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$this->load->library('notifications');
			$set_arr = array('vduid'=>$this->session->userdata('uid'), 'vdtitle'=>set_value('title'), 'vddesc'=>set_value('desc'), 'vdlink'=>set_value('link'), 'vdactive'=>set_value('active'), 'vdtime'=>time());
			$vdid = $this->Admin_mo->set('videos', $set_arr);
			if(empty($vdid))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('videosus/add', 'refresh');
			}
			else
			{
				$this->notifications->addNotify($this->session->userdata('uid'),'VD',' اضاف فيديو '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,vdsee,%" or usertypes.utprivileges like "%,vdadd,%")');
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('videosus', 'refresh');
			}
		}
		//redirect('videosus/add', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'videos';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('videos', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/videos',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/videos');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',vdedit,') !== false && in_array('VD',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$this->lang->load('videos', 'arabic');
		$id = abs((int)($id));
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['video'] = $this->Admin_mo->getrow('videos',array('vdid'=>$id));
		if(!empty($data['video']))
		{
			$this->load->view('headers/video-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/video-edit',$data);
			$this->load->view('footers/video-edit');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'videos';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/videos',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/videos');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'videos';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('videos', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/videos',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/videos');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function editvideo($id)
	{
		if(strpos($this->loginuser->privileges, ',vdedit,') !== false && in_array('VD',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('title', 'العنوان' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('desc', 'الوصف' , 'trim|required');
			$this->form_validation->set_rules('link', 'رابط اليوتيوب' , 'trim|required|valid_url|callback_youtubeURL');
			if($this->form_validation->run() == FALSE)
			{
				$this->load->library('notifications');
				$data = $this->notifications->notifys($this->session->userdata('uid'));
				$this->lang->load('videos', 'arabic');
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['video'] = $this->Admin_mo->getrow('videos',array('vdid'=>$id));
				$this->load->view('headers/video-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/video-edit',$data);
				$this->load->view('footers/video-edit');
				$this->load->view('notifys');
				$this->load->view('messages');
			}
			else
			{
				$this->load->library('notifications');
				$update_array = array('vduid'=>$this->session->userdata('uid'), 'vdtitle'=>set_value('title'), 'vddesc'=>set_value('desc'), 'vdlink'=>set_value('link'), 'vdactive'=>set_value('active'), 'vdtime'=>time());
				if($this->Admin_mo->update('videos', $update_array, array('vdid'=>$id)))
				{
					$this->notifications->addNotify($this->session->userdata('uid'),'VD',' عدل الفيديو  '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,vdsee,%" or usertypes.utprivileges like "%,vdedit,%")');
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				}
				redirect('videosus', 'refresh');
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('videosus', 'refresh');
		}
		//redirect('videosus', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'videos';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('videos', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/videos',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/videos');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',vddelete,') !== false && in_array('VD',$this->sections))
		{
		$video = $this->Admin_mo->getrow('videos', array('vdid'=>$id));
		if(!empty($video))
		{
			$this->load->library('notifications');
			$this->Admin_mo->del('videos', array('vdid'=>$id));
			$this->notifications->addNotify($this->session->userdata('uid'),'VD',' حذف فيديو  '.$video->vdtitle,'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,vdsee,%" or usertypes.utprivileges like "%,vddelete,%")');
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('videosus', 'refresh');
		}
		else
		{
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$data['title'] = 'videos';
			$data['admessage'] = 'youhavenoprivls';
			$this->lang->load('videos', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$this->load->view('headers/videos',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/videos');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'videos';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('videos', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/videos',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/videos');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function youtubeURL($youtube_url)
	{
		$regex_pattern = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/";
		$match;

		if(preg_match($regex_pattern, $youtube_url, $match))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}