<?php
/**
 * @var $order Order
 */
?>
<div class="sidebar_info">
    <ul class="unstyled">
        <li>
            <span class="act act-success"><?php echo $order->todayOrders; ?></span>
            <strong>Today total orders:</strong>
        </li>
        <li>
            <span class="act act-danger"><?php echo $order->unpaidOrders; ?></span>
            <strong>Orders unpaid:</strong>
        </li>
    </ul>
</div>
