<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slides extends CI_Controller {

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
		if(strpos($this->loginuser->privileges, ',sdsee,') !== false && in_array('SD',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$this->lang->load('slides', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		$data['slides'] = $this->Admin_mo->get('slides');
		$this->load->view('calenderdate');
		//$data['users'] = $this->Admin_mo->rate('*','users',' where id <> 1');
		$this->load->view('headers/slides',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/slides',$data);
		$this->load->view('footers/slides');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'slides';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('slides', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/slides',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/slides');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',sdadd,') !== false && in_array('SD',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$this->lang->load('slides', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		//$data['users'] = $this->Admin_mo->get('users');
		$this->load->view('headers/slide-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/slide-add',$data);
		$this->load->view('footers/slide-add');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'slides';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('slides', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/slides',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/slides');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',sdadd,') !== false && in_array('SD',$this->sections))
		{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('title', 'العنوان' , 'trim|max_length[150]');
		$this->form_validation->set_rules('desc', 'الوصف' , 'trim|max_length[255]');
		$this->form_validation->set_rules('link1', 'الرابط الاول' , 'trim');
		$this->form_validation->set_rules('title1', 'العنوان الاول' , 'trim|max_length[99]');
		$this->form_validation->set_rules('link2', 'الرابط الثاني' , 'trim');
		$this->form_validation->set_rules('title2', 'العنوان الثاني' , 'trim|max_length[99]');
		$this->form_validation->set_rules('file', 'الصورة' , 'callback_imageSize|callback_imageType');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$this->lang->load('slides', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$this->load->view('headers/album-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/album-add',$data);
			$this->load->view('footers/album-add');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$this->load->library('notifications');
			$set_arr = array('sduid'=>$this->session->userdata('uid'), 'sdtitle'=>set_value('title'), 'sddesc'=>set_value('desc'), 'sdlinkurl1'=>set_value('link1'), 'sdlinkalt1'=>set_value('title1'), 'sdlinkurl2'=>set_value('link2'), 'sdlinkalt2'=>set_value('title2'), 'sdactive'=>set_value('active'), 'sdtime'=>time());
			if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0)
			{
				//$newname = mt_rand();
				$file = $this->uploadimg('file', 'imgs/slides/', mt_rand());
				if($file)
				{
					$set_arr['sdimg'] = $file;
					$sdid = $this->Admin_mo->set('slides', $set_arr);
					if(empty($sdid))
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
						redirect('slides/add', 'refresh');
					}
					else
					{
						$this->notifications->addNotify($this->session->userdata('uid'),'SD',' اضاف الشريحة '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,sdsee,%" or usertypes.utprivileges like "%,sdadd,%")');
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
						redirect('slides', 'refresh');
					}
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					redirect('slides/add', 'refresh');
				}
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('slides/add', 'refresh');
			}		
		}
		//redirect('slides/add', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'slides';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('slides', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/slides',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/slides');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',sdedit,') !== false && in_array('SD',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$this->lang->load('slides', 'arabic');
		$id = abs((int)($id));
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['slide'] = $this->Admin_mo->getrow('slides',array('sdid'=>$id));
		if(!empty($data['slide']))
		{
			$this->load->view('headers/slide-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/slide-edit',$data);
			$this->load->view('footers/slide-edit');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'slides';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/slides',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/slides');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'slides';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('slides', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/slides',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/slides');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function editslide($id)
	{
		if(strpos($this->loginuser->privileges, ',sdedit,') !== false && in_array('SD',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('title', 'العنوان' , 'trim|max_length[150]');
			$this->form_validation->set_rules('desc', 'الوصف' , 'trim|max_length[255]');
			$this->form_validation->set_rules('link1', 'الرابط الاول' , 'trim');
			$this->form_validation->set_rules('title1', 'العنوان الاول' , 'trim|max_length[99]');
			$this->form_validation->set_rules('link2', 'الرابط الثاني' , 'trim');
			$this->form_validation->set_rules('title2', 'العنوان الثاني' , 'trim|max_length[99]');
			if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0) $this->form_validation->set_rules('file', 'الصورة' , 'callback_imageSize|callback_imageType');
			if($this->form_validation->run() == FALSE)
			{
				$this->load->library('notifications');
				$data = $this->notifications->notifys($this->session->userdata('uid'));
				$this->lang->load('slides', 'arabic');
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['slide'] = $this->Admin_mo->getrow('slides',array('sdid'=>$id));
				$this->load->view('headers/slide-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/slide-edit',$data);
				$this->load->view('footers/slide-edit');
				$this->load->view('notifys');
				$this->load->view('messages');
			}
			else
			{
				$this->load->library('notifications');
				$update_array = array('sduid'=>$this->session->userdata('uid'), 'sdtitle'=>set_value('title'), 'sddesc'=>set_value('desc'), 'sdlinkurl1'=>set_value('link1'), 'sdlinkalt1'=>set_value('title1'), 'sdlinkurl2'=>set_value('link2'), 'sdlinkalt2'=>set_value('title2'), 'sdactive'=>set_value('active'), 'sdtime'=>time());
				if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0)
				{
					//$newname = mt_rand();
					$file = $this->uploadimg('file', 'imgs/slides/', mt_rand());
					if($file)
					{
						if(set_value('oldimg') != '' && file_exists(set_value('oldimg'))) unlink(set_value('oldimg'));
						$update_array['sdimg'] = $file;
					}
				}
				if($this->Admin_mo->update('slides', $update_array, array('sdid'=>$id)))
				{
					$this->notifications->addNotify($this->session->userdata('uid'),'SD',' عدل الشريحة  '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,sdsee,%" or usertypes.utprivileges like "%,sdedit,%")');
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				}
				redirect('slides', 'refresh');
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('slides', 'refresh');
		}
		//redirect('slides', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'slides';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('slides', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/slides',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/slides');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',sddelete,') !== false && in_array('SD',$this->sections))
		{
		$slide = $this->Admin_mo->getrow('slides', array('sdid'=>$id));
		if(!empty($slide))
		{
			$this->load->library('notifications');
			$this->Admin_mo->del('slides', array('sdid'=>$id));
			if($slide->sdimg != '' && file_exists($slide->sdimg)) unlink($slide->sdimg);
			$this->notifications->addNotify($this->session->userdata('uid'),'SD',' حذف الشريحة  '.$slide->sdtitle,'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,sdsee,%" or usertypes.utprivileges like "%,sddelete,%")');
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('slides', 'refresh');
		}
		else
		{
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$data['title'] = 'slides';
			$data['admessage'] = 'youhavenoprivls';
			$this->lang->load('slides', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$this->load->view('headers/slides',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/slides');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'slides';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('slides', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/slides',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/slides');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function imageSize()
	{
		if ($_FILES['file']['size'] > 1024000)
		{
			//$this->form_validation->set_message('imageSize', 'يجب ان يكون حجم الصورة 1 ميجا او اقل');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function imageType()
	{
		if (!in_array(strtoupper(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)),array('JPG','JPEG','PNG','JIF','BMP','TIF')))
		{
			//$this->form_validation->set_message('imageType', 'يجب ان يكون نوع الملف المرفوع واحد من هذه الانواع : JPG,JPEG,PIG,JIF,BMP,TIF');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function uploadimg($inputfilename,$image_director,$newname)
	{
		$file_extn = pathinfo($_FILES[$inputfilename]['name'], PATHINFO_EXTENSION);
		if(!is_dir($image_director)) $create_image_director = mkdir($image_director);
		$name = $newname.'.'.$file_extn;
		if(move_uploaded_file($_FILES[$inputfilename]["tmp_name"], $image_director.$name)) return $image_director.$name;
		else return 0;
	}
}