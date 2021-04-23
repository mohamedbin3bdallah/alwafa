		<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('add_order'); ?></h3>
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
						echo form_open('orders/create', $attributes);
					?>
                    <!--<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">-->

					  <!--<div class="form-group">
						<?php
							/*$data = array(
								'class' => 'control-label col-md-2 col-md-push-10 col-sm-2 col-sm-push-10 col-xs-12'
							);
							echo form_label(lang('code').' <span class="required">*</span>','code',$data);*/
						?>
                        <div class="col-md-10 col-md-pull-2 col-sm-10 col-sm-pull-2 col-xs-12">
						<?php
							/*$data = array(
								'type' => 'text',
								'name' => 'code',
								'id' => 'code',
								'placeholder' => lang('code'),
								'class' => 'form-control',
								'max' => 255,
								'required' => 'required',
								//'readonly' => TRUE,
								'value' => set_value('code')
							);
							echo form_input($data);*/
						?>
                        </div>
                      </div>-->
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-2 col-md-push-10 col-sm-2 col-sm-push-10 col-xs-12'
							);
							echo form_label(lang('enddate'),'enddate',$data);
						?>
						 <div class="col-md-4 col-md-push-4 col-sm-4 col-sm-push-4 col-xs-12">
						  <?php
							if($system->calendar == 'hj') { $type = 'text'; $pattern = '[0-9]{4}.(0[1-9]|1[012]).(0[1-9]|1[0-9]|2[0-9]|3[01])'; $title = 'برجاء كتابة التاريخ بشكل صحيح'; $min = ''; }
							else { $type = 'date'; $pattern = ''; $title = ''; $min = date('Y-m-d'); }
							$data = array(
								'type' => $type,
								'name' => 'enddate',
								'id' => 'enddate',
								'pattern' => $pattern,
								'title' => $title,
								'placeholder' => 'YYYY-MM-DD هجري',
								'class' => 'form-control',
								'min' => $min,
								//'required' => 'required',
								'value' => set_value('enddate')
							);
							echo form_input($data);
						?>
                        </div>
						<?php
							$data = array(
								'class' => 'control-label col-md-2 col-md-pull-3 col-sm-2 col-sm-pull-3 col-xs-12'
							);
							echo form_label(lang('endtime'),'endtime',$data);
						?>
                        <div class="col-md-4 col-md-pull-8 col-sm-4 col-sm-pull-8 col-xs-12">
						  <?php
							$data = array(
								'type' => 'time',
								'name' => 'endtime',
								'id' => 'endtime',
								'placeholder' => lang('endtime'),
								'class' => 'form-control',
								//'required' => 'required',
								'value' => set_value('endtime')
							);
							echo form_input($data);
						?>
                        </div>
                      </div>
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-2 col-md-push-10 col-sm-2 col-sm-push-10 col-xs-12'
							);
							echo form_label(lang('branch').' <span class="required">*</span>','branch',$data);
						?>
                        <div class="col-md-10 col-md-pull-2 col-sm-10 col-sm-pull-2 col-xs-12">
						<?php
							if(!empty($branches))
							{
								foreach($branches as $branch)
								{
									$ourtypes[$branch->bcid] = $branch->bcname;
								}											
								echo form_dropdown('branch', $ourtypes, array(), 'id="branch" class="form-control" required="required"');
							}
							else echo lang('no_data');
						?>
                        </div>
                      </div>
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-2 col-md-push-10 col-sm-2 col-sm-push-10 col-xs-12'
							);
							echo form_label(lang('customer').' <span class="required">*</span>','customer',$data);
						?>
                        <div class="col-md-10 col-md-pull-2 col-sm-10 col-sm-pull-2 col-xs-12">
							<input list="customers" class="form-control" maxlength="255" name="customer" required="required">
							<datalist id="customers">
								<?php foreach($customers as $customer) { ?>
									<option value="<?php echo $customer->cname; ?>" customerid="<?php echo $customer->cid; ?>"></option>
								<?php } ?>
							</datalist>
                        </div>
                      </div>
					   <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-2 col-md-push-10 col-sm-2 col-sm-push-10 col-xs-12'
							);
							echo form_label(lang('info'),'',$data);
						?>
						<div class="col-md-10 col-md-pull-2 col-sm-10 col-sm-pull-2 col-xs-12">
							<?php if(!empty($items)) { ?>
							<table id="/*datatable-buttons*/" class="mytable table table-striped table-bordered nowrap"  dir="rtl">
								<tr>
									<th width="25%" style="text-align:center;"><?php echo lang('item'); ?></th>
									<th width="10%" style="text-align:center;"><?php echo lang('qrest'); ?></th>
									<th width="7%" style="text-align:center;"><?php echo lang('price'); ?></th>
									<th width="7%" style="text-align:center;"><?php echo lang('quantity'); ?></th>
									<th width="10%" style="text-align:center;"><?php echo lang('department'); ?></th>
									<th width="6%" style="text-align:center;"><?php echo lang('addtobill'); ?></th>
									<th width="5%" style="text-align:center;"></th>
								</tr>
								<!--<tr><td><select name="item[]" class="form-control" required="required"><?php foreach($items as $item) { ?><option value="<?php echo $item->iid; ?>"><?php echo $item->iname; ?></option><?php } ?></select></td><td><input type="text" name="price[]" class="form-control" placeholder="00.00" maxlength="10" required="required"/></td><td><input type="number" name="quantity[]" class="form-control" placeholder="الكمية" min="1" max="999" required="required" /></td><td></td></tr>-->
								<tr><td><input list="items" oninput="onInput(this)" id="input" name="item[]" maxlength="255" onkeyup="/*showResult(this.value)*/" class="form-control" required="required"><datalist id="items"><?php foreach($items as $item) { ?><option value="<?php echo $item->iname; ?>" wholesaleprice="<?php echo $item->iwholesaleprice; ?>" retailprice="<?php echo $item->iretailprice; ?>" quantity="<?php echo $item->iquantity; ?>"><?php echo $item->store.' | '.$item->icode; ?></option><?php } ?></datalist></td><td style="text-align:center;"></td><td><input type="text" name="price[]" class="form-control" placeholder="00.00" maxlength="10" oninput="mytotal()" required="required" /><?php echo ' '.$system->currency; ?></td><td><input type="number" name="quantity[]" class="form-control" placeholder="الكمية" min="1" required="required" oninput="onQuantity(this)" /></td><td><select name="usertype[]" class="form-control" required="required"><?php foreach($usertypes as $usertype) { ?><option value="<?php echo $usertype->utid; ?>"><?php echo $usertype->utname; ?></option><?php } ?></select></td><td style="text-align:center;"><input type="hidden" name="addtobill[]" value="0" /><input type="checkbox" class="/*js-switch*/" value="1" onclick="this.previousSibling.value=1-this.previousSibling.value" /></td><td style="text-align:center;"></td></tr>
							</table>
							<table class="table" style="border-style:solid;">
								<tr>
									<td width="50%" style="text-align:center;"><?php echo lang('total'); ?></td>
									<td><input type="text" name="total" id="total" class="form-control" readonly><?php echo ' '.$system->currency; ?></td>
								</tr>
							</table>
							<?php } else { echo lang('no_data'); } ?>
						</div>
                      </div>
					  <?php if(!empty($items)) { ?>
					  <div class="form-group">
                        <?php
							$data = array(
								'class' => 'control-label col-md-2 col-md-push-10 col-sm-2 col-sm-push-10 col-xs-12'
							);
							echo form_label(' ','',$data);
						?>
                        <div class="col-md-10 col-md-pull-2 col-sm-10 col-sm-pull-2 col-xs-12">
							<i class="add btn btn-info"><?php echo lang('add_item'); ?></i>
                        </div>
                      </div>
					  <?php } ?>
					   <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-2 col-md-push-10 col-sm-2 col-sm-push-10 col-xs-12'
							);
							echo form_label(lang('notes'),'notes',$data);
						?>
                        <div class="col-md-10 col-md-pull-2 col-sm-10 col-sm-pull-2 col-xs-12">
						  <?php
							$data = array(
								'name' => 'notes',
								'id' => 'notes',
								'placeholder' => lang('notes'),
								'class' => 'form-control',
								'value' => set_value('notes')
							);
							echo form_textarea($data);
						?>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-6 col-xs-12 col-md-offset-3">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#formsubmit"><?php echo lang('save'); ?></button>
						<div id="formsubmit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-sm">
								<div class="modal-content">
									<div class="modal-header">
										<?php echo lang('continueproccess'); ?>
										<br>
									</div>
									<div class="modal-body">
										<center>
											<?php
												$data = array(
													'name' => 'submit',
													'id' => 'submit',
													'class' => 'btn btn-success',
													'value' => 'true',
													'type' => 'submit',
													'content' => lang('yes')
												);
												echo form_button($data);
											?>
											<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><?php echo lang('no'); ?></button>
									</center>
									</div>
								</div>
							</div>
						</div>
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