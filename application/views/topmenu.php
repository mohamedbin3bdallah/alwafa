		<!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-left">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php if($this->loginuser->uimage != '' && file_exists($this->loginuser->uimage)) echo base_url().$this->loginuser->uimage; else echo base_url().'imgs/users/user.png'; ?>" alt="<?php echo $this->loginuser->username; ?>"><?php echo $this->loginuser->username; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right" style="text-align:right; float:left;">
                    <!--<li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>-->
					<!--<li><a href="<?php echo base_url(); ?>profile"><i class="fa fa-history pull-left"></i> <?php echo lang('profile'); ?></a></li>
					<li><a href="<?php echo base_url(); ?>account"><i class="fa fa-cog pull-left"></i> <?php echo lang('account'); ?></a></li>-->
                    <li><a href="<?php echo base_url(); ?>home/logout"><i class="fa fa-sign-out pull-left"></i> <?php echo lang('logout'); ?></a></li>
                  </ul>
                </li>
			
			<?php if(isset($unreadNTs) && !empty($unreadNTs)) { ?>
                <li role="presentation" class="dropdown" id="unreadNTs" title="<?php echo lang('notify'); ?>">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o" style="line-height:32px;"></i>
					<?php if($unreadNTs['count']) { ?><span class="badge bg-purple" id="unreadNTsC"><?php echo $unreadNTs['count']; ?></span><?php } unset($unreadNTs['count']); ?>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
				  <?php foreach($unreadNTs as $unreadNT) { ?>
					<?php
						$subTime = time() - $unreadNT->time;
						$y = number_format(($subTime/(60*60*24*365)),0);
						$d = number_format(($subTime/(60*60*24))%365,0);
						$h = number_format(($subTime/(60*60))%24,0);
						$m = number_format(($subTime/60)%60,0);
						$unreadNT->ntime = '';
						if($y > 0) $unreadNT->ntime .= $y.' سنة ';
						if($d > 0) $unreadNT->ntime .= $d.' يوم ';
						if($h > 0) $unreadNT->ntime .= $h.' ساعة ';
						if($m > 0) $unreadNT->ntime .= $m.' دقيقة ';
					?>
                    <li dir="rtl" style="float:right;">
                        <!--<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>-->
                        <div class="row">
							<div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right;">
								قبل <?php echo $unreadNT->ntime; ?>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3" style="text-align:right;">
								<?php echo $unreadNT->user; ?>
							</div>
                        </div>
						<div class="row">
							<div class="col-md-3 col-sm-3 col-xs-3 col-md-push-9 col-push-sm-9 col-xs-push-9">
								<img style="margin-top:-20px; width:59px; height:59px;" class="img-circle profile_img" src="<?php if($unreadNT->image != '' && file_exists($unreadNT->image)) echo base_url().$unreadNT->image; else echo base_url().'imgs/users/user.png'; ?>" alt="Profile Image" />
							</div>
							<div class="col-md-9 col-sm-9 col-xs-9 col-md-pull-3 col-sm-pull-3 col-xs-pull-3" style="text-align:right;">
								<?php echo $unreadNT->action; ?>
							</div>
						</div>
                    </li>
				  <?php } ?>
                  </ul>
                </li>
			<?php } ?>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->