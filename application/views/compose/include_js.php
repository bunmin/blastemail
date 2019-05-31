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
        });
    </script>