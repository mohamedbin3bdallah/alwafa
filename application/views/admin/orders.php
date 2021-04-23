        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('orders'); ?></h3>
              </div>

              <div class="">
                <div class="col-md-3 col-sm-3 col-xs-5 col-md-offset-9 col-sm-offset-9 col-xs-offset-7 form-group top_search">
                  <div class="input-group">
					<?php if(strpos($this->loginuser->privileges, ',oadd,') !== false) { ?><button type="button" class="btn btn-primary" onclick="location.href = 'orders/add'"><?php echo lang('add_order'); ?></button><?php } ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row"  dir="rtl">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <!--<h2>Button Example <small>Users</small></h2>-->
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
                    <!--<p class="text-muted font-13 m-b-30">
                      The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                    </p>-->
                    <?php if(!empty($orders)) { $staarr = array(array('class'=>'danger','output'=>lang('reject')),array('class'=>'success','output'=>lang('done')),array('class'=>'warning','output'=>lang('warning')),array('class'=>'info','output'=>lang('new')),array('class'=>'danger','output'=>lang('waiting')),array('class'=>'danger','output'=>lang('finishtime'))); ?>
					<table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th><?php echo lang('ordernumber'); ?></th>
						  <th><?php echo lang('code'); ?></th>
						  <th width="10%"><?php echo lang('edittime'); ?></th>
						  <th width="10%"><?php echo lang('editemployee'); ?></th>
						  <th width="10%"><?php echo lang('endtime'); ?></th>
						  <th><?php echo lang('branch'); ?></th>
						  <th><?php echo lang('customer'); ?></th>
						  <th></th>
						  <th></th>
						  <th></th>
						  <th><?php echo lang('status'); ?></th>
						  <!--<th><?php //echo lang('edit'); ?></th>-->
						  <!--<th><?php //echo lang('delete'); ?></th>-->
                        </tr>
                      </thead>


                      <tbody>
					  <?php foreach($orders as $order) { ?>
                        <tr class="<?php if($order['endtime'] < time() && $order['accept'] != '1') echo 'danger'; ?>">
                          <td><?php echo $order['oid']; ?></td>
						  <td><?php echo $order['ocode']; ?></td>
						  <td width="10%"><?php echo ArabicTools::arabicDate($system->calendar.' Y-m-d', $order['otime']).' , '.date('h:i:s', $order['otime']); if(date('H', $order['otime']) < 12) echo ' '.lang('am'); else echo ' '.lang('pm'); ?></td>
						  <td><?php echo $employees[$order['ouid']]; ?></td>
						  <td width="10%"><?php echo ArabicTools::arabicDate($system->calendar.' Y-m-d', $order['endtime']).' , '.date('h:i:s', $order['endtime']); if(date('H', $order['endtime']) < 12) echo ' '.lang('am'); else echo ' '.lang('pm'); ?></td>
						  <td><?php echo $order['branch']; ?></td>
						  <td><?php echo $order['customer']; ?></td>
						  <td>
						   <a class="" href="#" data-toggle="modal" data-target="#det-<?php echo $order['oid']; ?>"><?php echo lang('details'); ?></a>
						   <div id="det-<?php echo $order['oid']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<br>
        								</div>
										<div class="modal-body">
											<table id="datatable-buttons" class="table table-striped table-bordered"  dir="rtl">
												<thead>
													<tr>
														<td><?php echo lang('info'); ?></td>
														<td><?php echo lang('quantity'); ?></td>
														<td><?php echo lang('price'); ?></td>
														<td><?php echo lang('status'); ?></td>
													</tr>
												</thead>
												<tbody>
												<?php foreach($order['items'] as $item) { ?>
													<tr>
														<td><?php if($item['item'] != '') echo $item['item']; else echo $item['joitem'] ?></td>
														<td><?php echo $item['quantity']; ?></td>
														<td><?php echo $item['price'].' '.$system->currency; ?></td>
														<td>
															<div class="alert-<?php echo $staarr[$item['joaccept']]['class']; ?> fade in" role="alert" style="text-align:center;">
																<strong><?php echo $staarr[$item['joaccept']]['output']; ?></strong>
															</div>
														</td>
													</tr>
												<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						  </td>
						  <td>
						  <?php if($order['billdone'] == '1') { ?>
						   <a class="bills" oid="<?php echo $order['oid']; ?>" href="#"><?php echo lang('bill'); ?></a>
						   <div id="bill-<?php echo $order['oid']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<br>
											<h3 style="text-align:center;"><?php echo lang('bill'); ?></h3>
        								</div>
										<div class="modal-body" style="text-align:center;" id="mybill-<?php echo $order['oid']; ?>">
										</div>
									</div>
								</div>
							</div>
						  <?php } ?>
						  </td>
						  <td>
						  <?php if($order['wvdone'] == '1') { ?>
						   <a class="wvs" oid="<?php echo $order['oid']; ?>" href="#"><?php echo lang('withdrowvouchers'); ?></a>
						   <div id="wv-<?php echo $order['oid']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<br>
											<h3 style="text-align:center;"><?php echo lang('withdrowvouchers'); ?></h3>
        								</div>
										<div class="modal-body" style="text-align:center;" id="mywv-<?php echo $order['oid']; ?>">
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						  </td>
						  <td>
							<div class="alert-<?php echo $staarr[$order['accept']]['class']; ?> fade in" role="alert" style="text-align:center;">
								<strong><?php echo $staarr[$order['accept']]['output']; ?></strong>
							</div>
						  </td>
						  <!--<td><?php if($order['accept'] == '3') { ?><a href="<?php echo base_url(); ?>orders/edit/<?php echo $order['oid']; ?>" style="color: green;"><i style="color:green;" class="glyphicon glyphicon-edit"></i></a><?php } ?></td>
						  <td>
						    <?php if($order['accept'] == '3') { ?>
							<i id="<?php echo $order['oid']; ?>" style="color:red;" class="del glyphicon glyphicon-remove-circle"></i>
							<div id="del-<?php echo $order['oid']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-sm">
									<div class="modal-content">
										<div class="modal-header">
											<?php echo lang('deletemodal'); ?>
											<br>
        								</div>
										<div class="modal-body">
										<center>
											<button class="btn btn-danger" onclick="location.href = 'orders/del/<?php echo $order['oid']; ?>'" data-dismiss="modal"><?php echo lang('yes'); ?></button>
											<button class="btn btn-success" data-dismiss="modal" aria-hidden="true"><?php echo lang('no'); ?></button>
										</center>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</td>-->
                        </tr>
					  <?php } ?>
                      </tbody>
                    </table>
					<?php } else echo lang('no_data');?>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- /page content -->