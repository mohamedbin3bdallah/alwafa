	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/account/mpdf/mpdf.php');
		$mpdf = new mPDF('ar-s');

		foreach($data as $order)
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
					<title>'.lang('orders').'</title>
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
                                <td>'.$order['oid'].'</td>
								<th>'.lang('code').'</th>
                                <td><img src="'.base_url().'barcode/barcode.php?codetype=Code39&size=55&text='.$order['code'].'" /></td>
                              </tr>
							  <tr>
                                <th>'.lang('day').'</th>
                                <td>'.date('Y-m-d', $order['time']).'</td>
								<th>'.lang('time').'</th>
                                <td>'.date('h:i:sa', $order['time']).'</td>
                              </tr>
							  <tr></tr>
                              <tr>
                                <th>'.lang('customer').'</th>
                                <td>'.$order['customer'].'</td>
								<th>'.lang('mobile').'</th>
                                <td>'.$order['cphone'].'</td>
                              </tr>
							  <tr>
                                <th>'.lang('employee').'</th>
                                <td>'.$order['employee'].'</td>
								<th>'.lang('mobile').'</th>
                                <td>'.$order['uphone'].'</td>
                              </tr>
                          </table>
		';
		if(!empty($order['items']))
		{
			$html .= '
                          <table>
                            <thead>
                              <tr>
                                <th width="15%">'.lang('code').'</th>
                                <th width="39%">'.lang('info').'</th>
                                <th width="17%">'.lang('quantity').'</th>
                                <th>'.lang('price').'</th>
                              </tr>
                            </thead>
                            <tbody>
			';
			foreach($order['items'] as $item)
			{
				$html .= '
							<tr>
                                <td width="15%">'.$item['icode'].'</td>
                                <td width="39%">'.$item['item'].$item['joitem'].'</td>
                                <td width="17%">'.$item['quantity'].'</td>
                                <td>'.$item['price'].' '.$system->currency.'</td>
                            </tr>
				';
			}
			$html .= '
							</tbody>
                          </table>
			';
		}
		$html .= '
                          <table class="total">
                              <tr>
                                <th>'.lang('total').'</th>
                                <td>'.number_format(($order['total']-$order['discount']),2).' '.$system->currency.'</td>
                              </tr>
                          </table>
		';
		$html .= '
				</body>
			</html>
		';

		$mpdf->AddPage();
		$mpdf->WriteHTML($html);
		}
		$mpdf->Output('joborders_'.date('Y-m-d-H-i-s', time()).'.pdf', 'I');
	?>