(function($, w, d){
    $.fn.ajaxForm = function() {
        $(d).on('submit', this.selector, function(event) {
            var $form = $(this);
            if ($form.valid()) {
                $.ajax({
                    url: $form.attr('action'),
                    beforeSend: function (xhr) {
                        var token = $('meta[name="csrf-token"]').attr('content');

                        if (token) {
                            return xhr.setRequestHeader('X-XSRF-TOKEN', token);
                        }
                    },
                    type: $form.attr('method'),
                    data: $form.serialize() + '&_csrf=' + $('meta[name="csrf-token"]').attr('content'),
                    dataType: 'json',

                    success: function(data) {
                        if (data.success){
                            w.yaGoal.reachGoal($form.find('[name="ya-target"]').val());
                            $form[0].reset();
                            $.magnificPopup.close();

                            console.log(data);

                            setTimeout("$('.success-block').fadeIn()", 400);
                            setTimeout(function(){
                                console.log(data);
                                $('.success-block').fadeOut(400);
                                if (typeof data.redirect != 'undefined') {
                                    var oldLoc = w.location.href.split('#');
                                    var newLoc = data.redirect.split('#');
                                    w.location.href = data.redirect;
                                    if (oldLoc[0] == newLoc[0]) {
                                        w.location.reload();
                                    }
                                }
                            }, 4000);

                        } else {
                            for (var name in data.errors) {
                                $form.find('[name="' + name + '"]').closest('.section_Input').append('<label class="error">' + data.errors[name][0] + '</label>');
                            }
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        $.magnificPopup.close();
                        setTimeout("$('.error-block').fadeIn()", 400);
                        setTimeout(function(){
                            $('.error-block').fadeOut(400);
                        },4000);
                        function remove(){
                            html.removeClass('open');
                        }
                        setTimeout(remove, 4070);
                    }
                });
            }
            event.preventDefault();
        });
    };
})(jQuery, window, document);