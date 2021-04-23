<?php
class Arabictools {
	public static function _ardInt($float) {
       return ($float < -0.0000001) ? ceil($float-0.0000001) : floor($float+0.0000001);
	}


	public static function arabicDate($format, $timestamp) {
	$format=trim($format);
	if (substr($format,0,1)=='*') {
                $use_span=true; 
		$format=substr($format,1);
        } else $use_span=false;
	$type=substr($format,0,3);

	$arDay = array("Sat"=>"السبت", 
	         "Sun"=>"الأحد", 
	         "Mon"=>"الإثنين", 
	         "Tue"=>"الثلاثاء", 
	         "Wed"=>"الأربعاء", 
	         "Thu"=>"الخميس", 
	         "Fri"=>"الجمعة");
	$ampm=array('am'=>'صباحا','pm'=>'مساء'); 

	list($d,$m,$y,$dayname,$monthname,$am)=explode(' ',date('d m Y D M a', $timestamp));

	if ($type=='hj:') {
		if (($y>1582)||(($y==1582)&&($m>10))||(($y==1582)&&($m==10)&&($d>14))) {
			$jd=Arabictools::_ardInt((1461*($y+4800+Arabictools::_ardInt(($m-14)/12)))/4);
			$jd+=Arabictools::_ardInt((367*($m-2-12*(Arabictools::_ardInt(($m-14)/12))))/12);
			$jd-=Arabictools::_ardInt((3*(Arabictools::_ardInt(($y+4900+Arabictools::_ardInt(($m-14)/12))/100)))/4);
			$jd+=$d-32075;
		} else 	{
			$jd = 367*$y-Arabictools::_ardInt((7*($y+5001+Arabictools::_ardInt(($m-9)/7)))/4)+Arabictools::_ardInt((275*$m)/9)+$d+1729777;
		}
		$l=$jd-1948440+10632;
		$n=Arabictools::_ardInt(($l-1)/10631);
		$l=$l-10631*$n+355;  // Correction: 355 instead of 354
		$j=(Arabictools::_ardInt((10985-$l)/5316))*(Arabictools::_ardInt((50*$l)/17719))+(Arabictools::_ardInt($l/5670))*(Arabictools::_ardInt((43*$l)/15238));
		$l=$l-(Arabictools::_ardInt((30-$j)/15))*(Arabictools::_ardInt((17719*$j)/50))-(Arabictools::_ardInt($j/16))*(Arabictools::_ardInt((15238*$j)/43))+29;
		$m=Arabictools::_ardInt((24*$l)/709);
		$d=$l-Arabictools::_ardInt((709*$m)/24);
		$y=30*$n+$j-30;		
		$format=substr($format,3);
		$hjMonth = array("محرم", 
		         "صفر", 
		         "ربيع أول", 
		          "ربيع ثاني", 
		         "جماد أول", 
		         "جماد ثاني", 
		         "رجب", 
		         "شعبان", 
		         "رمضان", 
		         "شوال", 
		         "ذو القعدة", 
		         "ذو الحجة"); 
		$format=str_replace('j', $d, $format);
		$format=str_replace('d', str_pad($d,2,0,STR_PAD_LEFT), $format);
		$format=str_replace('l', $arDay[$dayname], $format);
		$format=str_replace('F', $hjMonth[$m-1], $format);
		$format=str_replace('m', str_pad($m,2,0,STR_PAD_LEFT), $format);
		$format=str_replace('n', $m, $format);
		$format=str_replace('Y', $y, $format);
		$format=str_replace('y', substr($y,2), $format);
		$format=str_replace('a', substr($ampm[$am],0,1), $format);
		$format=str_replace('A', $ampm[$am], $format);
	} elseif ($type=='ar:') {
		$format=substr($format,3);
		$arMonth=array("Jan"=>"يناير",
		      "Feb"=>"فبراير",
		      "Mar"=>"مارس",
		      "Apr"=>"ابريل",
		      "May"=>"مايو",
		      "Jun"=>"يونيو",
		      "Jul"=>"يوليو",
		      "Aug"=>"اغسطس",
		      "Sep"=>"سبتمبر",
		      "Oct"=>"اكتوبر",
		      "Nov"=>"نوفمبر",
		      "Dec"=>"ديسمبر");
		$format=str_replace('l', $arDay[$dayname], $format);
		$format=str_replace('F', $arMonth[$monthname], $format);
		$format=str_replace('a', substr($ampm[$am],0,1), $format);
		$format=str_replace('A', $ampm[$am], $format);
        }
	$date = date($format, $timestamp);
	if ($use_span) return '<span dir="rtl" lang="ar-sa">'.$date.'</span>'; 
	else return $date;
	}

	public static function dateHejri2Geo($hijriDate) {
		// hijriDate must be dd/mm/yyyy  
		list($d, $m, $y) = explode('/', $hijriDate);
		$jd=Arabictools::_ardInt((11*$y+3)/30)+354*$y+30*$m-Arabictools::_ardInt(($m-1)/2)+$d+1948440-386;
		if ($jd> 2299160 ) {
			$l=$jd+68569;
			$n=Arabictools::_ardInt((4*$l)/146097);
			$l=$l-Arabictools::_ardInt((146097*$n+3)/4);
			$i=Arabictools::_ardInt((4000*($l+1))/1461001);
			$l=$l-Arabictools::_ardInt((1461*$i)/4)+31;
			$j=Arabictools::_ardInt((80*$l)/2447);
			$d=$l-Arabictools::_ardInt((2447*$j)/80);
			$l=Arabictools::_ardInt($j/11);
			$m=$j+2-12*$l;
			$y=100*($n-49)+$i+$l;
		} else	{
			$j=$jd+1402;
			$k=Arabictools::_ardInt(($j-1)/1461);
			$l=$j-1461*$k;
			$n=Arabictools::_ardInt(($l-1)/365)-Arabictools::_ardInt($l/1461);
			$i=$l-365*$n+30;
			$j=Arabictools::_ardInt((80*$i)/2447);
			$d=$i-Arabictools::_ardInt((2447*$j)/80);
			$i=Arabictools::_ardInt($j/11);
			$m=$j+2-12*$i;
			$y=4*$k+$n+$i-4716;
		}
	
		return "$d-$m-$y"; 
	}
}
?>