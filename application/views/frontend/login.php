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
</head>
<body>
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
										<li><a href='<?php echo base_url(); ?>index'>الرئيسية</a></li>
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
		<div class="th-innerpagebanner th-haslayout th-parallaximg" data-appear-top-offset="600" data-parallax="scroll" data-image-src="<?php echo base_url(); ?>alwafa/images/bgparallax/bgparallax-05.jpg">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<div class="th-pagetitle">
							<h1>تسجيل دخول</h1>
						</div>
						<ol class="th-breadcrumb">
							<li><a href="<?php echo base_url(); ?>index">الرئيسية</a></li>
							<li><span>تسجيل دخول</span></li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<!--************************************
				Home Slider End
		*************************************-->
		<!--************************************
				Main Start
		*************************************-->
		<main id="th-main" class="th-main th-haslayout th-topbottompaddingzero">
		<section class="th-sectionspace th-haslayout">
			<div class="container">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<?php
							//echo $admessage;
							$attributes = array('id' => 'submit_form', /*'data-parsley-validate' => '', */'class' => 'th-formappointment');
							echo form_open('userlog', $attributes);
							echo validation_errors();
						?>
							<?php if(isset($activemessage)) echo $activemessage; ?>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<h3 class="text-right">تسجيل دخول</h3>
							</div>
							<fieldset>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
									<?php
									$data = array(
										'type' => 'text',
										'name' => 'username',
										'id' => 'username',
										'placeholder' => 'اسم المستخدم',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('username')
									);
									echo form_input($data);
									?>
									</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
									<?php
									$data = array(
										'type' => 'password',
										'name' => 'password',
										'id' => 'password',
										'placeholder' => 'كلمة المرور',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('password')
									);
									echo form_input($data);
									?>
									</div>
								</div>
								<div class="col-md-8 col-sm-8 col-xs-12 text-right">
									<div class="form-group">
										تذكرني <input type="radio" name="remember" value="1">
									</div>
									<?php if(!empty($this->pages) && in_array('forgotpassword',$this->pages['url'])) { ?><a href="<?php echo base_url(); ?>forgotpassword">نسيت كلمة المرور أو اسم المستخدم</a><?php } ?>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12 text-left">
									<div class="form-group">
									<?php
									$data = array(
										'name' => 'submit',
										'id' => 'submit',
										'class' => 'th-btnform th-btnform-lg',
										'value' => 'true',
										'type' => 'submit',
										//'disabled' => 'disabled',
										'content' => 'دخول'
									);
									echo form_button($data);
									?>
									</div>
								</div>
							</fieldset>
						<?php
							echo form_close();
						?>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<img src="<?php echo base_url(); ?>alwafa/images/login.png">
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		
		</section>
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
</body>
</html>