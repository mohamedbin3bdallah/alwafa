		<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('edit_order').' '.$order->oid; ?></h3>
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
						echo $admessage;
						echo validation_errors();
						$attributes = array(/*'id' => 'demo-form2', 'data-parsley-validate' => '', */'class' => 'form-horizontal form-label-left');
						echo form_open('orders/editorder/'.$order->oid, $attributes);
					?>
                    <!--<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">-->

					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('code').' <span class="required">*</span>','code',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						<?php
							$data = array(
								'type' => 'text',
								'name' => 'code',
								'id' => 'code',
								'placeholder' => lang('code'),
								'class' => 'form-control col-md-7 col-xs-12',
								'max' => 255,
								'required' => 'required',
								/*'readonly' => TRUE,*/
								'value' => $order->ocode
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
							echo form_label(lang('customer').' <span class="required">*</span>','customer',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						<?php
							if(!empty($customers))
							{
								foreach($customers as $customer)
								{
									$ourtypes[$customer->cid] = $customer->cname;
								}											
								echo form_dropdown('customer', $ourtypes, array('customer'=>$order->ocid), 'class="form-control" required="required"');
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
							echo form_label(lang('info'),'',$data);
						?>
						<div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
							<?php if(!empty($items) && !empty($orderitems)) { ?>
							<table id="/*datatable-buttons*/" class="mytable table table-striped table-bordered nowrap"  dir="rtl">
								<tr>
									<th width="50%" style="text-align:center;"><?php echo lang('item'); ?></th>
									<th width="25%" style="text-align:center;"><?php echo lang('price'); ?></th>
									<th width="20%" style="text-align:center;"><?php echo lang('quantity'); ?></th>
									<th width="5%" style="text-align:center;"></th>
								</tr>
								<?php for($it=0;$it<count($orderitems);$it++) { ?>
									<tr><td><select name="item[]" class="form-control" required="required"><?php foreach($items as $item) { ?><option value="<?php echo $item->iid; ?>" <?php if($item->iid == $orderitems[$it]->oiiid) echo 'selected'; ?>><?php echo $item->iname; ?></option><?php } ?></select></td><td><input type="text" name="price[]" class="form-control" placeholder="00.00" maxlength="10" value="<?php echo $orderitems[$it]->oiprice; ?>" required="required"/></td><td><input type="number" name="quantity[]" class="form-control" placeholder="الكمية" min="1" max="999" value="<?php echo $orderitems[$it]->oiquantity; ?>" required="required" /></td><td><?php if($it != 0) { ?><i class="delete glyphicon glyphicon-remove"></i><?php } ?></td></tr>
								<?php } ?>
							</table>
							<?php } elseif(!empty($items)) { ?>
							<table id="/*datatable-buttons*/" class="mytable table table-striped table-bordered nowrap"  dir="rtl">
								<tr>
									<th width="50%" style="text-align:center;"><?php echo lang('item'); ?></th>
									<th width="25%" style="text-align:center;"><?php echo lang('price'); ?></th>
									<th width="20%" style="text-align:center;"><?php echo lang('quantity'); ?></th>
									<th width="5%" style="text-align:center;"></th>
								</tr>
								<tr><td><select name="item[]" class="form-control" required="required"><?php foreach($items as $item) { ?><option value="<?php echo $item->iid; ?>"><?php echo $item->iname; ?></option><?php } ?></select></td><td><input type="text" name="price[]" class="form-control" placeholder="00.00" maxlength="10" required="required"/></td><td><input type="number" name="quantity[]" class="form-control" placeholder="الكمية" min="1" max="999" required="required" /></td><td></td></tr>
							</table>
							<?php } else { echo lang('no_data'); } ?>
						</div>
                      </div>
					  <?php if(!empty($items)) { ?>
					  <div class="form-group">
                        <?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(' ','',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
							<i class="add btn btn-info"><?php echo lang('add_item'); ?></i>
                        </div>
                      </div>
					  <?php } ?>
					   <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-md-push-6 col-sm-3 col-sm-push-6 col-xs-12'
							);
							echo form_label(lang('notes'),'notes',$data);
						?>
                        <div class="col-md-6 col-md-pull-1 col-sm-6 col-sm-pull-2 col-xs-12">
						  <?php
							$data = array(
								'name' => 'notes',
								'id' => 'notes',
								'placeholder' => lang('notes'),
								'class' => 'form-control col-md-7 col-xs-12',
								'value' => $order->notes
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