        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('doctors'); ?></h3>
              </div>

              <div class="">
                <div class="col-md-3 col-sm-3 col-xs-5 col-md-offset-9 col-sm-offset-9 col-xs-offset-7 form-group top_search">
                  <div class="input-group">
					<?php if(strpos($this->loginuser->privileges, ',dradd,') !== false) { ?><button type="button" class="btn btn-primary" onclick="location.href = '../../doctors/add/<?php echo $id; ?>'"><?php echo lang('add_doctor'); ?></button><?php } ?>
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
                    <?php if(!empty($doctors)) { ?>
					<table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th><?php echo lang('title'); ?></th>
						  <th><?php echo lang('desc'); ?></th>
						  <th><?php echo lang('mobile'); ?></th>
						  <th><?php echo lang('appointments'); ?></th>
						  <th><?php echo lang('editemployee'); ?></th>
						  <th><?php echo lang('edittime'); ?></th>
						  <th><?php echo lang('active'); ?></th>
						  <?php if(strpos($this->loginuser->privileges, ',dredit,') !== false) { ?><th><?php echo lang('edit'); ?></th><?php } ?>
						  <?php if(strpos($this->loginuser->privileges, ',drdelete,') !== false) { ?><th><?php echo lang('delete'); ?></th><?php } ?>
                        </tr>
                      </thead>


                      <tbody>
					  <?php foreach($doctors as $doctor) { ?>
                        <tr>
                          <td><?php echo $doctor['title']; ?></td>
						  <td><?php echo $doctor['desc']; ?></td>
						  <td><?php echo $doctor['phone']; ?></td>
						  <td>
						   <a class="" href="#" data-toggle="modal" data-target="#det-<?php echo $doctor['id']; ?>"><?php echo lang('details'); ?></a>
						   <div id="det-<?php echo $doctor['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<br>
											<h3 style="text-align:center;"><?php echo $doctor['title']; ?></h3>
        								</div>
										<div class="modal-body">
											<table id="datatable-buttons" class="table table-striped table-bordered"  dir="rtl">
												<thead>
													<tr>
														<td><?php echo lang('day'); ?></td>
														<td><?php echo lang('from'); ?></td>
														<td><?php echo lang('to'); ?></td>
													</tr>
												</thead>
												<tbody>
												<?php foreach($doctor['appoints'] as $appoint) { ?>
													<tr>
														<td><?php echo lang($appoint['day']); ?></td>
														<td><?php echo $appoint['from']; ?></td>
														<td><?php echo $appoint['to']; ?></td>
													</tr>
												<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						  </td>
						  <td><?php echo $employees[$doctor['uid']]; ?></td>
						  <td><?php if($doctor['time'] != '') { echo ArabicTools::arabicDate($system->calendar.' Y-m-d', $doctor['time']).' , '.date('h:i:s', $doctor['time']); if(date('H', $doctor['time']) < 12) echo ' '.lang('am'); else echo ' '.lang('pm'); } ?></td>
						  <td><input type="checkbox" <?php if($doctor['active'] == 1) echo 'checked'; ?> disabled></td>
						  <?php if(strpos($this->loginuser->privileges, ',dredit,') !== false) { ?><td><a href="<?php echo base_url(); ?>doctors/edit/<?php echo $doctor['id']; ?>" style="color: green;"><i style="color:green;" class="glyphicon glyphicon-edit"></i></a></td><?php } ?>
						  <?php if(strpos($this->loginuser->privileges, ',drdelete,') !== false) { ?><td>
							<i id="<?php echo $doctor['id']; ?>" style="color:red;" class="del glyphicon glyphicon-remove-circle"></i>
							<div id="del-<?php echo $doctor['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-sm">
									<div class="modal-content">
										<div class="modal-header">
											<?php echo lang('deletemodal'); ?>
											<br>
        								</div>
										<div class="modal-body">
										<center>
											<button class="btn btn-danger" id="action_buttom" onclick="location.href = '../../doctors/del/<?php echo $doctor['id']; ?>'" data-dismiss="modal"><?php echo lang('yes'); ?></button>
											<button class="btn btn-success" data-dismiss="modal" aria-hidden="true"><?php echo lang('no'); ?></button>
										</center>
										</div>
									</div>
								</div>
							</div>
						</td><?php } ?>
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