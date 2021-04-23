<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

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
		if(strpos($this->loginuser->privileges, ',osee,') !== false)
		{
		if($this->loginuser->ubcid != '')
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['admessage'] = '';
		$this->lang->load('orders', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		$data['preporders'] = $this->Admin_mo->getjoinLeft('orders.*,joborders.joitem as joitem,joborders.joprice as joprice,joborders.joquantity as joquantity,joborders.accept as joaccept,branches.bcname as branch,customers.cname as customer,items.iname as item','orders',array('branches'=>'branches.bcid = orders.obcid','customers'=>'customers.cid = orders.ocid','joborders'=>'joborders.jooid = orders.oid','items'=>'items.iid = joborders.joiid'),'orders.obcid IN ('.substr($this->loginuser->ubcid,1,-1).')');
		if(!empty($data['preporders']))
		{
			for($i=0;$i<count($data['preporders']);$i++)
			{
				//$data['orders'][$data['preporders'][$i]->oid] = new stdClass();
				$data['orders'][$data['preporders'][$i]->oid]['oid'] = $data['preporders'][$i]->oid;
				$data['orders'][$data['preporders'][$i]->oid]['ouid'] = $data['preporders'][$i]->ouid;
				$data['orders'][$data['preporders'][$i]->oid]['ocode'] = $data['preporders'][$i]->ocode;
				$data['orders'][$data['preporders'][$i]->oid]['otime'] = $data['preporders'][$i]->otime;
				$data['orders'][$data['preporders'][$i]->oid]['branch'] = $data['preporders'][$i]->branch;
				$data['orders'][$data['preporders'][$i]->oid]['customer'] = $data['preporders'][$i]->customer;
				$data['orders'][$data['preporders'][$i]->oid]['endtime'] = $data['preporders'][$i]->endtime;
				$data['orders'][$data['preporders'][$i]->oid]['notes'] = $data['preporders'][$i]->notes;
				$data['orders'][$data['preporders'][$i]->oid]['billdone'] = $data['preporders'][$i]->billdone;
				$data['orders'][$data['preporders'][$i]->oid]['wvdone'] = $data['preporders'][$i]->wvdone;
				$data['orders'][$data['preporders'][$i]->oid]['accept'] = $data['preporders'][$i]->accept;
				$data['orders'][$data['preporders'][$i]->oid]['items'][$i]['item'] = $data['preporders'][$i]->item;
				$data['orders'][$data['preporders'][$i]->oid]['items'][$i]['joitem'] = $data['preporders'][$i]->joitem;
				$data['orders'][$data['preporders'][$i]->oid]['items'][$i]['price'] = $data['preporders'][$i]->joprice;
				$data['orders'][$data['preporders'][$i]->oid]['items'][$i]['quantity'] = $data['preporders'][$i]->joquantity;
				$data['orders'][$data['preporders'][$i]->oid]['items'][$i]['joaccept'] = $data['preporders'][$i]->joaccept;
			}
		}
		$this->load->view('calenderdate');
		$this->load->view('headers/orders',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/orders',$data);
		$this->load->view('footers/orders');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['title'] = 'orders';
		$data['admessage'] = 'youhavenobranch';
		$this->lang->load('orders', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/orders',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/orders');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['title'] = 'orders';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('orders', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/orders',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/orders');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}

	public function getbill()
	{
		if($_POST['bill'] != '' && $_POST['bill'] != ' ')
		{
			$this->lang->load('bills', 'arabic');
			$this->load->view('calenderdate');
			$system = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$preorder = $this->Admin_mo->getjoinLeft('bills.*,users.uname as employee,users.uphone as uphone,customers.cname as customer,customers.cphone as cphone,orders.oid as oid,orders.notes as onotes,orders.otime as otime,joborders.joitem as joitem,joborders.joprice as joprice,joborders.joquantity as joquantity,joborders.addtobill as addtobill,items.iname as item','bills',array('orders'=>'orders.oid = bills.boid','users'=>'bills.beid = users.uid','customers'=>'orders.ocid = customers.cid','joborders'=>'joborders.jooid = orders.oid','items'=>'items.iid = joborders.joiid'),array('bills.boid'=>$_POST['bill'],'bills.accept'=>'1'));
			if(!empty($preorder))
			{
				$paymentmethod = array(1=>lang('atm'),2=>lang('banktransfer'),3=>lang('cash'));
				$billtype = array(1=>lang('normal'),2=>lang('vip'));

				for($i=0;$i<count($preorder);$i++)
				{
					$bill['bid'] = $preorder[$i]->bid;
					$bill['customer'] = $preorder[$i]->customer;
					$bill['cphone'] = $preorder[$i]->cphone;
					$bill['employee'] = $preorder[$i]->employee;
					$bill['phone'] = $preorder[$i]->uphone;
					$bill['oid'] = $preorder[$i]->oid;
					$bill['code'] = $preorder[$i]->bcode;
					$bill['btime'] = $preorder[$i]->btime;
					$bill['bnotes'] = $preorder[$i]->notes;
					$bill['total'] = $preorder[$i]->btotal;
					$bill['newtotal'] = $preorder[$i]->bnewtotal;
					$bill['discount'] = $preorder[$i]->bdiscount;
					$bill['bpaytype'] = $preorder[$i]->bpaytype;
					$bill['btype'] = $preorder[$i]->btype;
					$bill['pay'] = $preorder[$i]->bpay;
					$bill['rest'] = $preorder[$i]->brest;
					$bill['onotes'] = $preorder[$i]->onotes;
					$bill['accept'] = $preorder[$i]->accept;
					if($preorder[$i]->addtobill == '1')
					{
						$bill['items'][$i]['item'] = $preorder[$i]->item;
						$bill['items'][$i]['joitem'] = $preorder[$i]->joitem;
						$bill['items'][$i]['price'] = $preorder[$i]->joprice;
						$bill['items'][$i]['quantity'] = $preorder[$i]->joquantity;
					}
				}

				if($bill['discount'] == '') $bill['discount'] = '00.00';
				if($bill['rest'] == '') $bill['rest'] = '00.00';

				if($bill['btime'] != '') { if(date('H', $bill['btime']) < 12) $time = date('h-i-s', $bill['btime']).' '.lang('am'); else $time = date('h-i-s', $bill['btime']).' '.lang('pm'); }
				else $time = '';
				
				echo '
					<table class="table table-striped table-bordered"  dir="rtl">
						<tbody>
							<tr>
                                <td>'.lang('number').' '.lang('bill').'</td>
                                <td>'.$bill['oid'].'</td>
								<td>'.lang('code').'</td>
                                <td><img src="barcode/barcode.php?codetype=Code39&size=55&text='.$bill['code'].'" /></td>
                              </tr>
							  <tr>
                                <td>'.lang('day').'</td>
                                <td>'.ArabicTools::arabicDate($system->calendar.' Y-m-d', $bill['btime']).'</td>
								<td>'.lang('time').'</td>
                                <td>'.$time.'</td>
                              </tr>
							  <tr></tr>
                              <tr>
                                <td>'.lang('customer').'</td>
                                <td>'.$bill['customer'].'</td>
								<td>'.lang('mobile').'</td>
                                <td>'.$bill['cphone'].'</td>
                              </tr>
							  <tr>
                                <td>'.lang('paymentmetdod').'</td>
                                <td>'.$paymentmethod[$bill['bpaytype']].'</td>
								<td>'.lang('billtype').'</td>
                                <td>'.$billtype[$bill['btype']].'</td>
                              </tr>
						</tbody>
					</table>
				';
				if(!empty($bill['items']))
				{
					echo '
						<table class="table table-striped table-bordered"  dir="rtl">
                            <thead>
                              <tr>
                                <td width="39%">'.lang('info').'</td>
                                <td width="17%">'.lang('quantity').'</td>
                                <td>'.lang('price').'</td>
                              </tr>
                            </thead>
                            <tbody>
					';
					foreach($bill['items'] as $item)
					{
						echo '
							<tr>
                                <td width="39%">'.$item['item'].$item['joitem'].'</td>
                                <td width="17%">'.$item['quantity'].'</td>
                                <td>'.$item['price'].' '.$system->currency.'</td>
                            </tr>
						';
					}
					echo '</tbody></table>';
				}
				echo'
						<table class="table table-striped table-bordered"  dir="rtl">
                              <tr>
                                <td>'.lang('total').'</td>
                                <td>'.$bill['total'].' '.$system->currency.'</td>
                              </tr>
							   <tr>
                                <td>'.lang('mustpay').'</td>
                                <td>'.number_format(($bill['newtotal']-$bill['discount']),2).' '.$system->currency.'</td>
                              </tr>
							  <tr>
                                <td>'.lang('discount').'</td>
                                <td>'.$bill['discount'].' '.$system->currency.'</td>
                              </tr>
							  <tr>
                                <td>'.lang('payed').'</td>
                                <td>'.$bill['pay'].' '.$system->currency.'</td>
                              </tr>
							  <tr>
                                <td>'.lang('rest').'</td>
                                <td>'.$bill['rest'].' '.$system->currency.'</td>
                              </tr>
                          </table>
				';
				echo '
						<table class="table table-striped table-bordered"  dir="rtl">
                              <tr>
                                <td>'.lang('employee').'</td>
                                <td>'.$bill['employee'].'</td>
                              </tr>
							  <tr>
                                <td>'. lang('mobile').'</td>
                                <td>'.$bill['phone'].'</td>
                              </tr>
                          </table>
				';
			}
			else echo lang('no_data');
		}
		else echo lang('no_data');
	}
	
	public function getwithdrowvouchers()
	{
		if($_POST['order'] != '' && $_POST['order'] != ' ')
		{
			$this->lang->load('orders', 'arabic');
			$this->load->view('calenderdate');
			$system = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$withdrowvouchers = $this->Admin_mo->getwhere('withdrowvouchers',array('wvoid'=>$_POST['order']));
			if(!empty($withdrowvouchers))
			{
				echo '
					<table id="datatable-buttons" class="table table-striped table-bordered"  dir="rtl">
						<thead>
							<tr>
								<td>'.lang('number').'</td>
								<td>'.lang('payment').'</td>
								<td>'.lang('time').'</td>
							</tr>
						</thead>
						<tbody>
				';
				foreach($withdrowvouchers as $withdrowvoucher)
				{
					if(date('H',$withdrowvoucher->wvtime) < 12) $time = ' '.lang('am'); else $time = ' '.lang('pm');
					echo '
						<tr>
							<td>'.$withdrowvoucher->wvid.'</td>
							<td>'.$withdrowvoucher->wvtotal.' '.$system->currency.'</td>
							<td>'.ArabicTools::arabicDate($system->calendar.' Y-m-d', $withdrowvoucher->wvtime).' , '.date('h:i:s', $withdrowvoucher->wvtime).' '.$time.'</td>
						</tr>
					';
				}
				echo '</tbody></table>';
			}
			else echo lang('no_data');
		}
		else echo lang('no_data');
	}

	public function getitems($name)
	{
		$response = '';
		if($name != '' || $name != ' ')
		{
			$items = $this->Admin_mo->rate('*','items',' where iname like "'.$name.'%" or icode like "'.$name.'%"');
			foreach($items as $item)
			{
				$response .= '<option value="'.$item->iname.'">'; 
			}
			echo $response;
		}
		else echo $response;
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',oadd,') !== false)
		{
		if($this->loginuser->ubcid != '')
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['admessage'] = '';
		$this->lang->load('orders', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['branches'] = $this->Admin_mo->rate('*','branches','where active = "1" and bcid IN ('.substr($this->loginuser->ubcid,1,-1).')');
		$data['usertypes'] = $this->Admin_mo->getwhere('usertypes',array('active'=>'1'));
		$data['items'] = $this->Admin_mo->getjoinLeft('items.*,itemtypes.itname as store','items',array('itemtypes'=>'items.iitid = itemtypes.itid'),array('items.active'=>'1'));
		$data['customers'] = $this->Admin_mo->getwhere('customers',array('active'=>'1'));
		$this->load->view('headers/order-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/order-add',$data);
		$this->load->view('footers/order-add');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['title'] = 'orders';
		$data['admessage'] = 'youhavenobranch';
		$this->lang->load('orders', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/orders',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/orders');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['title'] = 'orders';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('orders', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/orders',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/orders');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',oadd,') !== false)
		{
		$system = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$data['items'] = $this->Admin_mo->rate('iid,iname,iitid','items','');
		$data['customers'] = $this->Admin_mo->rate('cid,cname','customers','');
		$items = array(); $stores = array(); foreach($data['items'] as $item) { $items[$item->iid] = $item->iname; $stores[$item->iid] = $item->iitid; }
		$customers = array();  foreach($data['customers'] as $customer) { $customers[$customer->cid] = $customer->cname; }

		$this->form_validation->set_rules('customer', 'Customer' , 'trim|required');
		$this->form_validation->set_rules('branch', 'Branch' , 'trim|required');
		$this->form_validation->set_rules('total', 'Total' , 'trim|required');
		//$this->form_validation->set_rules('code', 'Code' , 'trim|required|max_length[255]|is_unique[orders.ocode]');
		$this->form_validation->set_rules('item[]', 'Item' , 'trim|required');
		$this->form_validation->set_rules('price[]', 'Price' , 'trim|required|max_length[11]|decimal');
		$this->form_validation->set_rules('quantity[]', 'Quantity' , 'trim|required|max_length[11]|integer');
		$this->form_validation->set_rules('usertype[]', 'Usertype' , 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$data['admessage'] = 'validation error';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
		}
		else
		{
			$this->load->library('arabictools');
			//print_r(set_value('addtobill'));
			if(set_value('enddate') != '') { if($system->calendar == 'hj') $date = $this->arabictools->arabicDate('ar Y-m-d', strtotime($this->arabictools->dateHejri2Geo(set_value('enddate')))); else $date = set_value('enddate'); } else $date = date('Y-m-d');
			if(set_value('endtime') != '') $time = set_value('endtime'); else $time = '17:00';

			if($this->loginuser->ubcid != '' && strpos($this->loginuser->ubcid,set_value('branch')))
			{
			if(!in_array(set_value('customer'), $customers))	$cid = $this->Admin_mo->set('customers', array('cuid'=>$this->session->userdata('uid'),'cname'=>set_value('customer'),'cctime'=>time(),'active'=>'1'));
			else $cid = array_search(set_value('customer'), $customers);

			$data['oid'] = $this->Admin_mo->set('orders', array('ouid'=>$this->session->userdata('uid'), 'obcid'=>set_value('branch'), 'ocid'=>$cid, 'endtime'=>strtotime($date.$time), 'notes'=>set_value('notes'), 'accept'=>'4', 'total'=>set_value('total'), 'date'=>date('Y-m-d'), 'hdate'=>$this->arabictools->arabicDate('hj Y-m-d', time()), 'otime'=>time()));
			if(empty($data['oid'])) { $data['admessage'] = 'Not Saved'; $_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong'; }
			else
			{
				$this->load->library('notifications');
				$this->notifications->addNotify($this->session->userdata('uid'),'OR'.set_value('branch'),' اضاف امر شغل رقم '.$data['oid'],'where uid <> '.$this->session->userdata('uid').' and (uutid = 1 or privileges like "%,osee,%" or privileges like "%,oadd,%") and ubcid like "%,'.set_value('branch').',%"');

				$code = 'OR'.$data['oid'].'C'.$cid.'U'.$this->session->userdata('uid');
				$this->Admin_mo->update('orders', array('ocode'=>$code),array('oid'=>$data['oid']));
				$total = 00.00;
				for($i=0;$i<count(set_value('item'));$i++)
				{
					if(set_value('addtobill')[$i] == '1') $total = number_format($total+set_value('price')[$i], 2);
					if(in_array(set_value('item')[$i], $items))
					{
						$joid = $this->Admin_mo->set('joborders', array('jooid'=>$data['oid'],'joutid'=>set_value('usertype')[$i],'joiid'=>array_search(set_value('item')[$i], $items), 'joprice'=>set_value('price')[$i], 'joquantity'=>set_value('quantity')[$i], 'addtobill'=>set_value('addtobill')[$i], 'jotime'=>time(), 'accept'=>'4'));
						if($joid)
						{
							$pvid = $this->Admin_mo->set('paymentvouchers', array('pvuid'=>$this->session->userdata('uid'), 'pvoid'=>$data['oid'], 'pvjoid'=>$joid, 'pviid'=>array_search(set_value('item')[$i], $items), 'pvquantity'=>set_value('quantity')[$i], 'pvtime'=>time()));
							$this->notifications->addNotify($this->session->userdata('uid'),'PV'.$stores[array_search(set_value('item')[$i], $items)],' اضاف سند صرف رقم '.$pvid,'where uid <> '.$this->session->userdata('uid').' and (uutid = 1 or privileges like "%,pvsee,%" or privileges like "%,pvedit,%") and uitid like "%,'.$stores[array_search(set_value('item')[$i], $items)].'%"');
						}
					}
					else
					{
						$joid = $this->Admin_mo->set('joborders', array('jooid'=>$data['oid'],'joutid'=>set_value('usertype')[$i],'joitem'=>set_value('item')[$i], 'joprice'=>set_value('price')[$i], 'joquantity'=>set_value('quantity')[$i], 'addtobill'=>set_value('addtobill')[$i], 'jotime'=>time(), 'accept'=>'3'));
					}
					$this->notifications->addNotify($this->session->userdata('uid'),'JO'.set_value('branch'),' اضاف متابعة امر شغل رقم '.$joid,'where uid <> '.$this->session->userdata('uid').' and (uutid = 1 or privileges like "%,josee,%" or privileges like "%,joedit,%") and ubcid like "%,'.set_value('branch').',%"');
				}
				$this->Admin_mo->set('bills', array('boid'=>$data['oid'],'btotal'=>$total,'bnewtotal'=>$total,'accept'=>'3'));
				$this->notifications->addNotify($this->session->userdata('uid'),'BL'.set_value('branch'),' اضاف فاتورة رقم '.$data['oid'],'where uid <> '.$this->session->userdata('uid').' and (uutid = 1 or privileges like "%,bsee,%" or privileges like "%,bedit,%" or privileges like "%,bprint,%") and ubcid like "%,'.set_value('branch').',%"');
				$data['admessage'] = 'Successfully Saved';
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			}
			}
			else { $data['admessage'] = 'Not Saved'; $_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong'; }
		}
		//redirect('orders', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['title'] = 'orders';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('orders', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/orders',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/orders');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',oedit,') !== false)
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$id = abs((int)($id));
		$data['order'] = $this->Admin_mo->getrow('orders',array('oid'=>$id,'accept'=>'3'));
		if(!empty($data['order']))
		{
			$data['admessage'] = '';
			$this->lang->load('orders', 'arabic');
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['items'] = $this->Admin_mo->getwhere('items',array('active'=>'1'));
			$data['customers'] = $this->Admin_mo->getwhere('customers',array('active'=>'1'));
			$data['orderitems'] = $this->Admin_mo->getwhere('orderitems',array('oioid'=>$id));
			$this->load->view('headers/order-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/order-edit',$data);
			$this->load->view('footers/order-edit');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else redirect('orders', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['title'] = 'orders';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('orders', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/orders',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/orders');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function editorder($id)
	{
		if(strpos($this->loginuser->privileges, ',oedit,') !== false)
		{
		$id = abs((int)($id));
		if($id != '')
		{
			$this->form_validation->set_rules('customer', 'Customer' , 'trim|required');
			$this->form_validation->set_rules('code', 'Code' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('item[]', 'Item' , 'trim|required');
			$this->form_validation->set_rules('price[]', 'Price' , 'trim|required|max_length[11]|decimal');
			$this->form_validation->set_rules('quantity[]', 'Quantity' , 'trim|required|max_length[11]|integer');
			if($this->form_validation->run() == FALSE)
			{
				$data['admessage'] = 'validation error';
				$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			}
			else
			{
				if($this->Admin_mo->exist('orders','where oid <> '.$id.' and ocode like "'.set_value('code').'"',''))
				{
					$data['admessage'] = 'This code is exist';
					$_SESSION['time'] = time(); $_SESSION['message'] = 'codeexist';
				}
				else
				{
					$this->Admin_mo->update('orders', array('ouid'=>$this->session->userdata('uid'), 'ocid'=>set_value('customer'), 'ocode'=>set_value('code'), 'notes'=>set_value('notes'), 'otime'=>time()),array('oid'=>$id));
					$this->Admin_mo->del('orderitems', array('oioid'=>$id));
					$this->Admin_mo->del('paymentvouchers', array('pvoid'=>$id));
					for($i=0;$i<count(set_value('item'));$i++)
					{
						$this->Admin_mo->set('orderitems', array('oioid'=>$id, 'oiiid'=>set_value('item')[$i], 'oiprice'=>set_value('price')[$i], 'oiquantity'=>set_value('quantity')[$i]));
						$this->Admin_mo->set('paymentvouchers', array('pvuid'=>$this->session->userdata('uid'), 'pvoid'=>$id, 'pviid'=>set_value('item')[$i], 'pvquantity'=>set_value('quantity')[$i], 'pvtime'=>time()));
					}
					$data['admessage'] = 'Successfully Saved';
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					}
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
		}
		redirect('orders', 'refresh');
		}
		else
		{
		$this->load->library('notifications');
		$data = $this->notifications->notifys($this->loginuser->ubcid,$this->loginuser->uitid,$this->session->userdata('uid'));
		$data['title'] = 'orders';
		$data['admessage'] = 'youhavenoprivls';
		$this->lang->load('orders', 'arabic');
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->load->view('headers/orders',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/orders');
		$this->load->view('notifys');
		$this->load->view('messages');
		}
	}
	
	public function read()
	{
		$this->Admin_mo->updateM1('logsystem',array('seen'=>'1'),'notifyuser = '.$this->session->userdata('uid').' and section like "OR%"');
	}
}