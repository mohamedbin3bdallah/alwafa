<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	
<html class="no-js" lang="ar"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="<?php echo $this->pages['desc'][$pageid]; ?>">
	<meta name="keywords" content="<?php echo $this->pages['keywords'][$pageid]; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $this->pages['title'][$pageid]; ?></title>
	<link rel="apple-touch-icon" href="<?php if(isset($system->logo) && $system->logo != '' && file_exists($system->logo)) echo base_url().$system->logo; ?>">
	<link rel="shortcut icon" href="<?php if(isset($system->logo) && $system->logo != '' && file_exists($system->logo)) echo base_url().$system->logo; ?>">
	<link rel="stylesheet" href="<?php echo base_url(); ?>alwafa/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>alwafa/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>alwafa/css/normalize.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>alwafa/css/owl.carousel.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>alwafa/css/prettyPhoto.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>alwafa/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>alwafa/css/color.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>alwafa/css/responsive.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>alwafa/css/transitions.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>alwafa/css/font-awesome.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>alwafa/css/menu.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>alwafa/js/slimbox2.js"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>alwafa/css/slimbox2.css" type="text/css" media="screen" />
	<script src="<?php echo base_url(); ?>alwafa/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
	
	<!-- gallery with share icon-->
		<link href="<?php echo base_url(); ?>alwafa/css/lightgallery.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>alwafa/css/main.css" rel="stylesheet">
	<!-- End Gallery -->
