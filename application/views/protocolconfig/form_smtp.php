<?php
foreach ($detail_protocol as $protocols) {
    if($protocols->setting == "smtp_host"){$smtp_host = $protocols->value;};
    if($protocols->setting == "smtp_port"){$smtp_port = $protocols->value;};
    if($protocols->setting == "smtp_user"){$smtp_user = $protocols->value;};
    if($protocols->setting == "smtp_pass"){$smtp_pass = "hidden";};
    if($protocols->setting == "smtp_crypto"){$smtp_crypto = $protocols->value;};
    if($protocols->setting == "mail_type"){$mail_type = $protocols->value;};
    if($protocols->setting == "charset"){$charset = $protocols->value;};
    if($protocols->setting == "word_wrap"){$word_wrap = $protocols->value;};
    if($protocols->setting == "smtp_timeout"){$smtp_timeout = $protocols->value;};
}
?>

    <div class="box box-info">
        <div class="box-body">
            <div class="form-group">
                <label for="smtphost" class="col-sm-2 control-label">SMTP Host</label>
                <div class="col-sm-10">
                    <input type="text" id="smtphost" class="form-control" placeholder="SMTP Host" name="smtp_host" value="<?php echo $smtp_host;?>" required>
                    <?php echo form_error('smtp_host') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="smtpport" class="col-sm-2 control-label">SMTP Port</label>
                <div class="col-sm-10">
                    <input type="text" id="smtpport" class="form-control" placeholder="SMTP Port" name="smtp_port" onkeypress="return isNumberKey(event)" value="<?php echo $smtp_port;?>" required>
                    <?php echo form_error('smtp_port') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="smtpuser" class="col-sm-2 control-label">SMTP User</label>
                <div class="col-sm-10">
                    <input type="text" id="smtpuser" class="form-control" placeholder="SMTP User" name="smtp_user" value="<?php echo $smtp_user;?>" required>
                    <?php echo form_error('smtp_user') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="smtppass" class="col-sm-2 control-label">SMTP Password</label>
                <div class="col-sm-10">
                    <input type="password" id="smtppass" class="form-control" placeholder="SMTP Password" name="smtp_pass" value="<?php echo $smtp_pass;?>" required>
                    <?php echo form_error('smtp_pass') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="smtpcrypto" class="col-sm-2 control-label">SMTP Crypto</label>
                <div class="col-sm-10">
                    <input type="text" id="smtpcrypto" class="form-control" placeholder="can be '' (blank) or 'ssl' or 'tls'" name="smtp_crypto" value="<?php echo $smtp_crypto;?>">
                    <?php echo form_error('smtp_crypto') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="mailtype" class="col-sm-2 control-label">Mail Type</label>
                <div class="col-sm-10">
                    <input type="text" id="mailtype" class="form-control" placeholder="'text' or 'html'" name="mail_type" value="<?php echo $mail_type;?>" required>
                    <?php echo form_error('mail_type') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="charset" class="col-sm-2 control-label">Charset</label>
                <div class="col-sm-10">
                    <input type="text" id="charset" class="form-control" placeholder="UTF-8" name="charset" value="<?php echo $charset;?>" required>
                    <?php echo form_error('charset') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="wordwrap" class="col-sm-2 control-label">Word Wrap</label>
                <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="word_wrap" id="wordwrap" value="<?php echo $word_wrap;?>">
                        <option value="false" <?php if($word_wrap==false){echo "selected";}?>>No</option>
                        <option value="true" <?php if($word_wrap==true){echo "selected";}?>>Yes</option>
                    </select>
                    <?php echo form_error('word_wrap') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="smtptimeout" class="col-sm-2 control-label">SMTP Timeout</label>
                <div class="col-sm-10">
                    <input type="text" id="smtptimeout" class="form-control" placeholder="SMTP Timeout" name="smtp_timeout" onkeypress="return isNumberKey(event)" value="<?php echo $smtp_timeout;?>" required>
                    <?php echo form_error('smtp_timeout') ?>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Save & Actived</button>
        </div>
    </div>