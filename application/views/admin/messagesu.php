        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('messages'); ?></h3>
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
                    <?php if(!empty($messages)) { ?>
					<table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th><?php echo lang('name'); ?></th>
						  <th><?php echo lang('email'); ?></th>
						  <th><?php echo lang('mobile'); ?></th>
						  <th><?php echo lang('title'); ?></th>
						  <th><?php echo lang('desc'); ?></th>
						  <th><?php echo lang('time'); ?></th>
                        </tr>
                      </thead>


                      <tbody>
					  <?php foreach($messages as $message) { ?>
                        <tr>
                          <td><?php if($message->mgeid != 0) echo $employees[$message->mgeid]['name']; else echo $message->mgname; ?></td>
						  <td><?php if($message->mgeid != 0) echo $employees[$message->mgeid]['email']; else echo $message->mgemail; ?></td>
						  <td><?php if($message->mgeid != 0) echo $employees[$message->mgeid]['phone']; else echo $message->mgmobile; ?></td>
						  <td><?php echo $message->mgtitle; ?></td>
						  <td><?php echo $message->mgbody; ?></td>
						  <td><?php if($message->mgtime != '') { echo ArabicTools::arabicDate($system->calendar.' Y-m-d', $message->mgtime).' , '.date('h:i:s', $message->mgtime); if(date('H', $message->mgtime) < 12) echo ' '.lang('am'); else echo ' '.lang('pm'); } ?></td>
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