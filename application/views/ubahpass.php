<?php if (strlen($this->session->flashdata('failed')) > 0) {?>
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  <?php echo $this->session->flashdata('failed');
	  		$this->session->unset_userdata('failed');
	  ?>
	</div>
<?php }?>
<form action="" method="post">
	<div class="form-group">
		<label>Password Lama</label>
		<div class="input-group" id="show_hide_password">
			<input type="password" name="pass_lama" class="form-control" >
			<div class="input-group-addon">
				<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label>Password Baru</label>
		<div class="input-group" id="show_hide_password">
			<input type="password" name="pass_baru" class="form-control" >
			<div class="input-group-addon">
				<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<button class="btn btn-primary" type="submit">Ubah</button>
	</div>
</form>
