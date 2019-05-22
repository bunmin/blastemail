        <script type="text/javascript">
            $(document).ready(function() {
                $('#tableinmodal').DataTable();
            });

            function load_detail(uuid,title)
            {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('emailgroup/get_group_detail');?>",
                    data: "uuid="+uuid,
                    success: function (response) {
                        $(".modal_show").html(response);
                        $(".modal-title").html('<b>'+title+'</b>');
                    },
                });
            }
        </script>