<?php if (strlen($this->session->flashdata('failed')) > 0) {?>
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  <?php echo $this->session->flashdata('failed'); ?>
	</div>
<?php }?>
<form action="<?php echo $action; ?>" method="post">
	<div class="form-group">
		<label>Password Baru <?php echo form_error('pass_baru') ?></label>
		<div class="input-group" id="show_hide_password">
			<input type="password" name="pass_baru" class="form-control" >
			<div class="input-group-addon">
				<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label>Password Admin <?php echo form_error('pass_admin') ?></label>
		<div class="input-group" id="show_hide_password">
			<input type="password" name="pass_admin" class="form-control" >
			<div class="input-group-addon">
				<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<input type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
		<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	</div>
</form>
