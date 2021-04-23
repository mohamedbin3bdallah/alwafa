        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('incomes'); ?></h3>
              </div>

              <!--<div class="">
                <div class="col-md-3 col-sm-3 col-xs-5 col-md-offset-9 col-sm-offset-9 col-xs-offset-7 form-group top_search">
                  <div class="input-group">
					<button type="button" class="btn btn-primary" onclick="location.href = 'shops/add'"><?php //echo lang('add_shop'); ?></button>
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
						echo $admessage;
						echo validation_errors();
						$attributes = array('id' => 'submit_form', /*'data-parsley-validate' => '', */'class' => 'form-horizontal form-label-left', 'target' => '_blank');
						echo form_open_multipart('reports/incomes_pdf', $attributes);
					?>
                    <!--<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">-->

					<div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('branch'),'branch',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						<?php
							if(!empty($branches))
							{
								$ourtypes0[] = lang('select');
								foreach($branches as $branch)
								{
									$ourtypes0[$branch->bcid] = $branch->bcname;
								}											
								echo form_dropdown('branch', $ourtypes0, array(), 'id="branch" class="form-control" required="required"');
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
							echo form_label(lang('type').' <span class="required">*</span>','type',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						<?php
							$ourtypes = array(/*lang('select'),*/'D'=>lang('daily'), 'M'=>lang('monthly'), 'Y'=>lang('yearly'));
							echo form_dropdown('type', $ourtypes, array(), 'id="type" class="form-control" required="required"');
						?>
                        </div>
                      </div>
                      <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('from'),'from',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12" id="from">
						  <?php
							if($system->calendar == 'hj') { $type = 'text'; $pattern = '[0-9]{4}.(0[1-9]|1[012]).(0[1-9]|1[0-9]|2[0-9]|3[01])'; $title = 'برجاء كتابة التاريخ بشكل صحيح'; }
							else { $type = 'date'; $pattern = ''; $title = ''; }
							$data = array(
								'type' => $type,
								'name' => 'from',
								'id' => 'from',
								'pattern' => $pattern,
								'title' => $title,
								'placeholder' => 'YYYY-MM-DD هجري',
								'class' => 'form-control col-md-7 col-xs-12',
								'value' => set_value('from')
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
							echo form_label(lang('to'),'to',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12" id="to">
						  <?php
							$data = array(
								'type' => $type,
								'name' => 'to',
								'id' => 'to',
								'pattern' => $pattern,
								'title' => $title,
								'placeholder' => 'YYYY-MM-DD هجري',
								'class' => 'form-control col-md-7 col-xs-12',
								'value' => set_value('to')
							);
							echo form_input($data);
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
								'content' => lang('search')
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
        <!-- /page content -->