<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

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
		redirect('home', 'refresh');
	}

	public function type()
	{
		$system = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$arr = array();
		if($_POST['val'] == 'D')
		{
			if($system->calendar == 'hj')
			{
				$arr['from'] = '<input type="text" min="1438-01-01" max="1475-01-01" pattern="[0-9]{4}.(0[1-9]|1[012]).(0[1-9]|1[0-9]|2[0-9]|3[01])" title="برجاء كتابة التاريخ بشكل صحيح" placeholder="YYYY-MM-DD" class="form-control" name="from" />';
				$arr['to'] = '<input type="text" min="1438-01-01" max="1475-01-01" pattern="[0-9]{4}.(0[1-9]|1[012]).(0[1-9]|1[0-9]|2[0-9]|3[01])" title="برجاء كتابة التاريخ بشكل صحيح" placeholder="YYYY-MM-DD" class="form-control" name="to" />';
			}
			else
			{
				$arr['from'] = '<input type="date" class="form-control" name="from" />';
				$arr['to'] = '<input type="date" class="form-control" name="to" />';
			}
		}
		elseif($_POST['val'] == 'M')
		{
			$arr['from'] = '<select class="form-control" name="from" id="from"><option value="">اختر</option>';
			for($m=1;$m<13;$m++) { $arr['from'] .= '<option value="'.$m.'">'.$m.'</option>'; }
			$arr['from'] .= '</select>';
			$arr['to'] = '<select class="form-control" name="to" id="to"><option value="">اختر</option>';
			for($m=1;$m<13;$m++) { $arr['to'] .= '<option value="'.$m.'">'.$m.'</option>'; }
			$arr['to'] .= '</select>';
		}
		elseif($_POST['val'] == 'Y')
		{
			if($system->calendar == 'hj')
			{
				$arr['from'] = '<select class="form-control" name="from" id="from"><option value="">اختر</option>';
				for($y=1438;$y<1475;$y++) { $arr['from'] .= '<option value="'.$y.'">'.$y.'</option>'; }
				$arr['from'] .= '</select>';
				$arr['to'] = '<select class="form-control" name="to" id="to"><option value="">اختر</option>';
				for($y=1438;$y<1475;$y++) { $arr['to'] .= '<option value="'.$y.'">'.$y.'</option>'; }
				$arr['to'] .= '</select>';
			}
			else
			{
				$arr['from'] = '<select class="form-control" name="from" id="from"><option value="">اختر</option>';
				for($y=2016;$y<2050;$y++) { $arr['from'] .= '<option value="'.$y.'">'.$y.'</option>'; }
				$arr['from'] .= '</select>';
				$arr['to'] = '<select class="form-control" name="to" id="to"><option value="">اختر</option>';
				for($y=2016;$y<2050;$y++) { $arr['to'] .= '<option value="'.$y.'">'.$y.'</option>'; }
				$arr['to'] .= '</select>';
			}
		}
		echo json_encode($arr);
		//echo 1;
		//print_r($arr);
	}
	
	public function getstores()
	{
		$stores = $this->Admin_mo->get('itemtypes');
		if(!empty($stores))
		{
			echo ' <div id="storesdiv"><label for="store" class="control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12">المخزن</label><div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12"><select class="form-control" name="store[]" multiple>';
			foreach($stores as $store)
			{
				echo '<option value="'.$store->itid.'">'.$store->itname.'</option>';
			}
			echo '</select></div></div>';
		}
		else echo '';
	}

	public function statistics()
	{
		if(strpos($this->loginuser->privileges, ',staticsreport,') !== false)
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['title'] = 'statistics';
		$data['admessage'] = '';
		$this->lang->load('reports', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/reports',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/statistics',$data);
		$this->load->view('footers/reports');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else redirect('home', 'refresh');
	}
	
	public function statistics_pdf()
	{
		if(strpos($this->loginuser->privileges, ',generalreport,') !== false)
		{
			$this->form_validation->set_rules('type', 'Type' , 'trim|required');
			$this->form_validation->set_rules('orderby', 'Order By' , 'trim|required');
			if($this->form_validation->run() == FALSE)
			{
				$data['admessage'] = 'validation error';
				$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
				redirect('reports/statistics', 'refresh');
			}
			else
			{
				if(set_value('no') == '') $no = 0;
				else $no = set_value('no');

				if(set_value('type') == 'UT') $file = 'susertypes_pdf';
				elseif(set_value('type') == 'U') $file = 'susers_pdf';
				elseif(set_value('type') == 'BC') $file = 'sbranches_pdf';
				elseif(set_value('type') == 'C') redirect('../fanarab_pdfs/scustomers_pdf/'.set_value('orderby').'/'.$no, 'refresh');
				elseif(set_value('type') == 'D') $file = 'sdelegates_pdf';
				elseif(set_value('type') == 'IT') $file = 'sitemtypes_pdf';
				elseif(set_value('type') == 'IM') $file = 'sitemmodels_pdf';
				elseif(set_value('type') == 'I') { if(set_value('store') == '') $store = 0; else $store = implode(',',set_value('store')); redirect('../fanarab_pdfs/sitems_pdf/'.set_value('orderby').'/'.$no.'/'.$store, 'refresh'); }
			}
		}
		else redirect('home', 'refresh');
	}

	public function general()
	{
		if(strpos($this->loginuser->privileges, ',generalreport,') !== false)
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['title'] = 'generalreport';
		$data['admessage'] = '';
		$this->lang->load('reports', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/reports',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/generalr',$data);
		$this->load->view('footers/reports');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else redirect('home', 'refresh');
	}

	public function general_pdf()
	{
		if(strpos($this->loginuser->privileges, ',generalreport,') !== false)
		{
			$this->form_validation->set_rules('type', 'Type' , 'trim|required');
			if($this->form_validation->run() == FALSE)
			{
				$data['admessage'] = 'validation error';
				$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
				redirect('reports/general', 'refresh');
			}
			else
			{
				if(set_value('type') == 'UT') $file = 'gusertypes_pdf';
				elseif(set_value('type') == 'U') $file = 'gusers_pdf';
				elseif(set_value('type') == 'BC') $file = 'gbranches_pdf';
				elseif(set_value('type') == 'C') $file = 'gcustomers_pdf';
				elseif(set_value('type') == 'D') $file = 'gdelegates_pdf';
				elseif(set_value('type') == 'IT') $file = 'gitemtypes_pdf';
				elseif(set_value('type') == 'IM') $file = 'gitemmodels_pdf';
				redirect('../fanarab_pdfs/'.$file, 'refresh');
			}
		}
		else redirect('home', 'refresh');
	}
	
	public function incomes()
	{
		if(strpos($this->loginuser->privileges, ',incomesreport,') !== false)
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['title'] = 'incomes';
		$data['admessage'] = '';
		$this->lang->load('reports', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['branches'] = $this->Admin_mo->get('branches');
		$this->load->view('headers/reports',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/incomes',$data);
		$this->load->view('footers/reports');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else redirect('home', 'refresh');
	}

	public function incomes_pdf()
	{
		if(strpos($this->loginuser->privileges, ',incomesreport,') !== false)
		{
			$this->form_validation->set_rules('type', 'Type' , 'trim|required');
			if($this->form_validation->run() == FALSE)
			{
				$data['admessage'] = 'validation error';
				$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
				redirect('reports/incomes', 'refresh');
			}
			else
			{
				if(set_value('from') == '') $from = 0; else $from = set_value('from');
				if(set_value('to') == '') $to = 0; else $to = set_value('to');
				redirect('../fanarab_pdfs/incomes_pdf/'.set_value('type').'/'.$from.'/'.$to.'/'.set_value('branch'), 'refresh');
			}
		}
		else redirect('home', 'refresh');
	}

	public function outcomes()
	{
		if(strpos($this->loginuser->privileges, ',outcomesreport,') !== false)
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['title'] = 'outcomes';
		$data['admessage'] = '';
		$this->lang->load('reports', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['branches'] = $this->Admin_mo->get('branches');
		$data['itemtypes'] = $this->Admin_mo->get('itemtypes');
		$this->load->view('headers/reports',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/outcomes',$data);
		$this->load->view('footers/reports');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else redirect('home', 'refresh');
	}

	public function outcomes_pdf()
	{
		if(strpos($this->loginuser->privileges, ',outcomesreport,') !== false)
		{
			$this->form_validation->set_rules('type', 'Type' , 'trim|required');
			if($this->form_validation->run() == FALSE)
			{
				$data['admessage'] = 'validation error';
				$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
				redirect('reports/outcomes', 'refresh');
			}
			else
			{
				if(set_value('from') == '') $from = 0; else $from = set_value('from');
				if(set_value('to') == '') $to = 0; else $to = set_value('to');
				redirect('../fanarab_pdfs/outcomes_pdf/'.set_value('type').'/'.$from.'/'.$to.'/'.set_value('branch'), 'refresh');
			}
		}
		else redirect('home', 'refresh');
	}
	
	public function stores()
	{
		if(strpos($this->loginuser->privileges, ',itreport,') !== false)
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['title'] = 'itemtypes';
		$data['admessage'] = '';
		$this->lang->load('reports', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['stores'] = $this->Admin_mo->get('itemtypes');
		$this->load->view('headers/reports',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/stores',$data);
		$this->load->view('footers/reports');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else redirect('home', 'refresh');
	}
	
	public function stores_pdf()
	{
		if(strpos($this->loginuser->privileges, ',itreport,') !== false)
		{
			redirect('../fanarab_pdfs/stores_pdf/'.set_value('store'), 'refresh');
		}
		else redirect('home', 'refresh');
	}
	
	public function bills()
	{
		if(strpos($this->loginuser->privileges, ',breport,') !== false)
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['title'] = 'bills';
		$data['admessage'] = '';
		$this->lang->load('reports', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['branches'] = $this->Admin_mo->get('branches');
		$this->load->view('headers/reports',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/billsr',$data);
		$this->load->view('footers/reports');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else redirect('home', 'refresh');
	}

	public function bills_pdf()
	{
		if(strpos($this->loginuser->privileges, ',breport,') !== false)
		{
			$this->form_validation->set_rules('type', 'Type' , 'trim|required');
			if($this->form_validation->run() == FALSE)
			{
				$data['admessage'] = 'validation error';
				$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
				redirect('reports/bills', 'refresh');
			}
			else
			{
				if(set_value('from') == '') $from = 0; else $from = set_value('from');
				if(set_value('to') == '') $to = 0; else $to = set_value('to');
				redirect('../fanarab_pdfs/bills_pdf/'.set_value('type').'/'.$from.'/'.$to.'/'.set_value('branch'), 'refresh');
			}
		}
		else redirect('home', 'refresh');
	}
	
	public function orders()
	{
		if(strpos($this->loginuser->privileges, ',oreport,') !== false)
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['title'] = 'orders';
		$data['admessage'] = '';
		$this->lang->load('reports', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['branches'] = $this->Admin_mo->get('branches');
		$this->load->view('headers/reports',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/ordersr',$data);
		$this->load->view('footers/reports');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else redirect('home', 'refresh');
	}

	public function orders_pdf()
	{
		if(strpos($this->loginuser->privileges, ',oreport,') !== false)
		{
			$this->form_validation->set_rules('type', 'Type' , 'trim|required');
			if($this->form_validation->run() == FALSE)
			{
				$data['admessage'] = 'validation error';
				$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
				redirect('reports/orders', 'refresh');
			}
			else
			{
				if(set_value('from') == '') $from = 0; else $from = set_value('from');
				if(set_value('to') == '') $to = 0; else $to = set_value('to');
				redirect('../fanarab_pdfs/orders_pdf/'.set_value('type').'/'.$from.'/'.$to.'/'.set_value('branch'), 'refresh');
			}
		}
		else redirect('home', 'refresh');
	}
}