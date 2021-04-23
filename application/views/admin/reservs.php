        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('reservs'); ?></h3>
              </div>

              <div class="">
                <div class="col-md-3 col-sm-3 col-xs-5 col-md-offset-9 col-sm-offset-9 col-xs-offset-7 form-group top_search">
                  <div class="input-group">
					<!--<?php //if(strpos($this->loginuser->privileges, ',abadd,') !== false) { ?><button type="button" class="btn btn-primary" onclick="location.href = 'about/add'"><?php //echo lang('add_about'); ?></button><?php //} ?>-->
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
                    <?php if(!empty($reservs)) { ?>
					<table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th><?php echo lang('name'); ?></th>
						  <th><?php echo lang('email'); ?></th>
						  <th><?php echo lang('mobile'); ?></th>
						  <th><?php echo lang('type'); ?></th>
						  <?php if(in_array('DP',$this->sections)) { ?><th><?php echo lang('depart'); ?></th><?php if(in_array('DR',$this->sections)) { ?><th><?php echo lang('doctor'); ?></th><?php } } ?>
						  <th><?php echo lang('reservtime'); ?></th>
						  <th><?php echo lang('notes'); ?></th>
						  <th><?php echo lang('time'); ?></th>
						  <?php if(strpos($this->loginuser->privileges, ',rsedit,') !== false) { ?><th><?php echo lang('edit'); ?></th><?php } ?>
						  <?php if(strpos($this->loginuser->privileges, ',rsdelete,') !== false) { ?><th><?php echo lang('delete'); ?></th><?php } ?>
                        </tr>
                      </thead>


                      <tbody>
					  <?php foreach($reservs as $reserv) { ?>
                        <tr>
                          <td><?php if($reserv->rseid != 0) echo $employees[$reserv->rseid]['name']; else echo $reserv->rsname; ?></td>
						  <td><?php if($reserv->rseid != 0) echo $employees[$reserv->rseid]['email']; else echo $reserv->rsemail; ?></td>
						  <td><?php if($reserv->rseid != 0) echo $employees[$reserv->rseid]['phone']; else echo $reserv->rsmobile; ?></td>
						  <td><?php if($reserv->rseid != 0) echo $employees[$reserv->rseid]['type']; else echo $reserv->rstype; ?></td>
						  <?php if(in_array('DP',$this->sections)) { ?><td><?php echo $reserv->dptitle; ?></td><?php if(in_array('DR',$this->sections)) { ?><td><?php echo $reserv->drtitle; ?></td><?php } } ?>
						  <td><?php if($reserv->rsdate != '') { echo ArabicTools::arabicDate($system->calendar.' Y-m-d', $reserv->rsdate).' , '.date('h:i:s', $reserv->rsdate); if(date('H', $reserv->rsdate) < 12) echo ' '.lang('am'); else echo ' '.lang('pm'); } ?></td>
						  <td><?php echo $reserv->rsnotes; ?></td>
						  <td><?php if($reserv->rstime != '') { echo ArabicTools::arabicDate($system->calendar.' Y-m-d', $reserv->rstime).' , '.date('h:i:s', $reserv->rstime); if(date('H', $reserv->rstime) < 12) echo ' '.lang('am'); else echo ' '.lang('pm'); } ?></td>
						  <?php if(strpos($this->loginuser->privileges, ',rsedit,') !== false) { ?><td><a href="<?php echo base_url(); ?>reservs/edit/<?php echo $reserv->rsid; ?>" style="color: green;"><i style="color:green;" class="glyphicon glyphicon-edit"></i></a></td><?php } ?>
						  <?php if(strpos($this->loginuser->privileges, ',rsdelete,') !== false) { ?><td>
							<i id="<?php echo $reserv->rsid; ?>" style="color:red;" class="del glyphicon glyphicon-remove-circle"></i>
							<div id="del-<?php echo $reserv->rsid; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-sm">
									<div class="modal-content">
										<div class="modal-header">
											<?php echo lang('deletemodal'); ?>
											<br>
        								</div>
										<div class="modal-body">
										<center>
											<button class="btn btn-danger" id="action_buttom" onclick="location.href = 'reservs/del/<?php echo $reserv->rsid; ?>'" data-dismiss="modal"><?php echo lang('yes'); ?></button>
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