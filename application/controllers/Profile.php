<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
		$this->lang->load('profile', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['nots'] = $this->Admin_mo->rate('*','logsystem','where user = '.$this->session->userdata('uid').' group by action,time order by time DESC');
		$data['PVs'] = $this->Admin_mo->mycount('logsystem','where user = '.$this->session->userdata('uid').' and section like "PV%" group by action,time','');
		$data['ORs'] = $this->Admin_mo->mycount('logsystem','where user = '.$this->session->userdata('uid').' and section like "OR%" group by action,time','');
		$data['JOa'] = $this->Admin_mo->mycount('logsystem','where user = '.$this->session->userdata('uid').' and section like "JO%" group by action,time','');
		$data['BLs'] = $this->Admin_mo->mycount('logsystem','where user = '.$this->session->userdata('uid').' and section like "BL%" group by action,time','');
		$data['NTs'] = $this->Admin_mo->mycount('logsystem','where user = '.$this->session->userdata('uid').' and section like "" group by action,time','');
		$data['NTcount'] = $this->Admin_mo->mycount('logsystem','where user = '.$this->session->userdata('uid').' group by action,time','');
		$data['user'] = $this->Admin_mo->getrowjoinLeftLimit('users.uphone as phone,users.uaddress as address,users.uemail as email,usertypes.utname as utname','users',array('usertypes'=>'users.uutid = usertypes.utid'),array('users.uid'=>$this->session->userdata('uid')),'');
		$this->load->view('calenderdate');
		$this->load->view('headers/profile',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/profile',$data);
		$this->load->view('footers/profile');
		$this->load->view('notifys');
		$this->load->view('messages');
	}
}