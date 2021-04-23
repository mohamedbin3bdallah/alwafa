<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

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
		$this->sections = array();
		$sections = $this->Admin_mo->getwhere('sections',array('scactive'=>'1'));
		if(!empty($sections))
		{
			foreach($sections as $section) { $this->sections[$section->scid] = $section->sccode; }
		}
		
		$this->pages = array();
		if(in_array('PG',$this->sections))
		{
			$pages = $this->Admin_mo->getwhere('pages',array('pgactive'=>'1'));
			if(!empty($sections))
			{
				foreach($pages as $page) { $this->pages['url'][$page->pgid] = $page->pgurl; $this->pages['title'][$page->pgid] = $page->pgtitle; $this->pages['desc'][$page->pgid] = $page->pgdesc; $this->pages['keywords'][$page->pgid] = $page->pgkeywords; }
			}
		}
	}

	public function errorpage()
	{
		$this->load->view('404');
	}

	public function index()
	{
		if(!empty($this->pages) && in_array('index',$this->pages['url']))
		{
			$data['admessage'] = '';
			$data['pageid'] = array_search('index', $this->pages['url']);
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
			$data['slides'] = $this->Admin_mo->getwhere('slides',array('sdactive'=>'1'));
			$data['about'] = $this->Admin_mo->getwhere('about',array('abactive'=>'1'));
			$data['doctorscount'] = $this->Admin_mo->exist('doctors','','');
			$data['news'] = $this->Admin_mo->getjoinLeftLimit('news.*','news',array(),array('nwactive'=>'1'),'nwtime DESC','3');
			$data['videos'] = $this->Admin_mo->getjoinLeftLimit('videos.*','videos',array(),array('vdactive'=>'1'),'vdtime DESC','1');
			$this->load->view('calenderdate');
			$this->load->view('frontend/index',$data);
		}
		else redirect('404', 'refresh');
	}

	public function registration()
	{
		if(in_array('U',$this->sections) && ($this->session->userdata('uid') == FALSE || !$this->input->cookie('uid', TRUE)))
		{
			if(!empty($this->pages) && in_array('registration',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('registration', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
				$this->load->view('frontend/registration',$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index', 'refresh');
	}
	
	public function login()
	{
		if(in_array('U',$this->sections) && ($this->session->userdata('uid') == FALSE || !$this->input->cookie('uid', TRUE)))
		{
			if(!empty($this->pages) && in_array('login',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('login', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
				$this->load->view('frontend/login',$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index', 'refresh');
	}

	public function forgotpassword()
	{
		if(in_array('U',$this->sections) && ($this->session->userdata('uid') == FALSE || !$this->input->cookie('uid', TRUE)))
		{
			if(!empty($this->pages) && in_array('forgotpassword',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('forgotpassword', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
				$this->load->view('frontend/forgotpassword',$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index', 'refresh');
	}

	public function about()
	{
		if(in_array('AB',$this->sections))
		{
			if(!empty($this->pages) && in_array('about',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('about', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['abouts'] = $this->Admin_mo->getwhere('about',array('abactive'=>'1','abpage'=>'عن الموقع'));
				$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
				$this->load->view('frontend/about',$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index', 'refresh');
	}
	
	public function email()
	{
		if(in_array('EM',$this->sections))
		{
			if(!empty($this->pages) && in_array('email',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('email', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
				$this->load->view('frontend/email',$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index', 'refresh');
	}
	
	public function message()
	{
		if(in_array('AB',$this->sections))
		{
			if(!empty($this->pages) && in_array('message',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('message', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['abouts'] = $this->Admin_mo->getwhere('about',array('abactive'=>'1','abpage'=>'الرسائل'));
				$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
				$this->load->view('frontend/message',$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index', 'refresh');
	}
	
	public function allgallery()
	{
		if(in_array('AL',$this->sections))
		{
			if(!empty($this->pages) && in_array('allgallery',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('allgallery', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['albums'] = $this->Admin_mo->getwhere('album',array('alactive'=>'1'));
				$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
				$this->load->view('frontend/all-gallery',$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index', 'refresh');
	}
	
	public function gallery($url)
	{
		if(in_array('GL',$this->sections))
		{
			$data['admessage'] = '';
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
			$data['gallery'] = $this->Admin_mo->getjoinLeftLimit('gallery.*','gallery',array('album'=>'album.alid=gallery.glalid'),array('gallery.glactive'=>'1','album.alurl'=>urldecode($url)),'gallery.gltime DESC','');
			$this->load->view('frontend/gallery',$data);
		}
		else redirect('index', 'refresh');
	}
	
	public function videos()
	{
		if(in_array('AL',$this->sections))
		{
			if(!empty($this->pages) && in_array('videos',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('videos', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['videos'] = $this->Admin_mo->getwhere('videos',array('vdactive'=>'1'));
				$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
				$this->load->view('frontend/videos',$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index', 'refresh');
	}
	
	public function news()
	{
		if(in_array('NW',$this->sections))
		{
			if(!empty($this->pages) && in_array('news',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('news', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['news'] = $this->Admin_mo->getwhere('news',array('nwactive'=>'1'));
				$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
				$this->load->view('frontend/news',$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index', 'refresh');
	}
	
	public function newd($url)
	{
		if(in_array('NW',$this->sections))
		{
			$data['admessage'] = '';
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['new'] = $this->Admin_mo->getrow('news',array('nwactive'=>'1','nwurl like'=>urldecode($url)));
			if(!empty($data['new']))
			{
				$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
				if($pageWasRefreshed) {}
				else
				{
					$ipaddress = hash('sha256', $_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'], FALSE);
					$newviews = $this->Admin_mo->getrow('newviews',array('nvnwid'=>$data['new']->nwid,'nvdevice like'=>$ipaddress));
					if(!empty($newviews)) $this->Admin_mo->update('newviews',array('nvtotal'=>($newviews->nvtotal)+1,'nvtime'=>time()),array('nvnwid'=>$data['new']->nwid,'nvdevice like'=>$ipaddress));
					else
					{
						$this->Admin_mo->set('newviews',array('nvnwid'=>$data['new']->nwid,'nvdevice'=>$ipaddress,'nvtotal'=>1,'nvtime'=>time()));
						$this->Admin_mo->update('news',array('nwviews'=>($data['new']->nwviews)+1),array('nwid'=>$data['new']->nwid));
					}
				}
			}
			$this->load->view('calenderdate');
			$this->load->view('frontend/new',$data);
		}
		else redirect('index', 'refresh');
	}
	
	public function contact()
	{
		if(in_array('CT',$this->sections))
		{
			if(!empty($this->pages) && in_array('contact',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('contact', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
				$this->load->view('frontend/contact',$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index', 'refresh');
	}

	public function getdoctors()
	{
		echo '<span class="th-select" id="doctorsdiv"><select name="doctor"><option value="">اسم الدكتور</option>';
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
		echo '</select></span>';
	}
	
	public function saveemail()
	{
		if(in_array('EM',$this->sections))
		{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('email', 'البريد الاكتروني' , 'trim|required|max_length[255]|valid_email|is_unique[emails.ememail]');
		if($this->form_validation->run() == FALSE)
		{
			$data['pageid'] = array_search('email', $this->pages['url']);
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
			$this->load->view('frontend/email',$data);
		}
		else
		{
			$this->load->library('notifications');
			$set_arr = array('ememail'=>set_value('email'), 'emtime'=>time());
			if($this->session->userdata('uid') != FALSE) $set_arr['emuid'] = $this->session->userdata('uid');
			elseif(!$this->input->cookie('uid', TRUE)) $set_arr['emuid'] = $this->input->cookie('uid', TRUE);
			else $set_arr['emuid'] = 0;
			$emid = $this->Admin_mo->set('emails', $set_arr);
			if(empty($emid))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('email', 'refresh');
			}
			else
			{
				$this->notifications->addNotify($set_arr['emuid'],'EM',' اضاف بريد الكتروني '.set_value('email'),'inner join usertypes on users.uutid = usertypes.utid where usertypes.utprivileges like "%,emsee,%" or usertypes.utprivileges like "%,emedit,%"');
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('email', 'refresh');
			}
		}
		//redirect('about/add', 'refresh');
		}
		else
		{
			redirect('index', 'refresh');
		}
	}

	public function newpassword()
	{
		if(in_array('U',$this->sections) && ($this->session->userdata('uid') == FALSE || !$this->input->cookie('uid', TRUE)))
		{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('email', 'البريد الاكتروني' , 'trim|required|max_length[255]|valid_email');
		if($this->form_validation->run() == FALSE)
		{
			$data['pageid'] = array_search('forgotpassword', $this->pages['url']);
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
			$this->load->view('frontend/forgotpassword',$data);
		}
		elseif(!$this->Admin_mo->exist('users','where uemail like "'.set_value('email').'"',''))
		{
			$_SESSION['time'] = time(); $_SESSION['message'] = 'emailnotexist';
			redirect('forgotpassword', 'refresh');
		}
		else
		{
			$newpassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+') , 0 , 9);
			if($this->sendemail(set_value('email'),'New Password','Your New Password IS: '.$newpassword))
			{
				$this->load->library('notifications');
				if($this->Admin_mo->update('users', array('upassword'=>password_hash($newpassword, PASSWORD_BCRYPT, array('cost'=>10)),'uuid'=>0,'utime'=>time()), array('uemail'=>set_value('email'))))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					redirect('forgotpassword', 'refresh');
				}
				else
				{
					$this->notifications->addNotify(0,'U',' عدل المستخدم '.set_value('email'),'inner join usertypes on users.uutid = usertypes.utid where usertypes.utprivileges like "%,usee,%" or usertypes.utprivileges like "%,uedit,%"');
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					redirect('forgotpassword', 'refresh');
				}
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('forgotpassword', 'refresh');
			}
		}
		//redirect('about/add', 'refresh');
		}
		else
		{
			redirect('index', 'refresh');
		}
	}

	public function reservation()
	{
		if(in_array('RS',$this->sections) && ($this->session->userdata('uid') == FALSE || !$this->input->cookie('uid', TRUE)))
		{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('name', 'الاسم' , 'trim|required|max_length[255]');
		$this->form_validation->set_rules('email', 'البريد الاكتروني' , 'trim|required|max_length[255]|valid_email');
		$this->form_validation->set_rules('type', 'الجنس' , 'trim|required|max_length[255]');
		$this->form_validation->set_rules('mobile', 'الجوال' , 'trim|required|max_length[25]|numeric');
		$this->form_validation->set_rules('date', 'اليوم' , 'trim|required|max_length[255]');
		if(in_array('DP',$this->sections))
		{
			$this->form_validation->set_rules('depart', 'القسم' , 'trim|required|max_length[255]');
			if(in_array('DR',$this->sections)) $this->form_validation->set_rules('doctor', 'الدكتور' , 'trim|required|max_length[255]');
		}
		if($this->form_validation->run() == FALSE)
		{
			$data['pageid'] = array_search('reservation', $this->pages['url']);
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
			$this->load->view('frontend/reservation',$data);
		}
		else
		{
			$this->load->library('notifications');
			$set_arr = array('rseid'=>0, 'rsname'=>set_value('name'), 'rsemail'=>set_value('email'), 'rstype'=>set_value('type'), 'rsmobile'=>set_value('mobile'), 'rsdate'=>strtotime(set_value('date')), 'rstime'=>time());
			if(in_array('DP',$this->sections))
			{
				$set_arr['rsdpid'] = set_value('depart');
				if(in_array('DR',$this->sections)) $set_arr['rsdrid'] = set_value('doctor');
			}
			$rsid = $this->Admin_mo->set('reservs', $set_arr);
			if(empty($rsid))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('reservation', 'refresh');
			}
			else
			{
				$this->notifications->addNotify(0,'RS',' اضاف حجز '.set_value('name'),'inner join usertypes on users.uutid = usertypes.utid where usertypes.utprivileges like "%,rssee,%" or usertypes.utprivileges like "%,rsedit,%"');
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('reservation', 'refresh');
			}
		}
		//redirect('about/add', 'refresh');
		}
		else
		{
			redirect('index', 'refresh');
		}
	}
	
	public function reservationlog()
	{
		if(in_array('RS',$this->sections) && ($this->session->userdata('uid') != FALSE || $this->input->cookie('uid', TRUE)))
		{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('date', 'اليوم' , 'trim|required|max_length[255]');
		if(in_array('DP',$this->sections))
		{
			$this->form_validation->set_rules('depart', 'القسم' , 'trim|required|max_length[255]');
			if(in_array('DR',$this->sections)) $this->form_validation->set_rules('doctor', 'الدكتور' , 'trim|required|max_length[255]');
		}
		if($this->form_validation->run() == FALSE)
		{
			$data['pageid'] = array_search('reservation', $this->pages['url']);
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
			$this->load->view('frontend/reservation',$data);
		}
		else
		{
			$this->load->library('notifications');
			if($this->session->userdata('uid') != FALSE) $uid = $this->session->userdata('uid');
			elseif($this->input->cookie('uid', TRUE)) $uid = $this->input->cookie('uid', TRUE);
			$set_arr = array('rseid'=>$uid, 'rsdate'=>strtotime(set_value('date')), 'rstime'=>time());
			if(in_array('DP',$this->sections))
			{
				$set_arr['rsdpid'] = set_value('depart');
				if(in_array('DR',$this->sections)) $set_arr['rsdrid'] = set_value('doctor');
			}
			$rsid = $this->Admin_mo->set('reservs', $set_arr);
			if(empty($rsid))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('reservation', 'refresh');
			}
			else
			{
				$this->notifications->addNotify($uid,'RS',' اضاف حجز '.set_value('name'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$uid.' and (usertypes.utprivileges like "%,rssee,%" or usertypes.utprivileges like "%,rsedit,%")');
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('reservation', 'refresh');
			}
		}
		//redirect('about/add', 'refresh');
		}
		else
		{
			redirect('index', 'refresh');
		}
	}

	public function sendmessage()
	{
		if(in_array('CT',$this->sections) && ($this->session->userdata('uid') == FALSE || !$this->input->cookie('uid', TRUE)))
		{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('name', 'الاسم' , 'trim|required|max_length[255]');
		$this->form_validation->set_rules('email', 'البريد الاكتروني' , 'trim|required|max_length[255]|valid_email');
		$this->form_validation->set_rules('mobile', 'الجوال' , 'trim|required|max_length[25]|numeric');
		$this->form_validation->set_rules('title', 'عنوان الرسالة' , 'trim|required|max_length[255]');
		$this->form_validation->set_rules('body', 'تفاصيل الرسالة' , 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$data['pageid'] = array_search('contact', $this->pages['url']);
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
			$this->load->view('frontend/contact',$data);
		}
		else
		{
			$this->load->library('notifications');
			$set_arr = array('mgeid'=>0, 'mgname'=>set_value('name'), 'mgemail'=>set_value('email'), 'mgmobile'=>set_value('mobile'), 'mgtitle'=>set_value('title'), 'mgbody'=>set_value('body'), 'mgtime'=>time());
			$mgid = $this->Admin_mo->set('messages', $set_arr);
			if(empty($mgid))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('contact', 'refresh');
			}
			else
			{
			$this->notifications->addNotify(0,'CT',' اضاف رسالة '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where usertypes.utprivileges like "%,ctsee,%" or usertypes.utprivileges like "%,ctedit,%"');
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('contact', 'refresh');
			}
		}
		}
		else
		{
			redirect('index', 'refresh');
		}
	}
	
	public function sendmessagelog()
	{
		if(in_array('CT',$this->sections) && ($this->session->userdata('uid') != FALSE || $this->input->cookie('uid', TRUE)))
		{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('title', 'عنوان الرسالة' , 'trim|required|max_length[255]');
		$this->form_validation->set_rules('body', 'تفاصيل الرسالة' , 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$data['pageid'] = array_search('contact', $this->pages['url']);
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
			$this->load->view('frontend/contact',$data);
		}
		else
		{
			$this->load->library('notifications');
			if($this->session->userdata('uid') != FALSE) $uid = $this->session->userdata('uid');
			elseif($this->input->cookie('uid', TRUE)) $uid = $this->input->cookie('uid', TRUE);
			$set_arr = array('mgeid'=>$this->session->userdata('uid'), 'mgtitle'=>set_value('title'), 'mgbody'=>set_value('body'), 'mgtime'=>time());
			$mgid = $this->Admin_mo->set('messages', $set_arr);
			if(empty($mgid))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('contact', 'refresh');
			}
			else
			{
			$this->notifications->addNotify($uid,'CT',' اضاف رسالة '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where users.uid <> '.$uid.' and (usertypes.utprivileges like "%,ctsee,%" or usertypes.utprivileges like "%,ctedit,%")');
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('contact', 'refresh');
			}
		}
		}
		else
		{
			redirect('index', 'refresh');
		}
	}
	
	public function userlog()
	{
		if(in_array('U',$this->sections) && ($this->session->userdata('uid') == FALSE || !$this->input->cookie('uid', TRUE)))
		{
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('username', 'اسم المستخدم' , 'trim|required|alpha|min_length[6]|max_length[255]');
			$this->form_validation->set_rules('password', 'كلمة المرور', 'trim|required|min_length[6]|max_length[255]');
			if($this->form_validation->run() == FALSE)
			{
				$data['pageid'] = array_search('login', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
				$this->load->view('frontend/login',$data);
			}
			else
			{
				$user = $this->Admin_mo->getrow('users',array('username like'=>set_value('username')));
				if(!empty($user))
				{
					if($user->uactive == '1')
					{
						if(password_verify(set_value('password'), $user->upassword))
						{
							if($user->uutid == 5)
							{
								if(set_value('remember') == 1) $this->input->set_cookie(array('name'=>'uid', 'value'=>$user->uid, 'expire'=>time()+86500, 'path'=>'/'));
								$this->session->set_userdata('uid', $user->uid);
								redirect('index', 'refresh');
							}
							else $data['activemessage'] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>هذا المستخدم ليس له صلاحيات الدخول</div>';
						}
						else $data['activemessage'] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>كلمة المرور خطأ</div>';
					}
					else $data['activemessage'] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>هذا المستخدم غير مفعل</div>';
				}
				else $data['activemessage'] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>هذا المستخدم غير موجود</div>';
				$this->load->view('frontend/login',$data);
			}
		}
		else
		{
			redirect('index', 'refresh');
		}
	}

	public function logout()
	{
		unset($_SESSION['uid']);
		delete_cookie("uid");
		redirect('index', 'refresh');
	}

	public function register()
	{
		if(in_array('U',$this->sections) && ($this->session->userdata('uid') == FALSE || !$this->input->cookie('uid', TRUE)))
		{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('name', 'الاسم كاملا' , 'trim|required|max_length[255]|is_unique[users.username]');
		$this->form_validation->set_rules('username', 'اسم المستخدم' , 'trim|required|alpha|min_length[6]|max_length[255]|is_unique[users.uname]');
		$this->form_validation->set_rules('email', 'البريد الاكتروني' , 'trim|required|max_length[255]|valid_email|is_unique[users.uemail]');
		$this->form_validation->set_rules('mobile', 'الجوال' , 'trim|required|max_length[25]|numeric');
		$this->form_validation->set_rules('address', 'العنوان' , 'trim|required|max_length[255]');
		$this->form_validation->set_rules('birthday', 'تاريخ الميلاد' , 'trim|required|max_length[25]');
		$this->form_validation->set_rules('type', 'الجنس' , 'trim|required|max_length[25]');
		$this->form_validation->set_rules('password', 'كلمة المرور', 'trim|required|min_length[6]|max_length[255]');
		$this->form_validation->set_rules('cnfpassword', 'تاكيد كلمة المرور', 'trim|required|matches[password]');
		if($this->form_validation->run() == FALSE)
		{
			$data['pageid'] = array_search('registration', $this->pages['url']);
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$data['departs'] = $this->Admin_mo->getwhere('departs',array('dpactive'=>'1'));
			$this->load->view('frontend/registration',$data);
		}
		else
		{
			$verificationCode = mt_rand(11111,99999);
			if($this->sendemail(set_value('email'),'Activation','Activation link: '.base_url().'/active/'.set_value('username').'/'.$verificationCode))
			{
				$this->load->library('notifications');
				$set_arr = array('uutid'=>5, 'uname'=>set_value('name'), 'username'=>set_value('username'), 'uemail'=>set_value('email'), 'uphone'=>set_value('mobile'), 'ubirthday'=>set_value('birthday'), 'utype'=>set_value('type'), 'uaddress'=>set_value('address'), 'upassword'=>password_hash(set_value('password'), PASSWORD_BCRYPT, array('cost'=>10)), 'ucode'=>$verificationCode, 'utime'=>time());
				$uid = $this->Admin_mo->set('users', $set_arr);
				if(empty($uid))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					redirect('registration', 'refresh');
				}
				else
				{
					$this->notifications->addNotify(0,'U',' اضاف المستخدم '.set_value('name'),'inner join usertypes on users.uutid = usertypes.utid where usertypes.utprivileges like "%,usee,%" or usertypes.utprivileges like "%,uadd,%"');
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					redirect('registration', 'refresh');
				}
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('registration', 'refresh');
			}
		}
		}
		else
		{
			redirect('index', 'refresh');
		}
	}
	
	public function active($username,$code)
	{
		if(in_array('U',$this->sections) && ($this->session->userdata('uid') == FALSE || !$this->input->cookie('uid', TRUE)))
		{
			$data['admessage'] = '';
			$data['pageid'] = array_search('login', $this->pages['url']);
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$user = $this->Admin_mo->getrow('users',array('username like'=>$username));
			if(!empty($user))
			{
				if($user->uactive != '1')
				{
					if($user->ucode == $code)
					{
						if($this->Admin_mo->update('users',array('ucode'=>'','uactive'=>'1'),array('username like'=>$username,'ucode'=>$code,'uactive'=>'0'))) $data['activemessage'] = '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>تم التفعيل بنجاح</div>';
						else $data['activemessage'] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>هناك خطا ما</div>';
					}
					else $data['activemessage'] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>الكود خطأ</div>';
				}
				else $data['activemessage'] = '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>هذا المستخدم مفعل</div>';
			}
			else $data['activemessage'] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>هذا المستخدم غير موجود</div>';
			$this->load->view('frontend/login',$data);
		}
		else redirect('index', 'refresh');
	}
	
	public function sendemail($email,$subject,$body)
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
		$mail->AddAddress($email);
		$mail->Subject    = $subject;
		//$mail->AltBody    = "You can active your account on : "; // optional, comment out and test
		$mail->Body    = $body;
		if($mail->Send()) return 1;
		else return 0;
	}
}