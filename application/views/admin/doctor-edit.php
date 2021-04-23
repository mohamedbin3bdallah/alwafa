		<div class="right_col" role="main">
          <div class="" >
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('edit_doctor'); ?></h3>
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
						echo form_open('doctors/editdoctor/'.$doctor['id'], $attributes);
					?>
                    <!--<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">-->

                      <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('name').' <span class="required">*</span>','title',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php
							$data = array(
								'type' => 'text',
								'name' => 'title',
								'id' => 'title',
								'placeholder' => lang('name'),
								'class' => 'form-control col-md-7 col-xs-12',
								//'max' => 255,
								//'required' => 'required',
								//'readonly' => 'TRUE',
								'value' => $doctor['title']
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
							echo form_label(lang('desc').' <span class="required">*</span>','desc',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php
							$data = array(
								'name' => 'desc',
								'id' => 'desc',
								'placeholder' => lang('desc'),
								'class' => 'form-control col-md-7 col-xs-12',
								'value' => $doctor['desc']
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
								//'pattern' => '[0-9]{8,}',
								//'title' => 'must be mobile',
								'value' => $doctor['phone']
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
							echo form_label(lang('appointments').' <span class="required">*</span>','',$data);
						?>
						<div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
							<table id="/*datatable-buttons*/" class="mytable table table-striped table-bordered nowrap"  dir="rtl">
								<tr>
									<th width="30%" style="text-align:center;"><?php echo lang('day'); ?></th>
									<th width="30%" style="text-align:center;"><?php echo lang('from'); ?></th>
									<th width="30%" style="text-align:center;"><?php echo lang('to'); ?></th>
									<th width="10%" style="text-align:center;"></th>
								</tr>
								<?php
									if(isset($doctor['appoints']) && !empty($doctor['appoints']))
									{
										for($i=0;$i<count($doctor['appoints']);$i++)
										{
											?><tr><td><select name="day[]" class="form-control" required="required"><option value="sat" <?php if($doctor['appoints'][$i]['day'] == 'sat') echo 'selected'; ?>><?php echo lang('sat'); ?></option><option value="sun" <?php if($doctor['appoints'][$i]['day'] == 'sun') echo 'selected'; ?>><?php echo lang('sun'); ?></option><option value="mon" <?php if($doctor['appoints'][$i]['day'] == 'mon') echo 'selected'; ?>><?php echo lang('mon'); ?></option><option value="tue" <?php if($doctor['appoints'][$i]['day'] == 'tue') echo 'selected'; ?>><?php echo lang('tue'); ?></option><option value="wed" <?php if($doctor['appoints'][$i]['day'] == 'wed') echo 'selected'; ?>><?php echo lang('wed'); ?></option><option value="thu" <?php if($doctor['appoints'][$i]['day'] == 'thu') echo 'selected'; ?>><?php echo lang('thu'); ?></option><option value="fri" <?php if($doctor['appoints'][$i]['day'] == 'fri') echo 'selected'; ?>><?php echo lang('fri'); ?></option></select></td><td><input type="time" name="from[]" class="form-control" value="<?php echo $doctor['appoints'][$i]['from']; ?>" required="required" /></td><td><input type="time" name="to[]" class="form-control" value="<?php echo $doctor['appoints'][$i]['to']; ?>" required="required" /></td><td style="text-align:center;"><?php if($i != 0) { ?><i class="delete glyphicon glyphicon-remove"></i><?php } ?></td></tr><?php
										}
									}
								?>
								<?php if(empty($doctor['appoints'])) { ?><tr><td><select name="day[]" class="form-control" required="required"><option value="sat"><?php echo lang('sat'); ?></option><option value="sun"><?php echo lang('sun'); ?></option><option value="mon"><?php echo lang('mon'); ?></option><option value="tue"><?php echo lang('tue'); ?></option><option value="wed"><?php echo lang('wed'); ?></option><option value="thu"><?php echo lang('thu'); ?></option><option value="fri"><?php echo lang('fri'); ?></option></select></td><td><input type="time" name="from[]" class="form-control" required="required" /></td><td><input type="time" name="to[]" class="form-control" required="required" /></td><td style="text-align:center;"></td></tr><?php } ?>
							</table>
						</div>
                      </div>
					  <div class="form-group">
                        <?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(' ','',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
							<i class="add btn btn-info"><?php echo lang('add_appoint'); ?></i>
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
							if($doctor['active'] == '1') $data['checked'] = 'TRUE';
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