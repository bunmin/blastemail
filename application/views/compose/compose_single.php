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
            <div class="form-group after-add-more1">
                <label for="url1For" class="col-sm-2 control-label">Insert Link</label>
                <div class="col-sm-9">
                        <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                        <button class="btn btn-danger remove link-remove" type="button" style="margin-left:10px"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                        <input type="hidden" name="url_count" id="url_count">   
                </div>
            </div>
            <div class="form-group">
                <label for="messageFor" class="col-sm-2 control-label">Message </label>
                <div class="box-body pad col-sm-10">
                    <?php echo form_error('htmleditor') ?>
                    <textarea id="message" name="htmleditor" rows="10" cols="80">
                        Enter Message Here, can include html format.
                        <br><br>
                        Include log for link or button click, how to use:<br>
                        1. click Add button on Insert Link in above.<br>
                        2. insert your link that you want record, example : https://blastemail.com.<br>
                        3. on the Message, insert link with the code written on the Insert Link placeholder, inside "href" element, example : <a href="url1">url1</a>. (click Source button for detail)<br>
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