</head>
<body class="th-home">

	<!--************************************
			Wrapper Start
	*************************************-->
	<div id="th-wrapper" class="th-wrapper th-haslayout">
		<!--************************************
				Header Start
		*************************************-->
		<header id="th-header" class="th-header th-haslayout">
			<div class="th-topbar">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-xs-12">
							<strong class="th-logo">
								<a href="<?php echo base_url(); ?>index"><img src="<?php if(isset($system->logo) && $system->logo != '' && file_exists($system->logo)) echo base_url().$system->logo; ?>" alt="image description"></a>
							</strong>
							<div class="th-leftarea">
								<div class="th-topinfo">
									<ul class="th-emails">
										<?php if(in_array('CT',$this->sections) && $contact->ctactive == '1' && $contact->ctemail != '') { ?><li>البريد الالكتروني : <?php $emails = explode(' - ',$contact->ctemail); foreach($emails as $email) { echo '<a href="mailto:'.$email.'">'.$email.'</a> '; } ?> </li><?php } ?>
										<?php if(in_array('MG',$this->sections)) { ?><li><i class="fa fa-life-ring"></i><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal2">المســــاعدة</a></li><?php } ?>
									</ul>
									<?php if(in_array('SM',$this->sections) && isset($contact) && $contact->smactive == '1') { ?>
									<ul class="th-socialicons">
										<?php if($contact->smfacebook != '') { ?><li><a href="<?php echo $contact->smfacebook; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
										<?php if($contact->smtwitter != '') { ?><li><a href="<?php echo $contact->smtwitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
										<?php if($contact->smyoutube != '') { ?><li><a href="<?php echo $contact->smyoutube; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li><?php } ?>
										<?php if($contact->sminstagram != '') { ?><li><a href="<?php echo $contact->sminstagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li><?php } ?>
										<?php if($contact->smlinkedin != '') { ?><li><a href="<?php echo $contact->smlinkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
									</ul>
									<?php } ?>
									<div class="dropdown th-themedropdown">
										<a id="th-languages" class="th-btndropdown th-btnlanguages" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fa fa-commenting-o"></i>
											<span>تغيير اللغة</span>
											<i class="fa  fa-angle-down"></i>
										</a>
										<ul class="dropdown-menu th-dropdownmenu" aria-labelledby="th-languages">
											<li><a href="#"><img src="<?php echo base_url(); ?>alwafa/images/icon/img-39.jpg" alt="image description">English</a></li>
										</ul>
									</div>
								</div>
								<ul class="th-addressbox">
									<li>
										<span class="th-addressicon"><i class="fa fa-clock-o"></i></span>
										<div class="th-addresscontent">
											<strong>اوقــــات العمل</strong>
											<span>طوال الاسبوع عدا الجمعة</span>
										</div>
									</li>
									<?php if(in_array('CT',$this->sections) && $contact->ctactive == '1' && ($contact->ctphone != '' || $contact->ctmobile != '')) { ?>
									<li>
										<span class="th-addressicon"><i class="fa fa-phone"></i></span>
										<div class="th-addresscontent">
											<strong>رقم الطواريء</strong>
											<span><?php echo $contact->ctphone.'-'.$contact->ctmobile; ?></span>
										</div>
									</li>
									<?php } ?>
									<?php if(in_array('RS',$this->sections)) { ?>
									<li>
										<a class="th-btnappointment" href="javascript:void(0);" data-toggle="modal" data-target="#myModal">
											<i class="fa fa-bell-o"></i>
											<em>حجز كشف</em>
										</a>
									</li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="th-navigationarea">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
						<nav class="th-nav">
							<nav id='cssmenu'>
								<div id="head-mobile"></div>
								<div class="button"></div>
									<ul>
										<li class='active'><a href='<?php echo base_url(); ?>index'>الرئيسية</a></li>
										<li>
											<a href="javascript:void(0);">من نحن</a>
											<ul>
												<li><a href="<?php echo base_url(); ?>message">رسالتنا</a></li>
												<li><a href="<?php echo base_url(); ?>about">عن المستشـفى</a></li>						
											</ul>
										</li>
										<li>
											<a href="javascript:void(0);">اقسام المستشفى</a>
											<ul>
												<li>
													<a href="javascript:void(0);">العيادات</a>
													<ul>
														<li><a href="#">عيادات النساء والولادة</a></li>
														<li><a href="#">عيادات الأطفال وحديثي الولادة</a></li>
														<li><a href="#">عيادات الجراحة العامة والأوعية الدموية</a></li>
														<li><a href="#">عيادات الباطنة والجهاز الهضمي والمناظير</a></li>
														<li><a href="#">عيادات الأسنان</a></li>
														<li><a href="#">عيادات الجلدية والتجميل</a></li>
														<li><a href="#">عيادة طب وجراحة العيون</a></li>
														<li><a href="#">عيادة القلب</a></li>
														<li><a href="#">عيادات طلب وجراحة العظام</a></li>
														<li><a href="#">عيادة الأنف والأذن والحنجرة وتخطيط السمع</a></li>
														<li><a href="#">عيادة طب وجراحة المسالك البولية والعقم</a></li>
													</ul>
												</li>
												<li>
													<a href="javascript:void(0);">الاقسام الطبية</a>
													<ul>
														<li><a href="#"> أقسام ووحدات العيادات النسائية والرجالية</a></li>
														<li><a href="#"> وحدة العناية المركزية الفائقة بحديثي الولادة	</a></li>
														<li><a href="#"> قسم المختبر</a></li>
														<li><a href="#">أقسام الطوارئ</a></li>	
														<li><a href="#"> وحدة مناظير الجهاز الهضمي</a></li>	
														<li><a href="#"> قسم اللياقة البدنية</a></li>	
														<li><a href="#">  قسم العمليات</a></li>	
														<li><a href="#">   وحدة الحضانة</a></li>	
														<li><a href="#">وحدة العناية المركزة للكبار</a></li>
														<li><a href="#"> قسم الأشعة والتصوير الطبي</a></li>
														<li><a href="#"> قسم الاستقبال وخدمات المرضى</a></li>
														<li><a href="#"> قسم المستودعات الطبية وغير الطبية</a></li>
													</ul>
												</li>
												<li>
													<a href="javascript:void(0);">الاقسام الادارية و الفنية</a>
													<ul>
														<li><a href="#">  أقسام الشئون الإدارية والفنية</a></li> 
														<li><a href="#"> قسم التمريض نساء ورجال		</a></li>
														<li><a href="#">  قسم الإدارة المالية ( الحسابات) </a></li>
														<li><a href="#">  قسم السجلات الطبية	 </a></li>	
														<li><a href="#">  قسم الإجازات </a></li>	
														<li><a href="#">  قسم الصيانة العامة والأشغال</a></li>	
														<li><a href="#">   قسم الصيانة الطبية </a></li>	
														<li><a href="#">    قسم الموارد البشرية وشئون الموظفين </a></li>	
														<li><a href="#">     قسم التسويق والتحصيل </a></li>	
														<li><a href="#"> قسم المشتريات الطبية وغير الطبية	</a></li>
														<li><a href="#">قسم وحدة برامج وشبكة الحاسب الآلي</a></li>
														 <li><a href="#">وحدة التسويق والتحصيل	</a></li>
													</ul>
												</li>
											</ul>
										</li>
										<li>
											<a href="javascript:void(0);">الخدمات الالكترونية</a>
											<ul>
												<li><a href="#">حجز كشف</a></li>
												<li><a href="#">الاقسام الطبية</a></li>
												<li><a href="#">الاقسام الادارية و الفنية</a></li>									
											</ul>
										</li>
										<li><a href="#">الصيدلية</a></li>
										<li>
											<a href="javascript:void(0);">الميديا</a>
											<ul>
												<li><a href="<?php echo base_url(); ?>allgallery">معرض الصور</a></li>
												<li><a href="<?php echo base_url(); ?>videos">مكتبة الفيديو</a></li>									
											</ul>
										</li>
										<li><a href="<?php echo base_url(); ?>contact">بيانات الاتصال</a></li>
									</ul>
							</nav>
						</nav>
							<div class="th-widgetsearch">
								<form action="index_submit" method="post">
									<fieldset>
										<input type="search" name="search" class="form-control" placeholder="ابحث فى اقسامنا...">
										<button type="submit"><i class="fa fa-search"></i></button>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!--************************************
				Header End
		*************************************-->
		<!--************************************
				Home Slider Start
		*************************************-->
		<?php if(in_array('SD',$this->sections) && isset($slides) && !empty($slides)) { ?>
		<div id="th-homeslider" class="th-homeslider th-haslayout">
			<?php foreach($slides as $slide) { ?>
			<figure class="item">
				<img src="<?php echo $slide->sdimg; ?>" alt="image description">
				<?php if($slide->sdtitle != '' || $slide->sddesc != '' || ($slide->sdlinkalt1 != '' && $slide->sdlinkurl1 != '') || ($slide->sdlinkalt2 != '' && $slide->sdlinkurl2 != '')) { ?>
				<figcaption>
					<div class="container">
						<div class="th-slidercontent">
							<?php if($slide->sdtitle != '') { ?><h1><?php echo $slide->sdtitle; ?></h1><?php } ?>
							<div class="th-description">
								<?php if($slide->sddesc != '') { ?><p><?php echo $slide->sddesc; ?></p><?php } ?>
							</div>
							<div class="th-btns">
								<?php if($slide->sdlinkalt1 != '' && $slide->sdlinkurl1 != '') { ?><a class="th-btn-color" href="<?php echo $slide->sdlinkurl1; ?>"><?php echo $slide->sdlinkalt1; ?></a><?php } ?>
								<?php if($slide->sdlinkalt2 != '' && $slide->sdlinkurl2 != '') { ?><a class="th-btn" href="<?php echo $slide->sdlinkurl2; ?>"><?php echo $slide->sdlinkalt2; ?></a><?php } ?>
							</div>
						</div>
					</div>
				</figcaption>
				<?php } ?>
			</figure>
			<?php } ?>
		</div>
		<?php } ?>
		<!--************************************
				Home Slider End
		*************************************-->
		<!--************************************
				Main Start
		*************************************-->
		<main id="th-main" class="th-main th-haslayout">
			<!--************************************
					Features And Table Start
			*************************************-->
			<?php if(in_array('AB',$this->sections) || in_array('GL',$this->sections)) { ?>
			<section class="th-sectionspace th-haslayout th-pattrenone">
				<div class="container">
					<div class="row">
						<div class="th-featuresandtime">
						
							<?php if(in_array('AB',$this->sections) && isset($about) && !empty($about)) { ?>
								<?php if(in_array('GL',$this->sections)) { ?><div class="col-md-7 col-sm-12 col-xs-12"><?php } else { ?><div class="col-md-12 col-sm-12 col-xs-12"><?php } ?>
								<div class="th-sectionhead th-alignleft th-nopattren">
									<div class="th-sectiontitle">
										<h2><?php echo $about[0]->abtitle; ?></h2>
									</div>
									<div class="th-description">
										<p><?php if(strlen(htmlspecialchars_decode(stripslashes($about[0]->abdesc))) > 755) echo substr(htmlspecialchars_decode(stripslashes($about[0]->abdesc)),0,strpos(htmlspecialchars_decode(stripslashes($about[0]->abdesc)),' ',755)); else echo htmlspecialchars_decode(stripslashes($about[0]->abdesc)); ?>... <a href="<?php echo base_url(); ?>about">اقرأ المزيد</a> </p>
									</div>
								</div>
								<div class="th-features">
									<div class="row">
										<div class="col-sm-6 col-xs-12">
											<div class="th-feature">
												<div class="th-featurehead">
													<span class="th-featureicon"><i class="fa <?php echo $about[4]->abicon; ?>"></i></span>
													<div class="th-featuretitle">
														<h3><?php echo $about[4]->abtitle; ?></h3>
													</div>
												</div>
												<div class="th-description">
													<p><?php if(strlen(htmlspecialchars_decode(stripslashes($about[4]->abdesc))) > 355) echo substr(htmlspecialchars_decode(stripslashes($about[4]->abdesc)),0,strpos(htmlspecialchars_decode(stripslashes($about[4]->abdesc)),' ',355)); else echo htmlspecialchars_decode(stripslashes($about[4]->abdesc)); ?>... <a href="<?php echo base_url(); ?>message">اقرأ المزيد</a></p>
												</div>
											</div>
										</div>
										<div class="col-sm-6 col-xs-12">
											<div class="th-feature">
												<div class="th-featurehead">
													<span class="th-featureicon"><i class="fa <?php echo $about[5]->abicon; ?>"></i></span>
													<div class="th-featuretitle">
														<h3><?php echo $about[5]->abtitle; ?></h3>
													</div>
												</div>
												<div class="th-description">
													<p><?php if(strlen(htmlspecialchars_decode(stripslashes($about[5]->abdesc))) > 355) echo substr(htmlspecialchars_decode(stripslashes($about[5]->abdesc)),0,strpos(htmlspecialchars_decode(stripslashes($about[5]->abdesc)),' ',355)); else echo htmlspecialchars_decode(stripslashes($about[5]->abdesc)); ?>... <a href="<?php echo base_url(); ?>message">اقرأ المزيد</a></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php } if(in_array('GL',$this->sections)) { ?>
							<?php $glimages = array_diff(scandir('imgs/albums'), array('.','..')); ?>
							<?php if(!empty($glimages)) { if(count($glimages) < 12) $glcount = count($glimages)+2; else $glcount = 11; ?>
								<?php if(in_array('AB',$this->sections)) { ?><div class="col-md-5 col-md-offset-0 col-sm-6 col-sm-offset-3 col-xs-12"><?php } else { ?><div class="col-md-12 col-sm-12 col-xs-12"><?php } ?>
								<aside id="th-sidebar" class="th-sidebar">
								<div class="th-widget th-widgetinstagram">
									<div class="th-widgettitle">
										<span class="th-widgeticon">
											<i><img src="<?php echo base_url(); ?>alwafa/images/icon/img-27.png" alt="image description"></i>
										</span>
										<h3>البوم الصور و المناسبات</h3>
									</div>
									<ul>
										<?php for($gl=2;$gl<$glcount;$gl++) { ?>
										<li>
											<a href="<?php echo base_url(); ?>imgs/albums/<?php echo $glimages[$gl]; ?>" rel="lightbox-cats">
												<img src="<?php echo base_url(); ?>imgs/albums/<?php echo $glimages[$gl]; ?>" class="gallery">
											</a>
										</li>
										<?php } ?>
									</ul>
								</div>
							</aside>
							</div>
							<?php } } ?>
						</div>
					</div>
				</div>
			</section>
			<?php } ?>
			<!--************************************
					Features And Table End
			*************************************-->
			<!--************************************
					Statistics Start
			*************************************-->
			<section class="th-haslayout th-parallaximg" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/bgparallax/bgparallax-01.jpg">
				<div class="container">
					<div class="row">
						<div class="th-counters">
							<div class="th-counter">
								<span class="th-countericon">
									<i class="fa fa-hospital-o"></i>
								</span>
								<div class="th-counterbox">
									<div class="th-countertitle">
										<h2>سنوات عمل <br> المستشفى</h2>
									</div>
									<div class="th-count">
										<h3 data-from="0" data-to="<?php echo $system->yearsold; ?>" data-speed="8000" data-refresh-interval="50"><?php echo $system->yearsold; ?></h3>
									</div>
								</div>
							</div>
							<div class="th-counter">
								<span class="th-countericon">
									<i class="fa fa-stethoscope"></i>
								</span>
								<div class="th-counterbox">
									<div class="th-countertitle">
										<h2>عدد الاطبـــاء <br> العاملين</h2>
									</div>
									<div class="th-count">
										<h3 data-from="0" data-to="<?php echo $doctorscount; ?>" data-speed="8000" data-refresh-interval="50"><?php echo $doctorscount; ?></h3>
									</div>
								</div>
							</div>
							<div class="th-counter">
								<span class="th-countericon">
									<i class="fa fa-heartbeat"></i>
								</span>
								<div class="th-counterbox">
									<div class="th-countertitle">
										<h2>غرف العمليات <br> المجهزة</h2>
									</div>
									<div class="th-count">
										<h3 data-from="0" data-to="<?php echo $system->avrooms; ?>" data-speed="8000" data-refresh-interval="50"><?php echo $system->avrooms; ?></h3>
									</div>
								</div>
							</div>
							<div class="th-counter">
								<span class="th-countericon">
									<i class="fa fa-bed"></i>
								</span>
								<div class="th-counterbox">
									<div class="th-countertitle">
										<h2>الغرف و الاجنحة <br> الملكية</h2>
									</div>
									<div class="th-count">
										<h3 data-from="0" data-to="<?php echo $system->exrooms; ?>" data-speed="8000" data-refresh-interval="50"><?php echo $system->exrooms; ?></h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--************************************
					Statistics end
			*************************************-->
			<!--************************************
					Services Start
			*************************************-->
			<section class="th-sectionspace th-haslayout">
				<div class="container">
					<div class="row">
					<?php if(in_array('NW',$this->sections) && isset($news) && !empty($news)) { ?>
						<div class="col-md-7 col-md-offset-0 col-sm-6 col-sm-offset-3 col-xs-12">
							<aside id="th-sidebar" class="th-sidebar">
								<div class="th-widget th-widgetinstagram">
									<div class="th-widgettitle">
										<span class="th-widgeticon">
											<i class="fa fa-newspaper-o"></i>
										</span>
										<h3>احدث الاخبــــــــار</h3>
									</div>
								</div>
								<div class="th-posts th-poststwo th-postslist">
									<article class="th-post">
										<figure class="th-postimg">
											<a href="<?php echo base_url(); ?>new/<?php echo $news[0]->nwurl; ?>"><img src="<?php echo base_url().$news[0]->nwimg; ?>" alt="<?php echo $news[0]->nwtitle; ?>"></a>
										</figure>
										<div class="th-postcontent">
											<ul class="th-postmate">
												<li>
													<a href="#">
														<i class="fa fa-calendar"></i>
														<span><?php if($news[0]->nwtime != '') { echo ArabicTools::arabicDate($system->calendar.' Y-m-d', $news[0]->nwtime); } ?></span>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-eye"></i>
														<span><?php echo $news[0]->nwviews; ?> مشاهدة</span>
													</a>
												</li>
											</ul>
											<div class="th-posttitel">
												<h3><a href="<?php echo base_url(); ?>new/<?php echo $news[0]->nwurl; ?>"><?php echo $news[0]->nwtitle; ?></a></h3>
											</div>
											<div class="th-description">
												<p><?php  if(strlen(htmlspecialchars_decode(stripslashes($news[0]->nwdesc))) > 150) echo substr(htmlspecialchars_decode(stripslashes($news[0]->nwdesc)),0,strpos(htmlspecialchars_decode(stripslashes($news[0]->nwdesc)),' ',75)); else echo htmlspecialchars_decode(stripslashes($news[0]->nwdesc)); ?>...<a href="<?php echo base_url(); ?>new/<?php echo $news[0]->nwurl; ?>">اقرأ المزيد</a></p>
											</div>
										</div>
										
									</article>
									<ul class="th-recentpost">
										<?php if(isset($news[1])) { ?>
										<li>
											<figure><a href="<?php echo base_url(); ?>new/<?php echo $news[1]->nwurl; ?>"><i><img src="<?php echo base_url().$news[1]->nwimg; ?>" alt="<?php echo $news[1]->nwtitle; ?>"></i></a></figure>
											<div class="th-shortcontent">
												<p><a href="<?php echo base_url(); ?>new/<?php echo $news[1]->nwurl; ?>"><?php echo $news[1]->nwtitle; ?></a></p>
												<time><i class="fa fa-calendar"></i> <?php if($news[1]->nwtime != '') { echo ArabicTools::arabicDate($system->calendar.' Y-m-d', $news[1]->nwtime); } ?></time>
											</div>
										</li>
										<?php } if(isset($news[2])) { ?>
										<li>
											<figure><a href="<?php echo base_url(); ?>new/<?php echo $news[2]->nwurl; ?>"><i><img src="<?php echo base_url().$news[2]->nwimg; ?>" alt="<?php echo $news[2]->nwtitle; ?>"></i></a></figure>
											<div class="th-shortcontent">
												<p><a href="<?php echo base_url(); ?>new/<?php echo $news[2]->nwurl; ?>"><?php echo $news[2]->nwtitle; ?></a></p>
												<time><i class="fa fa-calendar"></i> <?php if($news[2]->nwtime != '') { echo ArabicTools::arabicDate($system->calendar.' Y-m-d', $news[2]->nwtime); } ?></time>
											</div>
										</li>
										<?php } ?>
									</ul>
								</div>
							</aside>
							
							<div class="text-center">
								<a class="th-btn-border" href="<?php echo base_url(); ?>news">المزيد من الاخبار</a>
							</div>
						</div>
					<?php } ?>
						<div class="col-md-5 col-md-offset-0 col-sm-6 col-sm-offset-3 col-xs-12">
							<aside id="th-sidebar" class="th-sidebar">
								<div class="th-widget th-widgetinstagram">
									<div class="th-widgettitle">
										<span class="th-widgeticon">
											<i class="fa fa-folder-o"></i>
										</span>
										<h3>الاحداث و الفعاليـــــات</h3>
									</div>
								</div>
							</aside>
							<div class="news">
								<div class="ndate">25 <br> مارس</div> 
								<h3><a href="#">نجاح عملية الرباط الصليبي للاعب كرة القدم</a></h3>
								<p class="">أمهر الأطباء الألمان البروفيسور الألماني الدكتور/ بيكال بينفرد استشاري وخبير جراحة العظام</p>
							</div>
							<div class="news">
								<div class="ndate">16 <br> مايو</div> 
								<h3><a href="#">نجاح عملية الرباط الصليبي للاعب كرة القدم السعودي</a></h3>
								<p class="">أمهر الأطباء الألمان البروفيسور الألماني الدكتور/ بيكال بينفرد استشاري وخبير جراحة العظام</p>
							</div>
							<div class="news" style="margin-bottom: 23px;">
								<div class="ndate">16 <br> مايو</div> 
								<h3><a href="#">نجاح عملية الرباط الصليبي للاعب كرة القدم السعودي</a></h3>
								<p class="">أمهر الأطباء الألمان البروفيسور الألماني الدكتور/ بيكال بينفرد استشاري وخبير جراحة العظام</p>
							</div>
							
							<div class="text-center">
								<a class="th-btn-border" href="#">المزيد من الاخبار</a>
							</div>
						</div>
					
					
					</div>
				</div>
			</section>
			<!--************************************
					Services End
			*************************************-->
			<!--************************************
					Newsletter Start
			*************************************-->
			<section class="th-haslayout th-bgcolor th-positionrelative">
				<div class="container">
					<div class="row">
						<div class="th-newsletter">
							<?php if(in_array('EM',$this->sections)) { ?>
							<?php if(in_array('VD',$this->sections) && isset($videos) && !empty($videos)) { ?><div class="col-md-6 col-sm-12 col-xs-12"><?php } else { ?><div class="col-md-12 col-sm-12 col-xs-12"><?php } ?>
								<div class="th-newsletterbox">
									<h2>النشرة البريدية</h2>
									<div class="th-description">
										<p>سجل معنا فى النشرة البريدية ليصلك كل جديد من احداث  و فعاليات المستشفى...</p>
									</div>
									<?php
										//echo $admessage;
										$attributes = array('id' => 'submit_form', /*'data-parsley-validate' => '', */'class' => 'th-formnewsletter');
										echo form_open('saveemail', $attributes);
										//echo validation_errors();
									?>
										<fieldset>
											<?php
												$data = array(
													'type' => 'email',
													'name' => 'email',
													'id' => 'email',
													'placeholder' => 'ادخل البريــد الالكتـــروني',
													'class' => 'form-control',
													//'max' => 255,
													//'required' => 'required',
													'value' => set_value('email')
												);
												echo form_input($data);
											?>
											<?php
												$data = array(
													'name' => 'submit',
													'id' => 'submit',
													'value' => 'true',
													'type' => 'submit',
													//'disabled' => 'disabled',
													'content' => 'تسجــــــيل'
												);
												echo form_button($data);
											?>
										</fieldset>
									<?php
										echo form_close();
									?>
								</div>
							</div>
							<?php } ?>
							<?php if(in_array('VD',$this->sections) && isset($videos) && !empty($videos)) { ?>
							<?php if(in_array('EM',$this->sections)) { ?><div class="col-md-6 col-sm-12 col-xs-12"> <?php } else { ?><div class="col-md-6 col-md-pull-3 col-sm-6 col-sm-pull-3 col-xs-8 col-xs-offset-2"><?php } ?>
								<figure class="th-videobox">
									<img src="https://img.youtube.com/vi/<?php echo substr($videos[0]->vdlink, -11); ?>/hqdefault.jpg" alt="image description">
									<figcaption>
										<a class="th-btnplay" href="https://youtu.be/<?php echo substr($videos[0]->vdlink, -11); ?>?iframe=true" data-rel="prettyPhoto[video]"><i class="fa fa-play"></i></a>
										<strong>Play Video</strong>
									</figcaption>
								</figure>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</section>
			<!--************************************
					Newsletter End
			*************************************-->
		</main>
		<!--************************************
				Main End
		*************************************-->
		<!--************************************
				Footer Start
		*************************************-->
		<footer id="th-footer" class="th-footer th-haslayout">
			<div class="th-footermiddlebox th-sectionspace th-haslayout th-parallaximg">
				<div class="container">
					<div class="row">
						<div class="th-fcols">
							<?php if(in_array('CT',$this->sections) && isset($contact) && !empty($contact) && $contact->ctactive == '1') { ?>
							<?php if($contact->ctmap != '') { ?><div class="col-md-3 col-sm-6 col-xs-6"><?php } else { ?><div class="col-md-4 col-sm-6 col-xs-6"><?php } ?>
								<div class="th-fcol">
									<div class="th-borderheading">
										<h3>بيانات الاتصال</h3>
									</div>
									<ul class="th-faddressinfo">
										<?php if($contact->ctaddress != '') { ?>
										<li>
											<span class="th-addressicon"><img src="<?php echo base_url(); ?>alwafa/images/icon/img-08.png" alt="<?php echo $contact->ctaddress; ?>"></span>
											<address><?php echo $contact->ctaddress; ?></address>
										</li>
										<?php } ?>
										<?php if($contact->ctphone != '' || $contact->ctmobile != '') { ?>
										<li>
											<span class="th-addressicon"><img src="<?php echo base_url(); ?>alwafa/images/icon/img-09.png" alt="<?php echo $contact->ctphone.'-'.$contact->ctmobile; ?>"></span>
											<div class="th-phone">
												<span><?php echo $contact->ctphone.'-'.$contact->ctmobile; ?></span>
												
											</div>
										</li>
										<?php } ?>
										<?php if($contact->ctemail != '') { ?>
										<li>
											<span class="th-addressicon"><img src="<?php echo base_url(); ?>alwafa/images/icon/img-10.png" alt="<?php echo $contact->ctemail; ?>"></span>
											<div class="th-phone">
												<span><?php $emails = explode(' - ',$contact->ctemail); foreach($emails as $email) { echo '<a href="mailto:'.$email.'">'.$email.'</a> '; } //echo '<a href="mailto:'.str_replace(' - ','" style="color:#556677;"></a><a href="mailto:',$contact->ctemail).'" style="color:#556677;"></a>'; ?></span>
												
											</div>
										</li>
										<?php } ?>
									</ul>
								</div>
							</div>
							<?php } ?>
							
							<?php if(in_array('CT',$this->sections) && isset($contact) && !empty($contact) && $contact->ctactive == '1' && $contact->ctmap != '') { ?><div class="col-md-2 col-sm-6 col-xs-6">
							<?php } elseif(in_array('CT',$this->sections) && isset($contact) && !empty($contact) && $contact->ctactive == '1') { ?><div class="col-md-4 col-sm-9 col-xs-9">
							<?php } else { ?><div class="col-md-6 col-sm-12 col-xs-12">
							<?php } ?>
								<div class="th-fcol">
									<div class="th-borderheading">
										<h3>اهم الروابط</h3>
									</div>
									<ul class="th-usefullinks">
										<li><a href="<?php echo base_url(); ?>index">الرئيسية</a></li>
										<li><a href="<?php echo base_url(); ?>about">من نحن</a></li>
										<li><a href="#">اقسام المستشفى</a></li>
										<li><a href="#">الاحداث و الفعاليات</a></li>
										<li><a href="#">الخدمات الالكترونة</a></li>
										<li><a href="<?php echo base_url(); ?>contact">بيانات الاتصال</a></li>
									</ul>
								</div>
							</div>
							
							
							<?php if(in_array('CT',$this->sections) && isset($contact) && !empty($contact) && $contact->ctactive == '1' && $contact->ctmap != '') { ?><div class="col-md-2 col-sm-6 col-xs-6">
							<?php } elseif(in_array('CT',$this->sections) && isset($contact) && !empty($contact) && $contact->ctactive == '1') { ?><div class="col-md-4 col-sm-9 col-xs-9">
							<?php } else { ?><div class="col-md-6 col-sm-12 col-xs-12">
							<?php } ?>
								<div class="th-fcol">
									<div class="th-borderheading">
										<h3>روابط تهمك</h3>
									</div>
									<ul class="th-usefullinks">
										<li><a href="#">نصائح طبية</a></li>
										<li><a href="#">الهيكل التنظيمي</a></li>
										<li><a href="#">خريطة الموقع</a></li>
										<li><a href="#">الملاحظات و المقترحات</a></li>
									</ul>
									<p> &nbsp </p>
									<?php if(in_array('SM',$this->sections) && isset($contact) && $contact->smactive == '1') { ?>
									<ul class="th-socialicons th-socialiconsround">
										<?php if($contact->smfacebook != '') { ?><li><a href="<?php echo $contact->smfacebook; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
										<?php if($contact->smtwitter != '') { ?><li><a href="<?php echo $contact->smtwitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
										<?php if($contact->smyoutube != '') { ?><li><a href="<?php echo $contact->smyoutube; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li><?php } ?>
										<?php if($contact->sminstagram != '') { ?><li><a href="<?php echo $contact->sminstagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li><?php } ?>
										<?php if($contact->smlinkedin != '') { ?><li><a href="<?php echo $contact->smlinkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
									</ul>
									<?php } ?>
								</div>
							</div>
							
							<?php if(in_array('CT',$this->sections) && isset($contact) && !empty($contact) && $contact->ctactive == '1' && $contact->ctmap != '') { ?>
							<div class="col-md-5 col-sm-5 col-xs-5">
								<?php echo htmlspecialchars_decode($contact->ctmap); ?>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="th-footerbottombar">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-xs-12 text-center">
							<span class="th-copyright">&copy; Copyrights 2017. Al Wafaa Hospital All Rights Reserved | Powered by <a href="http://pixel4it.com/" target="_blank"><img src="<?php echo base_url(); ?>alwafa/images/pixel.png" style="margin-left: 10px; margin-top: -10px"></a></span>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!--************************************
				Footer End
		*************************************-->
	</div>
	<!--************************************
			Wrapper End
	*************************************-->
	<?php if(in_array('RS',$this->sections)) { ?>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="th-appointment-modal">
					<div class="th-appointmentcounters">
						<div class="th-formhead">
							<i><img src="<?php echo base_url(); ?>alwafa/images/icon/img-25.png" alt="image description"></i>
							<h3>احجز موعدك الآن <span>املأ استمارة الحجز</span></h3>
						</div>
						<?php
							//echo $admessage;
							$attributes = array('id' => 'submit_form', /*'data-parsley-validate' => '', */'class' => 'th-formappointment');
							if($this->session->userdata('uid') == FALSE) echo form_open('reservation', $attributes);
							else echo form_open('reservationlog', $attributes);
							echo validation_errors();
						?>
							<fieldset>
								<?php if($this->session->userdata('uid') == FALSE) { ?>
								<div class="form-group">
									<?php
									$data = array(
										'type' => 'text',
										'name' => 'name',
										'id' => 'name',
										'placeholder' => 'الاسم',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('name')
									);
									echo form_input($data);
									?>
								</div>
								<div class="form-group">
									<?php
									$data = array(
										'type' => 'email',
										'name' => 'email',
										'id' => 'email',
										'placeholder' => 'البريد الالكتروني',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('email')
									);
									echo form_input($data);
									?>
								</div>
								<div class="form-group">
									<span class="th-select">
										<?php
											$ourtypes[''] = 'الجنس';
											$ourtypes['ذكر'] = 'ذكر';
											$ourtypes['انثى'] = 'انثى';
											echo form_dropdown('type', $ourtypes, array(), '');
										?>
									</span>
								</div>
								<div class="form-group">
									<?php
									$data = array(
										'type' => 'text',
										'name' => 'mobile',
										'id' => 'mobile',
										'placeholder' => 'جوال',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('mobile')
									);
									echo form_input($data);
									?>
								</div>
								<?php } ?>
								<div class="form-group">
									<div class="th-dateinputicon">
										<i class="fa fa-calendar"></i>
										<?php
											$data = array(
												'type' => 'text',
												'name' => 'date',
												'id' => 'date',
												'placeholder' => 'تاريخ و وقت الحجز',
												'class' => 'form-control th-datetimepicker',
												//'max' => 255,
												//'required' => 'required',
												'value' => set_value('date')
											);
											echo form_input($data);
										?>
									</div>
								</div>
								<?php if(in_array('DP',$this->sections)) { ?>
									<div class="form-group">
										<span class="th-select">
										<?php
											$ourtypes1[''] = 'اختر القسم';
											if(!empty($departs))
											{
												//$ourtypes1[] = lang('select');
												foreach($departs as $depart)
												{
													$ourtypes1[$depart->dpid] = $depart->dptitle;
												}											
											}
											if(in_array('DR',$this->sections)) $jquery = 'id="depart"'; else $jquery = '';
											echo form_dropdown('depart', $ourtypes1, array(), $jquery);
										?>
										</span>
									</div>

									<?php if(in_array('DR',$this->sections)) { ?>
										<div class="form-group" id="doctors">
											<span class="th-select" id="doctorsdiv">
												<select name="doctor">
													<option value="">اسم الدكتور</option>
												</select>
											</span>
										</div>
									<?php } ?>
								<?php } ?>
								<?php
									$data = array(
										'name' => 'submit',
										'id' => 'submit',
										'class' => 'th-btnform th-btnform-lg',
										'value' => 'true',
										'type' => 'submit',
										//'disabled' => 'disabled',
										'content' => 'احجز الآن'
									);
									echo form_button($data);
								?>
							</fieldset>
						<?php
							echo form_close();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	
	<?php if(in_array('MG',$this->sections)) { ?>
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="">
					<div class="th-appointmentcounters">
						<div class="th-formhead">
							<h3>للمساعدة و الاستفسار</h3>
						</div>
						<?php
							//echo $admessage;
							$attributes = array('id' => 'submit_form', /*'data-parsley-validate' => '', */'class' => 'th-formappointment');
							if($this->session->userdata('uid') == FALSE) echo form_open('sendmessage', $attributes);
							else echo form_open('sendmessagelog', $attributes);
							echo validation_errors();
						?>
							<fieldset>
							<?php if($this->session->userdata('uid') == FALSE) { ?>
								<div class="form-group">
									<?php
									$data = array(
										'type' => 'text',
										'name' => 'name',
										'id' => 'name',
										'placeholder' => 'الاسم',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('name')
									);
									echo form_input($data);
									?>
								</div>
								<div class="form-group">
									<?php
									$data = array(
										'type' => 'email',
										'name' => 'email',
										'id' => 'email',
										'placeholder' => 'البريد الالكتروني',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('email')
									);
									echo form_input($data);
									?>
								</div>
								<div class="form-group">
									<?php
									$data = array(
										'type' => 'text',
										'name' => 'mobile',
										'id' => 'mobile',
										'placeholder' => 'الجوال',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('mobile')
									);
									echo form_input($data);
									?>
								</div>
							<?php } ?>
								<div class="form-group">
									<?php
									$data = array(
										'type' => 'text',
										'name' => 'title',
										'id' => 'title',
										'placeholder' => 'عنوان الرسالة',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('title')
									);
									echo form_input($data);
									?>
								</div>				
								<div class="form-group">
									<?php
									$data = array(
										'name' => 'body',
										'id' => 'body',
										'placeholder' => 'تفاصيل الرسالة',
										'class' => 'form-control th-textarea',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('body')
									);
									echo form_textarea($data);
									?>
								</div>
								<?php
									$data = array(
										'name' => 'submit',
										'id' => 'submit',
										'class' => 'th-btnform th-btnform-lg',
										'value' => 'true',
										'type' => 'submit',
										//'disabled' => 'disabled',
										'content' => 'ارسال الرسالة'
									);
									echo form_button($data);
								?>
							</fieldset>
						<?php
							echo form_close();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>

	<script src="<?php echo base_url(); ?>alwafa/js/vendor/jquery-library.js"></script>
	<script>
	$(document).ready(function(){
		$("#depart").change(function(){
			var val = $(this).val();
			var val2 = $('#date').val();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>frontend/getdoctors',
				data: {
					'id' : val,
					'date' : val2,
				},
				success: function (response) { document.getElementById('doctors').innerHTML = response; }
			});
		});
	});
	
	$(document).ready(function(){
		$("#date").focusout(function(){
			var val = $('#depart').val();
			var val2 = $(this).val();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>frontend/getdoctors',
				data: {
					'id' : val,
					'date' : val2,
				},
				success: function (response) { document.getElementById('doctors').innerHTML = response; }
			});
		});
	});
	</script>
	<?php $this->load->view('messages'); ?>
	<script src="<?php echo base_url(); ?>alwafa/js/menu.js"></script>
	<script src="<?php echo base_url(); ?>alwafa/js/vendor/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>alwafa/js/moment-with-locales.js"></script>
	<script src="<?php echo base_url(); ?>alwafa/js/bootstrap-datetimepicker.min.js"></script>
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=en"></script>
	<script src="<?php echo base_url(); ?>alwafa/js/owl.carousel.min.js"></script>
	<script src="<?php echo base_url(); ?>alwafa/js/finalcountdown.js"></script>
	<script src="<?php echo base_url(); ?>alwafa/js/jquery.countTo.js"></script>
	<script src="<?php echo base_url(); ?>alwafa/js/isotope.pkgd.js"></script>
	<script src="<?php echo base_url(); ?>alwafa/js/parallax.min.js"></script>
	<script src="<?php echo base_url(); ?>alwafa/js/prettyPhoto.js"></script>
	<script src="<?php echo base_url(); ?>alwafa/js/appear.js"></script>
	<script src="<?php echo base_url(); ?>alwafa/js/gmap3.js"></script>
	<script src="<?php echo base_url(); ?>alwafa/js/themefunction.js"></script>
	
	<!-- gallery with share icon-->
		<script src="<?php echo base_url(); ?>alwafa/js/lightgallery.js"></script>
		<script src="<?php echo base_url(); ?>alwafa/js/lg-hash.js"></script>
		<script src="<?php echo base_url(); ?>alwafa/js/lg-share.js"></script>
		<script src="<?php echo base_url(); ?>alwafa/js/demos.js"></script>
	<!-- End Gallery -->
</body>

</html>