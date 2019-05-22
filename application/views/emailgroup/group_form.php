<?php if (strlen($this->session->flashdata('message')) > 0) {?>
  <div class="alert alert-<?php echo $this->session->flashdata('flag'); ?> alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo $this->session->flashdata('message');
        $this->session->unset_userdata('flag');
        $this->session->unset_userdata('message');
    ?>
  </div>
<?php }?>

<div class="box box-info">
    
    <div class="box-footer clearfix">
        <a href="<?php echo base_url("upload/template/template.csv"); ?>" class="btn btn-sm btn-success btn-flat pull-left">Download Template</a>
        <!-- <?php echo anchor(site_url('upload/template/format.csv'),'Download Template', 'class="btn btn-sm btn-info btn-flat pull-left"'); ?> -->
    </div>

    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <label for="group_name">Group Name <?php echo form_error('group_name') ?></label>
                <input type="text" class="form-control" name="group_name" id="group_name" placeholder="Group Name" value="" />
            </div>  

            <div class="form-group">
                <label for="csv">Upload CSV</label>
                <input type="file" class="form-control" name="csv" id="csv" placeholder="Upload CSV" value="" />
            </div>  
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-info"><?php echo $button ?></button>
            <a href="<?php echo site_url('emailgroup') ?>" class="btn btn-danger">Cancel</a>
        </div>
    </form>
</div>