		<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('edit_user'); ?></h3>
              </div>

              <!--<div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>-->
            </div>
			
            <div class="clearfix"></div>
            
			<div class="row" dir="rtl">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <!--<h2>Form Design <small>different form elements</small></h2>-->
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <!--<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>-->
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
					<?php
						//echo $admessage;
						echo validation_errors();
						$attributes = array('id' => 'submit_form', /*'data-parsley-validate' => '', */'class' => 'form-horizontal form-label-left');
						echo form_open('users/edituser/'.$user->uid, $attributes);
					?>
                    <!--<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">-->

					  <input type="hidden" name="thisid" id="thisid" value="<?php echo $user->uid; ?>">
					  
                      <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('name').' <span class="required">*</span>','name',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php
							$data = array(
								'type' => 'text',
								'name' => 'name',
								'id' => 'name',
								'placeholder' => lang('name'),
								'class' => 'form-control col-md-7 col-xs-12',
								//'max' => 255,
								//'required' => 'required',
								'value' => $user->uname
							);
							echo form_input($data);
						?>
							<div id="name_validation"></div>
							<input type="hidden" name="name_validation_h" id="name_validation_h" value="1">
                        </div>
                      </div>
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('username').' <span class="required">*</span>','username',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php
							$data = array(
								'type' => 'text',
								'name' => 'username',
								'id' => 'username',
								'placeholder' => lang('username'),
								'class' => 'form-control col-md-7 col-xs-12',
								//'max' => 255,
								//'pattern' => '[a-z]{5,}',
								//'title' => '5 حروف  انجليزية فاكثر',
								//'required' => 'required',
								'value' => $user->username
							);
							echo form_input($data);
						?>
							<div id="username_validation"></div>
							<input type="hidden" name="username_validation_h" id="username_validation_h" value="1">
                        </div>
                      </div>
                      <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('email').' <span class="required">*</span>','email',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php
							$data = array(
								'type' => 'email',
								'name' => 'email',
								'id' => 'email',
								'placeholder' => lang('email'),
								'class' => 'form-control col-md-7 col-xs-12',
								//'max' => 255,
								//'required' => 'required',
								'value' => $user->uemail
							);
							echo form_input($data);
						?>
							<div id="email_validation"></div>
							<input type="hidden" name="email_validation_h" id="email_validation_h" value="1">
                        </div>
                      </div>
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('usertype').' <span class="required">*</span>','usertype',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						<?php
							if(!empty($usertypes))
							{
								foreach($usertypes as $usertype)
								{
									$ourtypes[$usertype->utid] = $usertype->utname;
								}											
								echo form_dropdown('usertype', $ourtypes, set_value('usertype', $user->uutid), 'id="usertype" class="form-control" required="required"');
							}
							else echo lang('no_data');
						?>
                        </div>
                      </div>
                      <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('password'),'password',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						<?php
							$data = array(
								'type' => 'password',
								'name' => 'password',
								'id' => 'password',
								'placeholder' => lang('password'),
								'class' => 'form-control col-md-7 col-xs-12',
								//'min' => 6,
								//'max' => 255,
								'value' => ''
							);
							echo form_input($data);
						?>
							<div id="password_validation"></div>
							<input type="hidden" name="password_validation_h" id="password_validation_h" value="1">
                        </div>
                      </div>
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('cnfpassword'),'cnfpassword',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php
							$data = array(
								'type' => 'password',
								'name' => 'cnfpassword',
								'id' => 'cnfpassword',
								'placeholder' => lang('cnfpassword'),
								'class' => 'form-control col-md-7 col-xs-12',
								//'min' => 6,
								//'max' => 255,
								'value' => ''
							);
							echo form_input($data);
						?>
							<div id="cnfpassword_validation"></div>
							<input type="hidden" name="cnfpassword_validation_h" id="cnfpassword_validation_h" value="1">
                        </div>
                      </div>
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('phone'),'phone',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php
							$data = array(
								'type' => 'text',
								'name' => 'phone',
								'id' => 'phone',
								'placeholder' => lang('phone'),
								'class' => 'form-control col-md-7 col-xs-12',
								//'max' => 255,
								//'pattern' => '[0-9]{8,}',
								//'title' => 'must be phone',
								'value' => $user->uphone
							);
							echo form_input($data);
						?>
                        </div>
                      </div>
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('address'),'address',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php
							$data = array(
								'type' => 'text',
								'name' => 'address',
								'id' => 'address',
								'placeholder' => lang('address'),
								'class' => 'form-control col-md-7 col-xs-12',
								//'max' => 255,
								'value' => $user->uaddress
							);
							echo form_input($data);
						?>
                        </div>
                      </div>
                      <div class="form-group">
                        <?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('active'),'active',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php
							$data = array(
								'name' => 'active',
								'id' => 'active',
								/*'checked' => 'TRUE',*/
								'class' => 'js-switch',
								'value' => 1
							);
							if($user->uactive == '1') $data['checked'] = 'TRUE';
							echo form_checkbox($data);
						?>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-6 col-xs-12 col-md-offset-3">
						  <?php																				
							$data = array(
								'name' => 'submit',
								'id' => 'submit',
								'class' => 'btn btn-success',
								'value' => 'true',
								'type' => 'submit',
								'content' => lang('edit')
							);
							echo form_button($data);
						?>
                        </div>
                      </div>

                    <?php								
						echo form_close();
					?>
                  </div>
                </div>
              </div>
            </div>
		  </div>
        </div>