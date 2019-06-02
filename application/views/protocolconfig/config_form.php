<?php if (strlen($this->session->flashdata('message')) > 0) {?>
  <div class="alert alert-<?php echo $this->session->flashdata('flag'); ?> alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo $this->session->flashdata('message');
        $this->session->unset_userdata('flag');
        $this->session->unset_userdata('message');
    ?>
  </div>
<?php }?>
<?php
$protocol_option = $detail_protocol[0]->protocol;
$active_text = '<div color="red>test</div>'
?>
<style>
.select2-results span[onlyslave="yes"] { 
    color: #43E2A8;
}

</style>
<form class="form-horizontal" action="protocolconfig/save_action" method="post">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Protocol</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                <div class="col-sm-12">
                    <select class="form-control select2 protocol" style="width: 100%;" name="protocol_option">
                        <option value="">== Select a Protocol ==</option>
                        <option value="mail" <?php if ($protocol_option == 'mail'){ echo 'selected onlyslave="yes"';}?>>Mail</option>
                        <option value="smtp" <?php if ($protocol_option == 'smtp'){ echo 'selected onlyslave="yes"';}?>>SMTP</option>
                        <option value="sendmail" <?php if ($protocol_option == 'sendmail'){ echo 'selected onlyslave="yes"';}?>>Sendmail</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="protocol_config smtp mail sendmail">
    <?php include 'form_smtp.php';?>
    </div>
</form>