<script type="text/javascript">
    $(document).ready(function() {
        $('select').select2({
            templateResult: formatState,
            // placeholder: 'Select a Protocol'
        });

        // $(".protocol_config").hide();

        protocol_setting('<?php echo $protocol_option;?>');

        $("select.protocol").on('change',function(){
            console.log("here");
            var selectedProtocol = $(this).children("option:selected").val();
            
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('protocolconfig/get_protocol_detail');?>",
                data: "protocol="+selectedProtocol,
                success: function (response) {
                    protocol_setting(selectedProtocol);
                    $("."+selectedProtocol).html(response);
                },
            });
            
        });
    });


    function protocol_setting(protocol)
    {
        if (protocol === "smtp") {
            $(".smtp").show();
        } else if (protocol === "mail") {
            $(".mail").show();
        } else if (protocol === "sendmail") {
            $(".sendmail").show();
        } else {
            $(".protocol_config").hide();
            // $(".smtp").show();
        }
    }

    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 
        && (charCode < 48 || charCode > 57))
        return false;
        return true;
    }

    function formatState (state) {
        if(!state.element) return;
        var os = $(state.element).attr('onlyslave');
        console.log(state.text);
        return $('<span onlyslave="'+os+'">' + state.text + '</span>');
    }
</script>