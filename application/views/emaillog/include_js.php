        <script type="text/javascript">
            // $(document).ready(function() {
            //     $('#tableinmodal').DataTable();
            // });

            function load_detail(uuid,subject)
            {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('emaillog/get_email_log_detail');?>",
                    data: "uuid="+uuid,
                    success: function (response) {
                        $(".modal_show").html(response);
                        $(".modal-title").html('<b>'+subject+'</b>');
                        $('#tableinmodal').DataTable();
                    },
                });
            }
        </script>