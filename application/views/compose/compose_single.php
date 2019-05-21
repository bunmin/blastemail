<?php if (strlen($this->session->flashdata('message')) > 0) {?>
  <div class="alert alert-<?php echo $this->session->flashdata('flag'); ?> alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo $this->session->flashdata('message'); ?>
  </div>
<?php }?>

<div class="box box-info">
    <form class="form-horizontal" action="app/emailsinglesend" method="post">
        <div class="box-body">
            <div class="form-group">
                <label for="sender_nameFor" class="col-sm-2 control-label">Sender Name</label>
                <div class="col-sm-10">
                    <input type="text" id="sender_name" class="form-control" placeholder="Email Sender" name="sender_name">
                    <?php echo form_error('sender_name') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="sender_emailFor" class="col-sm-2 control-label">Sender Email</label>
                <div class="col-sm-10">
                    <input type="text" id="sender_email" class="form-control" placeholder="Email Sender" name="sender_email">
                    <?php echo form_error('sender_email') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="emailmulti" class="col-sm-2 control-label">Receiver</label>
                <div class="col-sm-10">
                    <input type="text" id="emailmulti" placeholder="Email" name="receiver">
                    <?php echo form_error('receiver') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="cc" class="col-sm-2 control-label">Cc</label>
                <div class="col-sm-10">
                    <input type="text" id="cc" class="form-control" placeholder="Email Cc" name="cc">
                    <?php echo form_error('cc') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="bcc" class="col-sm-2 control-label">Bcc</label>
                <div class="col-sm-10">
                    <input type="text" id="bcc" class="form-control" placeholder="Email Bcc" name="bcc">
                    <?php echo form_error('bcc') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="subjectFor" class="col-sm-2 control-label">Subject </label>
                <div class="col-sm-10">
                    <input type="text" name="subject" class="form-control" id="subjectFor" placeholder="Subject">
                    <?php echo form_error('subject') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="messageFor" class="col-sm-2 control-label">Message </label>
                <div class="box-body pad col-sm-10">
                    <?php echo form_error('htmleditor') ?>
                    <textarea id="message" name="htmleditor" rows="10" cols="80">
                        Enter Message Here, can include html format.
                    </textarea>
                    <?php echo form_error('htmleditor') ?>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Send</button>
        </div>
    </form>
</div>