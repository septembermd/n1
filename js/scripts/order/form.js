'use strict';
(function($) {

    var $form = $('#order-form'),
        $saveAsDraftButton = $('.save-order-as-draft'),
        $submitButton = $('[type=submit]', $form),
        $statusInput = $('#Order_status_id', $form),
        $validUntilInput = $('#Order_valid_date', $form),
        $loadUntilInput = $('#Order_load_date', $form),
        $deliverDueInput = $('#Order_deliver_date', $form),
        $addOrderItemBtn = $('.add-order-item'),
        $supplierInput = $('#Order_supplier_id', $form);

    $(document)
        .on('click', '.remove-order-item', function(e){
            e.preventDefault();
            var $button = $(this);
            $button.closest('.orderItem').fadeOut('fast', function(){
                $(this).remove();
            });
        });

    $(window).load(function(){
        // Trigger populating of dependent dropdowns
        $supplierInput.trigger('change');
        setTimeout(function(){
            $validUntilInput.trigger('change');
        }, 300);
    });

    function validateDateCollisions() {
        var validUntilDate = $validUntilInput.data('datepicker').date,
            loadUntilDate = $loadUntilInput.data('datepicker').date,
            deliverDueDate = $deliverDueInput.data('datepicker').date;

        if (loadUntilDate > validUntilDate) {
            $loadUntilInput.val('');
        }
        if (deliverDueDate < loadUntilDate || deliverDueDate > validUntilDate) {
            $deliverDueInput.val('');
        }
    }

    function setLoadUntilLimit() {
        var dateEnd = $validUntilInput.val();
        if (dateEnd) {
            $loadUntilInput.datepicker('setEndDate', new Date(dateEnd));
        }
    }

    function setDeliverDueLimit() {
        var dateStart = $loadUntilInput.val();
        var dateEnd = $validUntilInput.val();
        if (dateStart && dateEnd) {
            $deliverDueInput.datepicker('setStartDate', new Date(dateStart));
            $deliverDueInput.datepicker('setEndDate', new Date(dateEnd));
        }
    }


    // Validate dates
    $validUntilInput.on('change', function() {
        validateDateCollisions();
        setLoadUntilLimit();
        setDeliverDueLimit();
    });
    $loadUntilInput.on('focus', function() {
        //$validUntilInput.trigger('change');
    }).on('change', function(){
        validateDateCollisions();
        setDeliverDueLimit();
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