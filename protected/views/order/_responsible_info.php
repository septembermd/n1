<?php
/** @var User $user */
?>

<div class="message-box message-box-info animated fadeIn" id="<?php echo $id; ?>">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-info"></span> <?php echo $header; ?></div>
            <div class="mb-content">
                <p><?php echo Yii::t('main', 'You can contact {username} at', ['{username}' => $user->fullname]); ?>:</p>
                <p><?php echo Yii::t('main', 'Email'); ?>: <?php echo $user->email; ?></p>
                <p><?php echo Yii::t('main', 'Phone'); ?>:
                    <ul class="list-unstyled">
                    <?php foreach($user->phone_numbers as $phone): ?>
                        <li><?php echo $phone; ?></li>
                    <?php endforeach; ?>
                    </ul>

                </p>
            </div>
            <div class="mb-footer">
                <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
            </div>
        </div>
    </div>
</div>