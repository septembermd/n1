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
        $saveAsDraftButton = $('.save-order-as-draft'),
        $submitButton = $('[type=submit]', $form),
        $statusInput = $('#Order_status_id', $form),
        $addOrderItemBtn = $('.add-order-item'),
        $supplierInput = $('#Order_supplier_id', $form);

    // Trigger populating of dependent dropdowns
    $(window).load(function(){
        $supplierInput.trigger('change');
    });

    $addOrderItemBtn.on('click', function(e){
        e.preventDefault();

        var $orderItems = $('.orderItem', $form),
            proto = $form.data('orderitem-prototype'),
            nextIndex = $orderItems.length,
            newItem = proto.replace(/__proto_name__/g, nextIndex);

        $orderItems.last().after(newItem);
    });

    $saveAsDraftButton.on('click', function(e) {
        e.preventDefault();

        $statusInput.val(ORDER_STATUS.DRAFT);
        $form.trigger('submit');
    });

    $submitButton.on('click', function(e) {
        $statusInput.val(ORDER_STATUS.HAULER_NEDDED);
        $form.trigger('submit');
    });

})(jQuery);