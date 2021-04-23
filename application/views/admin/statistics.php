        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('statistics'); ?></h3>
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
						echo form_open_multipart('reports/statistics_pdf', $attributes);
					?>
                    <!--<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">-->

					<div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('orderby').' <span class="required">*</span>','orderby',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						<?php
							echo form_dropdown('orderby', array('DESC'=>lang('more'),'ASC'=>lang('less')), array(), 'id="store" class="form-control" required="required"');
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
							echo form_dropdown('type', array(/*'UT'=>lang('usertypes'),'U'=>lang('users'),'BC'=>lang('branches'),*/'C'=>lang('customers')/*,'D'=>lang('delegates'),'IT'=>lang('itemtypes'),'IM'=>lang('itemmodels')*/,'I'=>lang('items')), array(), 'id="type" class="form-control" required="required"');
						?>
                        </div>
                     </div>
					 <div class="form-group" id="stores">
					 </div>
					 <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('noreportshow'),'noreportshow',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php
							$data = array(
								'type' => 'number',
								'name' => 'no',
								'id' => 'no',
								'placeholder' => lang('noreportshow'),
								'class' => 'form-control col-md-7 col-xs-12',
								'min' => 1,
								'max' => 999999999,
								'step' => 1,
								/*'pattern' => '[0-9]{1,}',
								'title' => 'must be quantity',
								'required' => 'required',*/
								'value' => set_value('noreportshow')
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