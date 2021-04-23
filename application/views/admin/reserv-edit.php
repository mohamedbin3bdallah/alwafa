		<div class="right_col" role="main">
          <div class="" >
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('edit_reserv'); ?></h3>
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
						echo form_open('reservs/editreserv/'.$reserv->rsid, $attributes);
					?>
                    <!--<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">-->

                      <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('name'),'name',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php if($reserv->rseid != 0) echo $employees[$reserv->rseid]['name']; else echo $reserv->rsname; ?>
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
						  <?php if($reserv->rseid != 0) echo $employees[$reserv->rseid]['email']; else echo $reserv->rsemail; ?>
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
						  <?php if($reserv->rseid != 0) echo $employees[$reserv->rseid]['phone']; else echo $reserv->rsmobile; ?>
                        </div>
                      </div>
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('type'),'type',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php if($reserv->rseid != 0) echo $employees[$reserv->rseid]['type']; else echo $reserv->rstype; ?>
                        </div>
                      </div>
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('reservtime').' <span class="required">*</span>','date',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php
							if(in_array('DP',$this->sections)) $datediv = 'date'; else $datediv = '';
							$data = array(
								'type' => 'datetime-local',
								'name' => 'date',
								'id' => $datediv,
								'placeholder' => lang('reservtime'),
								'class' => 'form-control col-md-7 col-xs-12',
								//'max' => 255,
								//'pattern' => '[0-9]{8,}',
								//'title' => 'must be mobile',
								'value' => date('Y-m-d',$reserv->rsdate).'T'.date('H:i',$reserv->rsdate)
							);
							echo form_input($data);
						?>
                        </div>
                      </div>
					  <?php if(in_array('DP',$this->sections)) { ?>
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('depart').' <span class="required">*</span>','depart',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						<?php
							if(in_array('DR',$this->sections)) $departdiv = 'depart'; else $departdiv = '';
							$ourtypes = array();
							$ourtypes[] = lang('select');
							if(!empty($departs))
							{
								foreach($departs as $depart)
								{
									$ourtypes[$depart->dpid] = $depart->dptitle;
								}
							}
							echo form_dropdown('depart', $ourtypes, set_value('depart', $reserv->rsdpid), 'id="'.$departdiv.'" class="form-control" required="required"');
						?>
                        </div>
                      </div>
					  <?php if(in_array('DR',$this->sections)) { ?>
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('doctor').' <span class="required">*</span>','doctor',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12" id="doctors">
						<?php
							$ourtypes1 = array();
							$ourtypes1[] = lang('select');
							if(!empty($doctors))
							{
								foreach($doctors as $doctor)
								{
									$ourtypes1[$doctor->drid] = $doctor->drtitle;
								}											
							}
							echo form_dropdown('doctor', $ourtypes1, set_value('doctor', $reserv->rsdrid), 'id="doctor" class="form-control" required="required"');
						?>
                        </div>
                      </div>
					  <?php } } ?>
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('notes').' <span class="required">*</span>','notes',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php
							$data = array(
								'name' => 'notes',
								'id' => 'notes',
								'placeholder' => lang('notes'),
								'class' => 'form-control col-md-7 col-xs-12',
								'value' => $reserv->rsnotes
							);
							echo form_textarea($data);
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