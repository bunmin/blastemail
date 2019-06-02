/**
 * Created by Malal91 and Haziel
 * Select multiple email by jquery.email_multiple
 * **/

(function($){

    $.fn.email_multiple = function(options) {

        let defaults = {
            reset: false,
            fill: false,
            data: null
        };

        let settings = $.extend(defaults, options);
        let email = "";

        return this.each(function()
        {
            $(this).after("" +
                "<div class=\"all-mail\"></div>\n" +
                "<input type=\"text\" name=\"email\" class=\"enter-mail-id form-control\" placeholder=\"Enter Email ...\" />");
            let $orig = $(this);
            let $element = $('.enter-mail-id');
            $element.keydown(function (e) {
                $element.css('border', '');
                if (e.keyCode === 13 || e.keyCode === 32 || e.keyCode === 188 || e.keyCode === 186 || e.keyCode === 9) {
                    
                    let getValue = $.trim($element.val());
                    if (/^[a-z+0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(getValue)){
                        $('.all-mail').append('<span class="email-ids">' + getValue + '<span class="cancel-email">x</span></span>');
                        $element.val('');

                        email += getValue + ';'
                    } else {
                        $element.css('border', '1px solid red')
                    }
                }

                $orig.val(email.slice(0, -1))
            });

            $element.focusout(function (e) {
                $element.css('border', '');

                let getValue = $.trim($element.val());
                if (/^[a-z+0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(getValue)){
                    $('.all-mail').append('<span class="email-ids">' + getValue + '<span class="cancel-email">x</span></span>');
                    $element.val('');

                    email += getValue + ';'
                } else {
                    $element.css('border', '1px solid red')
                }

                $orig.val(email.slice(0, -1))
                // console.log("email val:"+email);
            });

            $(document).on('click','.cancel-email',function(){
                $(this).parent().remove();
                var a = $(this).parent();
                var aa = $(a[0].firstChild);

                email = email.replace($(aa[0]).text()+";","");
                $orig.val(email.slice(0, -1))
                
            });

            if(settings.data){
                $.each(settings.data, function (x, y) {
                    if (/^[a-z+0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(y)){
                        $('.all-mail').append('<span class="email-ids">' + y + '<span class="cancel-email">x</span></span>');
                        $element.val('');

                        email += y + ';'
                    } else {
                        $element.css('border', '1px solid red')
                    }
                })

                $orig.val(email.slice(0, -1))
            }

            if(settings.reset){
                $('.email-ids').remove()
            }

            return $orig.hide()
        });
    };

})(jQuery);
