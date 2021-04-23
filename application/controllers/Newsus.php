<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsus extends CI_Controller {

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
		if(strpos($this->loginuser->privileges, ',nwsee,') !== false && in_array('NW',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$this->lang->load('news', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		$data['news'] = $this->Admin_mo->get('news');
		$this->load->view('calenderdate');
		//$data['users'] = $this->Admin_mo->rate('*','users',' where id <> 1');
		$this->load->view('headers/news',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/news',$data);
		$this->load->view('footers/news');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'news';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('news', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/news',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/news');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',nwadd,') !== false && in_array('NW',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['admessage'] = '';
		$this->lang->load('news', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		//$data['users'] = $this->Admin_mo->get('users');
		$this->load->view('headers/new-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/new-add',$data);
		$this->load->view('footers/new-add');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'news';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('news', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/news',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/news');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',nwadd,') !== false && in_array('NW',$this->sections))
		{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('title', 'العنوان' , 'trim|required|max_length[255]|is_unique[news.nwtitle]');
		$this->form_validation->set_rules('desc', 'الوصف' , 'trim|required');
		$this->form_validation->set_rules('file', 'الصورة' , 'callback_imageSize|callback_imageType');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$this->lang->load('news', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$this->load->view('headers/new-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/new-add',$data);
			$this->load->view('footers/new-add');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$this->load->library('notifications');
			$set_arr = array('nwuid'=>$this->session->userdata('uid'), 'nwurl'=>str_replace(' ','_',set_value('title')), 'nwtitle'=>set_value('title'), 'nwdesc'=>set_value('desc'), 'nwactive'=>set_value('active'), 'nwtime'=>time());
			if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0)
			{
				//$newname = mt_rand();
				$file = $this->uploadimg('file', 'imgs/news/', mt_rand());
				if($file)
				{
					$set_arr['nwimg'] = $file;
					$nwid = $this->Admin_mo->set('news', $set_arr);
					if(empty($nwid))
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
						redirect('newsus/add', 'refresh');
					}
					else
					{
						if(in_array('EM',$this->sections) && set_value('active'))
						{
							$emails = $this->Admin_mo->getwhere('emails',array('emactive'=>'1'));
							if(!empty($emails))
							{
								foreach($emails as $email) { $persons[] = $email->ememail; }
								$this->sendemail($persons,base_url().'/new/'.str_replace(' ','_',set_value('title')));
							}
						}
						$this->notifications->addNotify($this->session->userdata('uid'),'NW',' اضاف الخبر '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,nwsee,%" or usertypes.utprivileges like "%,nwadd,%")');
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
						redirect('newsus', 'refresh');
					}
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					redirect('newsus/add', 'refresh');
				}
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('newsus/add', 'refresh');
			}		
		}
		//redirect('newsus/add', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'news';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('news', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/news',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/news');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',nwedit,') !== false && in_array('NW',$this->sections))
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$this->lang->load('news', 'arabic');
		$id = abs((int)($id));
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['new'] = $this->Admin_mo->getrow('news',array('nwid'=>$id));
		if(!empty($data['new']))
		{
			$this->load->view('headers/new-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/new-edit',$data);
			$this->load->view('footers/new-edit');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'news';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/news',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/news');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'news';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('news', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/news',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/news');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function editnew($id)
	{
		if(strpos($this->loginuser->privileges, ',nwedit,') !== false && in_array('NW',$this->sections))
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
				$data['new'] = $this->Admin_mo->getrow('news',array('nwid'=>$id));
				$this->load->view('headers/new-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/new-edit',$data);
				$this->load->view('footers/new-edit');
				$this->load->view('notifys');
				$this->load->view('messages');
			}
			else
			{
				if($this->Admin_mo->exist('news','where nwid <> '.$id.' and nwtitle like "'.set_value('title').'"',''))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'nameexist';
					redirect('newsus/edit/'.$id, 'refresh');
				}
				else
				{
					$this->load->library('notifications');
					$update_array = array('nwuid'=>$this->session->userdata('uid'), 'nwurl'=>str_replace(' ','_',set_value('title')), 'nwtitle'=>set_value('title'), 'nwdesc'=>set_value('desc'), 'nwactive'=>set_value('active'), 'nwtime'=>time());
					if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0)
					{
						//$newname = mt_rand();
						$file = $this->uploadimg('file', 'imgs/news/', mt_rand());
						if($file)
						{
							if(set_value('oldimg') != '' && file_exists(set_value('oldimg'))) unlink(set_value('oldimg'));
							$update_array['nwimg'] = $file;
						}
					}
					if($this->Admin_mo->update('news', $update_array, array('nwid'=>$id)))
					{
						if(in_array('EM',$this->sections) && set_value('active'))
						{
							$emails = $this->Admin_mo->getwhere('emails',array('emactive'=>'1'));
							if(!empty($emails))
							{
								foreach($emails as $email) { $persons[] = $email->ememail; }
								$this->sendemail($persons,base_url().'/new/'.str_replace(' ','_',set_value('title')));
							}
						}
						$this->notifications->addNotify($this->session->userdata('uid'),'NW',' عدل الخبر  '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,nwsee,%" or usertypes.utprivileges like "%,nwedit,%")');
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					}
					else
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					}
					redirect('newsus', 'refresh');
				}
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('newsus', 'refresh');
		}
		//redirect('newsus', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'news';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('news', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/news',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/news');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',nwdelete,') !== false && in_array('NW',$this->sections))
		{
		$new = $this->Admin_mo->getrow('news', array('nwid'=>$id));
		if(!empty($new))
		{
			$this->load->library('notifications');
			$this->Admin_mo->del('news', array('nwid'=>$id));
			$this->Admin_mo->del('newviews', array('nvnwid'=>$id));
			if($new->nwimg != '' && file_exists($new->nwimg)) unlink($new->nwimg);
			$this->notifications->addNotify($this->session->userdata('uid'),'NW',' حذف الخبر  '.$new->nwtitle,'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$this->session->userdata('uid').' and (usertypes.utprivileges like "%,nwsee,%" or usertypes.utprivileges like "%,nwdelete,%")');
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('newsus', 'refresh');
		}
		else
		{
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->session->userdata('uid'));
			$data['title'] = 'news';
			$data['admessage'] = 'youhavenoprivls';
			$this->lang->load('news', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$this->load->view('headers/news',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/news');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->session->userdata('uid'));
		$data['title'] = 'news';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('news', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/news',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/news');
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
	
	public function sendemail($persons,$new)
	{
		require_once('../PHPMailer/class.phpmailer.php');
		require_once('../PHPMailer/class.smtp.php');
		require_once('../PHPMailer/PHPMailerAutoload.php');
		$mail             = new PHPMailer(); // defaults to using php "mail()"
		$mail->IsSMTP(); // telling the class to use SMTP
		//$mail->Host       = "smtp.secureserver.net";
		$mail->Host       = "localhost";
		//	$mail->Host       = "smtpout.secureserver.net";      // sets GMAIL as the SMTP server
		//	$mail->SMTPAuth   = true;                  // enable SMTP authentication
		//	$mail->SMTPSecure = 'ssl';
		//	$mail->Port = 465;
		//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
		//$mail->Username   = "";  // GMAIL username
		//$mail->Password   = "";					
		//$mail->AddReplyTo("name@yourdomain.com","First Last");
		$address = "info@alwafaa.com";
		$mail->SetFrom($address, 'INFO');
		//$mail->AddAddress($person['email']);
		foreach($persons as $person) { $mail->AddBCC($person); }
		$mail->Subject    = 'النشرة البريدية لموقع مستشفى الوفاء';
		//$mail->AltBody    = "You can active your account on : "; // optional, comment out and test
		$mail->Body    = 'ارجو تفقد الخبر الجديد على الرابط  '.$new;
		if($mail->Send()) return 1;
		else return 0;
	}
}