    <!-- CK Editor -->
    <script src="assets/bower_components/ckeditor/ckeditor.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script>
    $(function () {
        // Replace the <textarea id="htmleditor"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('htmleditor')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    })
    </script>

    <!-- js multple email input -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="assets/plugins/email-multiple/jquery.email.multiple.js"></script>
    <script>
        $(document).ready(function($){
            let data = [
            ]
            $("#emailmulti").email_multiple({
                data: data
                // reset: true
            });

            $(".link-remove").hide();
            var nexthtml = 1;
            var htmlnumber = 0;
            $(".add-more").click(function(){
                nexthtml = nexthtml + 1;
                htmlnumber = htmlnumber + 1;
                // var html = $(".copy").html();
                var html = '<div class="form-group control-group after-add-more'+nexthtml+'" style="margin-top:10px">' +
                    '<label for="url'+htmlnumber+'For" class="col-sm-2 control-label">Url '+htmlnumber+' </label>' +
                    '<div class="col-sm-10">' +
                        '<input type="text" name="url'+htmlnumber+'" class="form-control" id="url'+htmlnumber+'For" placeholder="parameter code : url'+htmlnumber+'">' +
                        '<?php echo form_error('url'+htmlnumber+'') ?>' +
                    '</div>'+
                '</div>';
                $(".after-add-more"+(nexthtml-1)).after(html);
                $(".link-remove").show();
                $("#url_count").val(htmlnumber);
            });

            $("body").on("click",".remove",function(){ 
                $(".after-add-more"+(nexthtml)).remove();
                nexthtml = nexthtml - 1;
                htmlnumber = htmlnumber - 1;
                $("#url_count").val(htmlnumber);
                if (htmlnumber == 0){
                    $(".link-remove").hide();
                }
            });
        });
    </script>