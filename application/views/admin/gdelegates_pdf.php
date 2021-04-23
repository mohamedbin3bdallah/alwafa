	<?php
		$activearr = array(lang('notactive'),lang('active'));
		
		include_once($_SERVER['DOCUMENT_ROOT'].'/account/mpdf/mpdf.php');
		$mpdf = new mPDF('ar-s');
		
		$count = 0;
		$limit_per_page = 15;
		
		foreach($data as $item)
		{
		
		if(($count%$limit_per_page) == 0)
		{
		$html = '';
		$html .= '
			<!DOCTYPE html>
			<html lang="en" dir="rtl">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<title>'.lang('delegates').'</title>
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
								<th>'.lang('mobile').'</th>
								<th>'.lang('desc').'</th>
								<th>'.lang('employee').'</th>
								<th>'.lang('time').'</th>
								<th></th>
                              </tr>
		';
		}
		$html .= '
							  <tr>
                                <td>'.($count+1).'</td>
                                <td>'.$item->dname.'</td>
								<td>'.$item->dphone.'</td>
								<td style="text-align:justify;">'.$item->ddesc.'</td>
								<td>'.$item->user.'</td>
								<td>'.date('Y-m-d h-i-sa', $item->dctime).'</td>
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
		$mpdf->Output('delegates_report_'.date('Y-m-d-H-i-s', time()).'.pdf', 'I');
	?>