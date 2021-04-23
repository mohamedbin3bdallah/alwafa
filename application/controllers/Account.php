<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

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
			$this->loginuser = $this->Admin_mo->getrow('users',array('uid'=>$this->session->userdata('uid')));
		}
	}

	public function index()
	{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['admessage'] = '';
		$this->lang->load('users', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		$usertypes = $this->Admin_mo->get('usertypes');
		$data['usertypes'] = array(); foreach($usertypes as $usertype) { $data['usertypes'][$usertype->utid] = $usertype->utname; }
		$branches = $this->Admin_mo->get('branches');
		$data['branches'] = array(); foreach($branches as $branch) { $data['branches'][$branch->bcid] = $branch->bcname; }
		$stores = $this->Admin_mo->get('itemtypes');
		$data['stores'] = array(); foreach($stores as $store) { $data['stores'][$store->itid] = $store->itname; }
		$data['user'] = $this->Admin_mo->getrow('users',array('uid'=>$this->session->userdata('uid')));
		$this->load->view('calenderdate');
		$this->load->view('headers/account',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/account',$data);
		$this->load->view('footers/account');
		$this->load->view('notifys');
		$this->load->view('messages');
	}

	public function name_validation()
	{
		if($_POST['val'] != '' && $_POST['val'] != ' ')
		{
			if(isset($_POST['id']) && $_POST['id'] != '') $where = 'uid <> '.$_POST['id'].' and';
			else $where = '';
			 
			if(!preg_match('/[^0-9 ]/',$_POST['val'])) echo 5;
			elseif(strlen($_POST['val']) < 5) echo 2;
			elseif(strlen($_POST['val']) > 255) echo 3;
			elseif($this->Admin_mo->exist('users','where '.$where.' uname like "'.$_POST['val'].'"','')) echo 4;
			else echo 1;
		}
		else echo 0;
	}

	public function email_validation()
	{
		if($_POST['val'] != '' && $_POST['val'] != ' ')
		{
			if(isset($_POST['id']) && $_POST['id'] != '') $where = 'uid <> '.$_POST['id'].' and';
			else $where = '';
			
			if(filter_var($_POST['val'], FILTER_VALIDATE_EMAIL) === false) echo 2;
			elseif($this->Admin_mo->exist('users','where '.$where.' uemail like "'.$_POST['val'].'"','')) echo 4;
			else echo 1;
		}
		else echo 0;
	}
	
	public function password_validation()
	{
		if($_POST['val1'] != '')
		{
			if(strlen($_POST['val1']) < 6) echo 2;
			elseif(strlen($_POST['val1']) > 255) echo 3;
			elseif($_POST['val2'] != '' && $_POST['val2'] != ' ' && $_POST['val1'] != $_POST['val2']) echo 4;
			elseif($_POST['val2'] != '' && $_POST['val2'] != ' ' && $_POST['val1'] == $_POST['val2']) echo 5;
			else echo 1;
		}
		else echo 0;
	}
	
	public function cnfpassword_validation()
	{
		if($_POST['val1'] != '' && $_POST['val2'] != '')
		{
			if($_POST['val1'] != $_POST['val2']) echo 4;
			else echo 1;
		}
		else echo 0;
	}
	
	public function username_validation()
	{
		if($_POST['val'] != '' && $_POST['val'] != ' ')
		{
			if(isset($_POST['id']) && $_POST['id'] != '') $where = 'uid <> '.$_POST['id'].' and';
			else $where = '';
			
			if(preg_match('/[^a-z]/',$_POST['val'])) echo 2;
			elseif(strlen($_POST['val']) < 5) echo 3;
			elseif(strlen($_POST['val']) >= 255) echo 5;
			elseif($this->Admin_mo->exist('users','where '.$where.' username like "'.$_POST['val'].'"','')) echo 4;
			else echo 1;
		}
		else echo 0;
	}

	public function edit()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('username', 'اسم المستخدم' , 'trim|alpha|required|max_length[255]');
		$this->form_validation->set_rules('name', 'الاسم' , 'trim|required|max_length[255]');
		$this->form_validation->set_rules('email', 'البريد الاكتروني' , 'trim|required|max_length[255]|valid_email');
		$this->form_validation->set_rules('password', 'كلمة المرور', 'trim|min_length[6]|max_length[255]');
		$this->form_validation->set_rules('cnfpassword', 'تاكيد كلمة المرور', 'trim|matches[password]');
		$this->form_validation->set_rules('phone', 'الموبايل' , 'trim|max_length[255]|numeric');
		$this->form_validation->set_rules('address', 'العنوان' , 'trim|max_length[255]');
		if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0) $this->form_validation->set_rules('pimg', 'الصورة' , 'callback_imageSize|callback_imageType');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->library('notifications');
			$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
			$data['admessage'] = '';
			$this->lang->load('users', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
			$usertypes = $this->Admin_mo->get('usertypes');
			$data['usertypes'] = array(); foreach($usertypes as $usertype) { $data['usertypes'][$usertype->utid] = $usertype->utname; }
			$branches = $this->Admin_mo->get('branches');
			$data['branches'] = array(); foreach($branches as $branch) { $data['branches'][$branch->bcid] = $branch->bcname; }
			$stores = $this->Admin_mo->get('itemtypes');
			$data['stores'] = array(); foreach($stores as $store) { $data['stores'][$store->itid] = $store->itname; }
			$data['user'] = $this->Admin_mo->getrow('users',array('uid'=>$this->session->userdata('uid')));
			$this->load->view('calenderdate');
			$this->load->view('headers/account',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/account',$data);
			$this->load->view('footers/account');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			if($this->Admin_mo->exist('users','where uid <> '.$this->session->userdata('uid').' and username like "'.set_value('username').'"',''))
			{
				$data['admessage'] = 'This Name is exist';
				$_SESSION['time'] = time(); $_SESSION['message'] = 'usernameexist';
				redirect('account', 'refresh');
			}
			if($this->Admin_mo->exist('users','where uid <> '.$this->session->userdata('uid').' and uname like "'.set_value('name').'"',''))
			{
				$data['admessage'] = 'This Name is exist';
				$_SESSION['time'] = time(); $_SESSION['message'] = 'nameexist';
				redirect('account', 'refresh');
			}
			if($this->Admin_mo->exist('users','where uid <> '.$this->session->userdata('uid').' and uemail like "'.set_value('email').'"',''))
			{
				$data['admessage'] = 'This Email is exist';
				$_SESSION['time'] = time(); $_SESSION['message'] = 'emailexist';
				redirect('account', 'refresh');
			}
			else
			{
				$this->load->library('notifications');
				$update_array = array('uuid'=>$this->session->userdata('uid'), 'username'=>set_value('username'), 'uname'=>set_value('name'), 'uemail'=>set_value('email'), 'uphone'=>set_value('phone'), 'uaddress'=>set_value('address'), 'uctime'=>time());
				if(isset($_FILES['pimg']['error']) && $_FILES['pimg']['error'] == 0) { $update_array['uimage'] = $this->uploadimg('pimg','imgs/users',array('JPG','JPEG','PIG','JIF','BMP','TIF'),mt_rand()); if($update_array['uimage'] != '' && set_value('oldpimg') != '' && file_exists(set_value('oldpimg'))) unlink(set_value('oldpimg')); };
				if(set_value('password') != '' && set_value('password') != ' ')  $update_array['password'] = password_hash(set_value('password'), PASSWORD_BCRYPT, array('cost'=>10));
				$this->Admin_mo->update('users', $update_array, array('uid'=>$this->session->userdata('uid')));
				$this->notifications->addNotify($this->session->userdata('uid'),'',' قام بتعديل المستخدم  '.set_value('name'),'where uid = '.$this->session->userdata('uid').' or uutid = 1');
				$data['admessage'] = 'Successfully Saved';
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('account', 'refresh');
			}
		}
	}
	
	public function imageSize()
	{
		if ($_FILES['pimg']['size'] > 1024000)
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
		if (!in_array(strtoupper(pathinfo($_FILES['pimg']['name'], PATHINFO_EXTENSION)),array('JPG','JPEG','PIG','JIF','BMP','TIF')))
		{
			//$this->form_validation->set_message('imageType', 'يجب ان يكون نوع الملف المرفوع واحد من هذه الانواع : JPG,JPEG,PIG,JIF,BMP,TIF');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function uploadimg($inputfilename,$image_director,$extensions,$newname)
	{
		$file_extn = pathinfo($_FILES[$inputfilename]['name'], PATHINFO_EXTENSION);
		if(in_array(strtoupper($file_extn),$extensions))
		{			
			if(!is_dir($image_director)) $create_image_director = mkdir($image_director);
			$name = $newname.".".$file_extn;
			if(move_uploaded_file($_FILES[$inputfilename]["tmp_name"], $image_director.'/'.$name))	return $image_director.'/'.$name;
			else return '';
		}
		else return '';
	}
}