<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {

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
		if(strpos($this->loginuser->privileges, ',alsee,') !== false && in_array('AL',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		$data['albums'] = $this->Admin_mo->get('album');
		$this->load->view('calenderdate');
		//$data['users'] = $this->Admin_mo->rate('*','users',' where id <> 1');
		$this->load->view('headers/albums',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/albums',$data);
		$this->load->view('footers/albums');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'albums';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/albums',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/albums');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',aladd,') !== false && in_array('AL',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		//$data['users'] = $this->Admin_mo->get('users');
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
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'albums';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/albums',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/albums');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',aladd,') !== false && in_array('AL',$this->sections))
		{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('title', 'العنوان' , 'trim|required|max_length[255]|is_unique[album.altitle]');
		$this->form_validation->set_rules('desc', 'الوصف' , 'trim|required');
		$this->form_validation->set_rules('file', 'الصورة' , 'callback_imageSize|callback_imageType');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$this->lang->load('gallery', 'arabic');
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
			$set_arr = array('aluid'=>$this->session->userdata('uid'), 'alurl'=>str_replace(' ','_',set_value('title')), 'altitle'=>set_value('title'), 'aldesc'=>set_value('desc'), 'alactive'=>set_value('active'), 'altime'=>time());
			if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0)
			{
				//$newname = mt_rand();
				$file = $this->uploadimg('file', 'imgs/albums/', mt_rand());
				if($file)
				{
					$set_arr['alimg'] = $file;
					$alid = $this->Admin_mo->set('album', $set_arr);
					if(empty($alid))
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
						redirect('albums/add', 'refresh');
					}
					else
					{
						$this->notifications->addNotify($this->session->userdata('uid'),'AL',' اضاف الألبوم '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,alsee,%" or usertypes.utprivileges like "%,aladd,%")');
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
						redirect('albums', 'refresh');
					}
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					redirect('albums/add', 'refresh');
				}
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('albums/add', 'refresh');
			}		
		}
		//redirect('albums/add', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'albums';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/albums',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/albums');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',aledit,') !== false && in_array('AL',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$this->lang->load('gallery', 'arabic');
		$id = abs((int)($id));
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['album'] = $this->Admin_mo->getrow('album',array('alid'=>$id));
		if(!empty($data['album']))
		{
			$this->load->view('headers/album-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/album-edit',$data);
			$this->load->view('footers/album-edit');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'albums';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/albums',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/albums');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'albums';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/albums',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/albums');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function editalbum($id)
	{
		if(strpos($this->loginuser->privileges, ',aledit,') !== false && in_array('AL',$this->sections))
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
				$data['album'] = $this->Admin_mo->getrow('album',array('alid'=>$id));
				$this->load->view('headers/album-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/album-edit',$data);
				$this->load->view('footers/album-edit');
				$this->load->view('notifys');
				$this->load->view('messages');
			}
			else
			{
				if($this->Admin_mo->exist('album','where alid <> '.$id.' and altitle like "'.set_value('title').'"',''))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'nameexist';
					redirect('albums/edit/'.$id, 'refresh');
				}
				else
				{
					$this->load->library('notifications');
					$update_array = array('aluid'=>$this->session->userdata('uid'), 'alurl'=>str_replace(' ','_',set_value('title')), 'altitle'=>set_value('title'), 'aldesc'=>set_value('desc'), 'alactive'=>set_value('active'), 'altime'=>time());
					if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0)
					{
						//$newname = mt_rand();
						$file = $this->uploadimg('file', 'imgs/albums/', mt_rand());
						if($file)
						{
							if(set_value('oldimg') != '' && file_exists(set_value('oldimg'))) unlink(set_value('oldimg'));
							$update_array['alimg'] = $file;
						}
					}
					if($this->Admin_mo->update('album', $update_array, array('alid'=>$id)))
					{
						$this->notifications->addNotify($this->session->userdata('uid'),'AL',' عدل الألبوم  '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,alsee,%" or usertypes.utprivileges like "%,aledit,%")');
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					}
					else
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					}
					redirect('albums', 'refresh');
				}
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
		$data['title'] = 'albums';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/albums',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/albums');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',aldelete,') !== false && in_array('AL',$this->sections))
		{
		$album = $this->Admin_mo->getrow('album', array('alid'=>$id));
		if(!empty($album) && !$album->child)
		{
			$this->load->library('notifications');
			$this->Admin_mo->del('album', array('alid'=>$id));
			if($album->alimg != '' && file_exists($album->alimg)) unlink($album->alimg);
			$this->notifications->addNotify($this->session->userdata('uid'),'AL',' حذف الألبوم  '.$album->altitle,'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,alsee,%" or usertypes.utprivileges like "%,aldelete,%")');
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('albums', 'refresh');
		}
		else
		{
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$data['title'] = 'albums';
			$data['admessage'] = 'youhavenoprivls';
			$this->lang->load('gallery', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$this->load->view('headers/albums',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/albums');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'albums';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('gallery', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/albums',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/albums');
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