        <div class="row" dir="rtl">
			<img class="img-responsive" src="<?php if(isset($system->logo) && $system->logo != '' && file_exists($system->logo)) echo base_url().$system->logo; ?>" />
		</div>
		<div class="row" dir="rtl">
          <section class="login_content">
		  <?php
				echo '<div style="color:red; font-size:25px;">'.lang($message).'</div>';
				echo validation_errors();
				echo form_open('home/login');
			?>
              <h1><?php echo lang('login_form'); ?></h1>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <?php										
					$data = array(
						'name' => 'username',
						'id' => 'username',
						'placeholder' => lang('username'),
						'class' => 'form-control',
						'max' => 50,
						'pattern' => '[A-Za-z]{5,}',
						'title' => '5 حروف  انجليزية فاكثر',
						'required' => 'required',
						'value' => set_value('username')
					);
					echo form_input($data);
				?>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <?php																				
					$data = array(
						'name' => 'password',
						'id' => 'password',
						'placeholder' => lang('password'),
						'class' => 'form-control',
						'max' => 50,
						'required' => 'required',
						'value' => set_value('password')
					);
					echo form_password($data);
				?>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
				<!--<div class="col-md-6 col-sm-6 col-xs-6">
					<a class="reset_pass" href="#"><?php echo lang('lostpassword'); ?></a>
				</div>-->
				<div class="col-md-12 col-sm-12 col-xs-12">
                 <?php																				
					$data = array(
						'name' => 'login',
						'id' => 'login',
						'class' => 'btn btn-info',
						'value' => 'true',
						'type' => 'submit',
						'content' => lang('login')
					);
					echo form_button($data);
				?>
				</div>
              </div>
              <div class="clearfix"></div>
            <?php								
				echo form_close();
			?>
          </section>
        </div>