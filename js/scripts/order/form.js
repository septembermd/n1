'use strict';
(function($) {
    $(document)
        .on('click', '.remove-order-item', function(e){
            e.preventDefault();
            var $button = $(this);
            $button.closest('.orderItem').fadeOut('fast', function(){
                $(this).remove();
            });
        });

    var $form = $('#order-form'),
        $addOrderItemBtn = $('.add-order-item');

    $addOrderItemBtn.on('click', function(e){
        e.preventDefault();

        var $orderItems = $('.orderItem', $form),
            proto = $form.data('orderitem-prototype'),
            nextIndex = $orderItems.length,
            newItem = proto.replace(/__proto_name__/g, nextIndex);

        $orderItems.last().after(newItem);
    });

})(jQuery);