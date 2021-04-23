<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Images extends CI_Controller {

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
		$data['title'] = 'images';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/images',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/images');
		$this->load->view('notifys');
		$this->load->view('messages');
	}

	public function album($id)
	{
		if(strpos($this->loginuser->privileges, ',glsee,') !== false && in_array('GL',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$data['id'] = abs((int)($id));
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		$data['images'] = $this->Admin_mo->getwhere('gallery',array('glalid'=>$data['id']));
		$this->load->view('calenderdate');
		//$data['users'] = $this->Admin_mo->rate('*','users',' where id <> 1');
		$this->load->view('headers/images',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/images',$data);
		$this->load->view('footers/images');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'images';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/images',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/images');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function add($id)
	{
		if(strpos($this->loginuser->privileges, ',gladd,') !== false && in_array('GL',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$data['id'] = abs((int)($id));
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		//$data['users'] = $this->Admin_mo->get('users');
		$this->load->view('headers/image-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/image-add',$data);
		$this->load->view('footers/image-add');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'images';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/images',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/images');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',gladd,') !== false && in_array('GL',$this->sections))
		{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('title', 'العنوان' , 'trim|required|max_length[255]');
		$this->form_validation->set_rules('desc', 'الوصف' , 'trim|required');
		$this->form_validation->set_rules('file', 'الصورة' , 'callback_imageSize|callback_imageType');
		$this->form_validation->set_rules('alid', 'الألبوم' , 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$this->lang->load('gallery', 'arabic');
			$data['id'] = set_value('alid');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$this->load->view('headers/image-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/image-add',$data);
			$this->load->view('footers/image-add');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$this->load->library('notifications');
			$set_arr = array('glalid'=>set_value('alid'), 'gluid'=>$this->session->userdata('uid'), 'gltitle'=>set_value('title'), 'gldesc'=>set_value('desc'), 'glactive'=>set_value('active'), 'gltime'=>time());
			if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0)
			{
				//$newname = mt_rand();
				$file = $this->uploadimg('file', 'imgs/albums/', mt_rand());
				if($file)
				{
					$set_arr['glimg'] = $file;
					$glid = $this->Admin_mo->set('gallery', $set_arr);
					if(empty($glid))
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
						redirect('images/add/'.set_value('alid'), 'refresh');
					}
					else
					{
						$this->Admin_mo->update('album', array('child'=>'1'), array('alid'=>set_value('alid')));
						$this->notifications->addNotify($this->session->userdata('uid'),'GL',' اضاف الصورة '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,glsee,%" or usertypes.utprivileges like "%,gladd,%")');
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
						redirect('images/album/'.set_value('alid'), 'refresh');
					}
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					redirect('images/add/'.set_value('alid'), 'refresh');
				}
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('images/add/'.set_value('alid'), 'refresh');
			}		
		}
		//redirect('images/add', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'images';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/images',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/images');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',gledit,') !== false && in_array('GL',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$this->lang->load('gallery', 'arabic');
		$id = abs((int)($id));
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['image'] = $this->Admin_mo->getrow('gallery',array('glid'=>$id));
		if(!empty($data['image']))
		{
			$this->load->view('headers/image-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/image-edit',$data);
			$this->load->view('footers/image-edit');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'images';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/images',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/images');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'images';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/images',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/images');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function editimage($id)
	{
		if(strpos($this->loginuser->privileges, ',gledit,') !== false && in_array('GL',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('title', 'العنوان' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('desc', 'الوصف' , 'trim|required');
			if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0) $this->form_validation->set_rules('file', 'الصورة' , 'callback_imageSize|callback_imageType');
			if($this->form_validation->run() == FALSE)
			{
				$this->load->library('notifications');
				$data = $this->notifications->notifys($this->session->userdata('uid'));
				$this->lang->load('gallery', 'arabic');
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['image'] = $this->Admin_mo->getrow('gallery',array('glid'=>$id));
				$this->load->view('headers/image-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/image-edit',$data);
				$this->load->view('footers/image-edit');
				$this->load->view('notifys');
				$this->load->view('messages');
			}
			else
			{
				$this->load->library('notifications');
				$update_array = array('gluid'=>$this->session->userdata('uid'), 'gltitle'=>set_value('title'), 'gldesc'=>set_value('desc'), 'glactive'=>set_value('active'), 'gltime'=>time());
				if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0)
				{
					//$newname = mt_rand();
					$file = $this->uploadimg('file', 'imgs/albums/', mt_rand());
					if($file)
					{
						if(set_value('oldimg') != '' && file_exists(set_value('oldimg'))) unlink(set_value('oldimg'));
						$update_array['glimg'] = $file;
					}
				}
				if($this->Admin_mo->update('gallery', $update_array, array('glid'=>$id)))
				{
					$this->notifications->addNotify($this->session->userdata('uid'),'GL',' عدل الصورة  '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,glsee,%" or usertypes.utprivileges like "%,gledit,%")');
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				}
				redirect('albums', 'refresh');
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('albums', 'refresh');
		}
		//redirect('albums', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'images';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/images',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/images');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',gldelete,') !== false && in_array('GL',$this->sections))
		{
		$image = $this->Admin_mo->getrow('gallery', array('glid'=>$id));
		if(!empty($image))
		{
			$this->load->library('notifications');
			$this->Admin_mo->del('gallery', array('glid'=>$id));
			if($this->Admin_mo->exist('gallery','where glalid = '.$image->glalid,'') == 0) $this->Admin_mo->update('album', array('child'=>'0'), array('alid'=>$image->glalid));
			if($image->glimg != '' && file_exists($image->glimg)) unlink($image->glimg);
			$this->notifications->addNotify($this->session->userdata('uid'),'GL',' حذف الصورة '.$image->gltitle,'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,glsee,%" or usertypes.utprivileges like "%,gldelete,%")');
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('albums', 'refresh');
		}
		else
		{
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$data['title'] = 'images';
			$data['admessage'] = 'youhavenoprivls';
			$this->lang->load('gallery', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$this->load->view('headers/images',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/images');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'images';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/images',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/images');
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