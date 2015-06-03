<?php
/**
 * Created by Victor Davydov <septembermd@gmail.com>
 * Date: 6/2/15
 * Time: 5:45 PM
 */

/** @var OrderItems[] $items */

?>
<?php if (is_array($items)):?>
    <ul>
    <?php foreach($items as $item) :?>
        <?php if (is_array($item)) :?>
            <li><?php echo $item['type']; ?> - <?php echo $item['amount'];?></li>
        <?php else: ?>
            <li><?php echo $item->type; ?> - <?php echo $item->amount;?></li>
        <?php endif; ?>

    <?php endforeach; ?>
    </ul>
<?php endif; ?>