        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('covenants'); ?></h3>
              </div>

              <div class="">
                <div class="col-md-3 col-sm-3 col-xs-5 col-md-offset-9 col-sm-offset-9 col-xs-offset-7 form-group top_search">
                  <div class="input-group">
					<!--<?php //if(strpos($this->loginuser->privileges, ',uadd,') !== false) { ?><button type="button" class="btn btn-primary" onclick="location.href = 'users/add'"><?php //echo lang('add_user'); ?></button><?php //} ?>-->
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
                    <?php if(!empty($users)) { ?>
					<table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th><?php echo lang('username'); ?></th>
						  <th><?php echo lang('name'); ?></th>
						  <th><?php echo lang('year'); ?></th>
						  <th><?php echo lang('month'); ?></th>
						  <th><?php echo lang('salary'); ?></th>
                          <th><?php echo lang('email'); ?></th>
                          <th><?php echo lang('phone'); ?></th>
						  <th><?php echo lang('usertype'); ?></th>
						  <th><?php echo lang('itemtypes'); ?></th>
						  <th><?php echo lang('branches'); ?></th>
						  <th><?php echo lang('editemployee'); ?></th>
						  <th><?php echo lang('edittime'); ?></th>
						  <th><?php echo lang('active'); ?></th>
						  <?php if(strpos($this->loginuser->privileges, ',sledit,') !== false) { ?><th><?php echo lang('edit'); ?></th><?php } ?>
                        </tr>
                      </thead>


                      <tbody>
					  <?php foreach($users as $user) { $user->branches = implode(' , ',array_intersect_key($branches, array_flip(explode(',',$user->ubcid)))); $user->stores = implode(' , ',array_intersect_key($stores, array_flip(explode(',',$user->uitid)))); ?>
                        <tr>
                          <td><?php echo $user->username; ?></td>
						  <td><?php echo $user->uname; ?></td>
						  <td><?php $slyear = 'slyear'.$system->calendar; echo $user->$slyear; ?></td>
						  <td><?php $slmonth = 'slmonth'.$system->calendar; echo lang('month'.$system->calendar.$user->$slmonth); ?></td>
						  <td><?php echo $user->slsalary.' '.$system->currency; ?></td>
						  <td><?php echo $user->uemail; ?></td>
                          <td><?php echo $user->uphone; ?></td>
						  <td><?php echo $user->utname; ?></td>
						  <td><?php echo $user->stores; ?></td>
						  <td><?php echo $user->branches; ?></td>
						  <td><?php if($user->sluid != 0) echo $employees[$user->sluid]; ?></td>
						  <td><?php if($user->sltime != '') { echo ArabicTools::arabicDate($system->calendar.' Y-m-d', $user->sltime).' , '.date('h:i:s', $user->sltime); if(date('H', $user->sltime) < 12) echo ' '.lang('am'); else echo ' '.lang('pm'); } ?></td>
						  <td><input type="checkbox" <?php if($user->active == 1) echo 'checked'; ?> disabled></td>
						  <?php if(strpos($this->loginuser->privileges, ',sledit,') !== false) { ?><td><a href="<?php echo base_url(); ?>hr/salaryshow/<?php echo $user->slid; ?>" style="color: green;"><i style="color:green;" class="glyphicon glyphicon-edit"></i></a></td><?php } ?>
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