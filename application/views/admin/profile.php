        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('profile'); ?></h3>
              </div>

              <div class="">
                <div class="col-md-3 col-sm-3 col-xs-5 col-md-offset-9 col-sm-offset-9 col-xs-offset-7 form-group top_search">
                  <div class="input-group">
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row" dir="rtl">
			<div class="x_panel">
			<div class="x_title">
			
			  <div class="col-md-3 col-md-push-9 col-sm-3 col-sm-push-9 col-xs-12 profile_left">
				<div class="profile_img">
					<div id="crop-avatar">
						<!-- Current avatar -->
						<img class="img-responsive" width="100%" style="max-height:555px;" src="<?php if($this->loginuser->uimage != '' && file_exists($this->loginuser->uimage)) echo base_url().$this->loginuser->uimage; else echo base_url().'imgs/users/user.png'; ?>" alt="<?php echo $this->loginuser->username; ?>" title="<?php echo $this->loginuser->username; ?>">
                    </div>
                </div>
				<h3><?php echo $this->loginuser->username; ?></h3>

                      <ul class="list-unstyled user_data">
                        <?php if($user->utname != '') { ?><li><i class="fa fa-briefcase user-profile-icon"></i> <?php echo $user->utname; ?></li><?php } ?>
                        <?php if($user->address != '') { ?><li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $user->address; ?></li><?php } ?>
						<?php if($user->email != '') { ?><li><i class="fa fa-envelope-o user-profile-icon"></i> <a class="mail" href="mailto:<?php echo $user->email; ?>"><?php echo $user->email; ?></a></li><?php } ?>
						<?php if($user->phone != '') { ?><li><i class="fa fa-mobile user-profile-icon"></i> <?php echo $user->phone; ?></li><?php } ?>
                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          <a href="<?php echo base_url(); ?>account" target="_blank"><?php echo lang('editprofile'); ?></a>
                        </li>
                      </ul>

                      <br />

                      <!-- start skills -->
                      <h4><?php echo lang('activities'); ?></h4>
					  <?php if($NTcount != '') { ?>
                      <ul class="list-unstyled user_data">
                        <li>
                          <p><?php echo lang('notify'); ?></p>
						  <div class="progress progress_sm">
                            <div class="progress-bar bg-purple" role="progressbar" data-transitiongoal="<?php echo $NTs*100/$NTcount; ?>" style="float:right;"></div>
                          </div>
                        </li>
                        <li>
                          <p><?php echo lang('orders'); ?></p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-blue" role="progressbar" data-transitiongoal="<?php echo $ORs*100/$NTcount; ?>" style="float:right;"></div>
                          </div>
                        </li>
                        <li>
                          <p><?php echo lang('joborders'); ?></p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $JOa*100/$NTcount; ?>" style="float:right;"></div>
                          </div>
                        </li>
                        <li>
                          <p><?php echo lang('paymentvouchers'); ?></p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-orange" role="progressbar" data-transitiongoal="<?php echo $PVs*100/$NTcount; ?>" style="float:right;"></div>
                          </div>
                        </li>
						<li>
                          <p><?php echo lang('bills'); ?></p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-red" role="progressbar" data-transitiongoal="<?php echo $BLs*100/$NTcount; ?>" style="float:right;"></div>
                          </div>
                        </li>
                      </ul>
					  <?php } else echo lang('no_data'); ?>
                      <!-- end of skills -->
			  </div>
			  
              <div class="col-md-9 col-md-pull-3 col-sm-9 col-sm-pull-3 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?php echo lang('historyactions'); ?></h2>
                    <ul class="nav navbar-left panel_toolbox">
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
                    <?php if(!empty($nots)) { ?>
					<table id="datatable-buttons" class="table">
                      <thead>
                        <tr>
                          <th width="99%"><?php echo lang('records'); ?></th>
						  <th width="1%" style="visibility: hidden;"><?php echo lang('records'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php foreach($nots as $not)	{ ?>
                        <tr>
						  <td width="99%">
							<li style="list-style-type:none;">
                                <img src="<?php if($this->loginuser->uimage != '' && file_exists($this->loginuser->uimage)) echo base_url().$this->loginuser->uimage; else echo base_url().'imgs/users/user.png'; ?>" class="avatar" alt="<?php echo $this->loginuser->username; ?>">
                                <div class="message_date" style="padding-right:90%;">
                                  <h3 class="date text-info"><?php echo ArabicTools::arabicDate($system->calendar.' d', $not->time); ?></h3>
                                  <p class="month"><?php echo ArabicTools::arabicDate($system->calendar.' F', $not->time); ?></p>
                                </div>
                                <div class="message_wrapper">
                                  <!--<h4 class="heading"><?php //echo $this->loginuser->username; ?></h4>-->
                                  <blockquote class="message" style="border-right:5px solid #eee;"><?php echo $not->action; ?>.</blockquote>
                                  <br />
                                  <!--<p class="url">
                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                    <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                  </p>-->
                                </div>
                              </li>
						  </td>
						  <td width="1%"><?php //echo $not->time; ?></td>
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
          </div>
        </div>
        <!-- /page content -->