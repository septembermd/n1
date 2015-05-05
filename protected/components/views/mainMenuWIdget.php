<?php
$leftMenuItems = array();
$rightMenuItems = array();
if(!$currentUser->isGuest) {
    $leftMenuItems = array(
        array('label' => Yii::t('main', 'Пользователи'), 'url' => array('user/index')),
        array('label' => Yii::t('main', 'Наряды'), 'url' => array('order/index')),
    );
    $rightMenuItems[] = array(
        'label' => sprintf("%s (%s)", $currentUser->fullname, $currentUser->role),
        'url' => array('user/view', 'id'=>$currentUser->id),
    );
}
$rightMenuItems[] = array(
    'label' => Yii::t('main', $currentUser->isGuest ? 'Войти' : 'Выйти'),
    'url' => array($currentUser->isGuest ? 'site/login' : 'site/logout'),
);

$this->widget(
    'booster.widgets.TbNavbar',
    array(
        'brand' => 'Nr.1',
        'fixed' => false,
        'fluid' => true,
        'items' => array(
            array(
                'class' => 'booster.widgets.TbMenu',
                'type' => 'navbar',
                'items' => $leftMenuItems
            ),
            array(
                'class' => 'booster.widgets.TbMenu',
                'type' => 'navbar',
                'htmlOptions' => array('class'=>'pull-right'),
                'items' => $rightMenuItems
            )
        )
    )
);