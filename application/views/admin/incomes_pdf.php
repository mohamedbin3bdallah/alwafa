	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/account/mpdf/mpdf.php');
		$mpdf = new mPDF('ar-s');

		$total = 0;
		$discount = 0;
		
		$html = '';
		$html .= '
			<!DOCTYPE html>
			<html lang="en" dir="rtl">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<title>'.lang('incomes').'</title>
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
							//margin-right: 50%;
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

		if(!empty($data))
		{
			$html .= '
                          <table>
                            <thead>
                              <tr>
                                <th width="25%">'.lang($type).'</th>
                                <th width="25%">'.lang('total').'</th>
								<th width="25%">'.lang('discount').'</th>
								<th width="25%">'.lang('incomes').'</th>
                              </tr>
                            </thead>
                            <tbody>
			';

			for($i=0;$i<count($data);$i++)
			{
				$total = number_format($total + $data[$i]->total, 2);
				$discount = number_format($discount + $data[$i]->discount, 2);
				
				$html .= '
							<tr>
                                <td width="25%">'.$data[$i]->date.'</td>
								<td width="25%">'.number_format($data[$i]->total, 2).' '.$system->currency.'</td>
								<td width="25%">'.number_format($data[$i]->discount, 2).' '.$system->currency.'</td>
                                <td width="25%">'.number_format($data[$i]->total - $data[$i]->discount, 2).' '.$system->currency.'</td>
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
                                <td>'.number_format($total, 2).' '.$system->currency.'</td>
                              </tr>
							  <tr>
                                <th>'.lang('discount').'</th>
                                <td>'.number_format($discount, 2).' '.$system->currency.'</td>
                              </tr>
							  <tr>
                                <th>'.lang('incomes').'</th>
                                <td>'.number_format($total - $discount, 2).' '.$system->currency.'</td>
                              </tr>
                          </table>
		';

		$html .= '
				</body>
			</html>
		';

		$mpdf->AddPage();
		$mpdf->WriteHTML($html);
		$mpdf->Output('incomes_'.date('Y-m-d-H-i-s', time()).'.pdf', 'I');
	?>