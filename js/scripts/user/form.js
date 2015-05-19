'use strict';
(function($) {
    $(document)
        .on('click', '.remove-user-phone', function(e){
            e.preventDefault();
            var $button = $(this);
            $button.closest('.user-phone').fadeOut('fast', function(){
                $(this).remove();
            });
        });

    var $form = $('#user-form'),
        $addUserPhoneBtn = $('.add-user-phone');

    $addUserPhoneBtn.on('click', function(e){
        e.preventDefault();

        var $userPhones = $('.user-phone', $form),
            proto = $form.data('phone-prototype'),
            nextIndex = $userPhones.length,
            newItem = proto.replace(/__proto_name__/g, nextIndex);

        $userPhones.last().after(newItem);
    });

})(jQuery);