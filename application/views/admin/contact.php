		<div class="right_col" role="main">
          <div class="" >
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('contact'); ?></h3>
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
						//echo form_error('name');
						echo validation_errors();
						$attributes = array('id' => 'submit_form', /*'data-parsley-validate' => '', */'class' => 'form-horizontal form-label-left');
						echo form_open('contactus/contactedit', $attributes);
					?>
                    <!--<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">-->

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
								'name' => 'address',
								'id' => 'address',
								'placeholder' => lang('address'),
								'class' => 'form-control col-md-7 col-xs-12',
								'value' => $contact->ctaddress
							);
							echo form_textarea($data);
						?>
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
								//'required' => 'required',
								//'readonly' => 'TRUE',
								'value' => $contact->ctphone
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
							echo form_label(lang('mobile'),'mobile',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php
							$data = array(
								'type' => 'text',
								'name' => 'mobile',
								'id' => 'mobile',
								'placeholder' => lang('mobile'),
								'class' => 'form-control col-md-7 col-xs-12',
								//'max' => 255,
								//'required' => 'required',
								//'readonly' => 'TRUE',
								'value' => $contact->ctmobile
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
							echo form_label(lang('email'),'email',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php
							$data = array(
								'type' => 'text',
								'name' => 'email',
								'id' => 'email',
								'placeholder' => lang('email'),
								'class' => 'form-control col-md-7 col-xs-12',
								//'max' => 255,
								//'required' => 'required',
								//'readonly' => 'TRUE',
								'value' => $contact->ctemail
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
							echo form_label(lang('map'),'map',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php
							$data = array(
								'name' => 'map',
								'id' => 'map',
								'placeholder' => lang('map'),
								'class' => 'form-control col-md-7 col-xs-12',
								'value' => htmlspecialchars_decode($contact->ctmap)
							);
							echo form_textarea($data);
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
							if($contact->ctactive == '1') $data['checked'] = 'TRUE';
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