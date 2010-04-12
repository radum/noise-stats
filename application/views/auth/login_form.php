			<div id="content-full">
				<div class="post">
					<h2 class="title"><a href="#">Bine ati venit la Noise Stats</a></h2>
					<div class="entry">
						<p>

<?php
$username = array(
	'name'	=> 'username',
	'id'	=> 'username',
	'size'	=> 30,
	'value' => set_value('username')
);

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30
);

$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember')
);

$confirmation_code = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8
);

?>

<!--<fieldset>
<legend>Login</legend>-->
<?php echo form_open($this->uri->uri_string())?>

<?php echo $this->dx_auth->get_auth_error(); ?>


<dl>	
	<dt><?php echo form_label('Username', $username['id']);?></dt>
	<dd>
		<?php echo form_input($username)?><?php echo form_error($username['name']); ?>
	</dd>

  <dt><?php echo form_label('Password', $password['id']);?></dt>
	<dd>
		<?php echo form_password($password)?>
		<?php echo form_error($password['name']); ?>
	</dd>

<?php if ($show_captcha): ?>

	<dt>Enter the code exactly as it appears.</dt>
	<dd><?php echo $this->dx_auth->get_captcha_image(); ?></dd>	

	<dt><?php echo form_label('Confirmation Code', $confirmation_code['id']);?></dt>
	<dd>
		<?php echo form_input($confirmation_code);?>
		<?php echo form_error($confirmation_code['name']); ?>
	</dd>
	
<?php endif; ?>

	<dt><?php echo form_label('Remember me', $remember['id']);?></dt>
	<dd>
		<?php echo form_checkbox($remember);?>
	</dd>
	<dd> 
		<?php echo anchor($this->dx_auth->forgot_password_uri, 'Forgot password');?>
		&Xi; 
		<?php
			if ($this->dx_auth->allow_registration) {
				echo anchor($this->dx_auth->register_uri, 'Register');
			};
		?>
	</dd>

	<dt></dt>
	<dd><?php echo form_submit('login','Login');?></dd>
</dl>

<?php echo form_close()?>
<!--</fieldset>-->
						
						</p>
					</div>
					<p class="meta"></p>
				</div>
			</div>
			<!-- end #content -->
			<div style="clear: both;">&nbsp;</div>