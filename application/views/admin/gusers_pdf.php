	<?php
		$activearr = array(lang('notactive'),lang('active'));
		/*$privileges = array(
			'usee','uadd','uedit','udelete',
			'bcsee','bcadd','bcedit','bcdelete',
			'utsee','utadd','utedit','utdelete',
			'itsee','itadd','itedit','itdelete',
			'dsee','dadd','dedit','ddelete',
			'csee','cadd','cedit','cdelete',
			'osee','oadd',
			'isee','iadd','iedit','idelete',
			'imsee','imadd','imedit','imdelete',
			'pvsee','pvedit',
			'bsee','bedit','bprint',
			'josee','joorder','joedit',
			'generalreport','incomesreport','outcomesreport','itreport','breport','oreport',
		);*/
		
		include_once($_SERVER['DOCUMENT_ROOT'].'/account/mpdf/mpdf.php');
		$mpdf = new mPDF('ar-s', 'A4-L');
		
		$count = 0;
		$limit_per_page = 15;
		
		foreach($data as $item)
		{
		
		if(($count%$limit_per_page) == 0)
		{
		$item->branches = implode(' , ',array_intersect_key($branches, array_flip(explode(',',$item->ubcid))));
		$item->stores = implode(' , ',array_intersect_key($stores, array_flip(explode(',',$item->uitid))));
		//$item->userprivileges = implode(' , ',array_flip(array_intersect_key(array_flip($privileges), array_flip(explode(',',$item->privileges)))));
		/*if($item->privileges != '')
		{
			$prvs = array(); $prvs = explode(',',substr($item->privileges,1,-1));
			$myprvs = array(); foreach($prvs as $prv) { $myprvs[] = lang($prv); }
			$item->userprivileges = implode(' , ', $myprvs);
		}
		else $item->userprivileges = '';*/
		
		$html = '';
		$html .= '
			<!DOCTYPE html>
			<html lang="en" dir="rtl">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<title>'.lang('users').'</title>
					<style>
						@import url("http://fonts.googleapis.com/earlyaccess/droidarabickufi.css");
						body { 
							font-family: "Droid Arabic Kufi", sans-serif;
							border: 1px solid #ccc;
						}
						
						.logo-div, .company-div {
							text-align: center;
						}
						
						.logo-img {
							width: 25%;
						}
						
						table {
							border-collapse: collapse;
							width: 100%;
							margin-bottom: 25px;
						}

						td, th {
							text-align: right;
							border: 1px solid #dddddd;
							padding: 8px;
						}

						tr:nth-child(even) {
							background-color: #dddddd;
						}
						
						.total {
							margin-right: 50%;
						}
					</style>
				</head>
				<body>
		';
		$html .= '
			<br>
			<div class="logo-div">
				<img src="'.$_SERVER['DOCUMENT_ROOT'].'/account/imgs/'.$system->logo.'" class="logo-img" />
			</div>
			<div class="company-div">
				<h3>'.$system->website.'</h3>
			</div>
			<br>
		';
		$html .= '
                          <table>
							  <tr>
                                <th>'.lang('number').'</th>
								<th>'.lang('name').'</th>
								<th>'.lang('username').'</th>
								<th>'.lang('usertype').'</th>
								<th>'.lang('branch').'</th>
								<th>'.lang('store').'</th>
								<!--<th>'.lang('privileges').'</th>-->
								<th>'.lang('email').'</th>
								<th>'.lang('address').'</th>
								<th>'.lang('mobile').'</th>							
								<th>'.lang('time').'</th>
								<th></th>
                              </tr>
		';
		}
		$html .= '
							  <tr>
                                <td>'.($count+1).'</td>
                                <td>'.$item->uname.'</td>
								<td>'.$item->username.'</td>
								<td>'.$item->usertype.'</td>
								<td>'.$item->branches.'</td>
								<td>'.$item->stores.'</td>
								<!--<td style="text-align:justify;">'.$item->userprivileges.'</td>-->
								<td>'.$item->uemail.'</td>
								<td>'.$item->uaddress.'</td>
								<td>'.$item->uphone.'</td>
								<td>'.date('Y-m-d h-i-sa', $item->uctime).'</td>
                                <td>'.$activearr[$item->active].'</td>
                              </tr>
		';
		if((($count%$limit_per_page) == ($limit_per_page-1)) || ($count == (count($data)-1)))
		{
		$html .= '
					</table>
				</body>
			</html>
		';
		$mpdf->AddPage();
		$mpdf->WriteHTML($html);
		//print_r($html);
		}
		$count++;
		}
		$mpdf->Output('users_report_'.date('Y-m-d-H-i-s', time()).'.pdf', 'I');
	?>