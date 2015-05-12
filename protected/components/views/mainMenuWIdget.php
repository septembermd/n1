<?php
/** @var User $currentUser */
/** @var AccessControlList $acl */

$leftMenuItems = [];
$rightMenuItems = [];
if(!$currentUser->isGuest) {
    $leftMenuItems = [
        ['label' => Yii::t('main', 'Users'), 'url' => ['user/index'], 'visible' => $acl->canAccessUsers()],
        ['label' => Yii::t('main', 'Orders'), 'url' => ['order/index'], 'visible' => $acl->canAccessOrders()],
    ];
    $rightMenuItems[] = [
        'label' => sprintf("%s (%s)", $currentUser->fullname, User::getRoleLabel($currentUser->role_id)),
        'url' => ['user/view', 'id'=>$currentUser->id],
    ];
}
$rightMenuItems[] = [
    'label' => Yii::t('main', $currentUser->isGuest ? 'Войти' : 'Выйти'),
    'url' => [$currentUser->isGuest ? 'site/login' : 'site/logout'],
];

$this->widget(
    'booster.widgets.TbNavbar',
    [
        'brand' => 'Nr.1',
        'fixed' => false,
        'fluid' => true,
        'items' => [
            [
                'class' => 'booster.widgets.TbMenu',
                'type' => 'navbar',
                'items' => $leftMenuItems
            ],
            [
                'class' => 'booster.widgets.TbMenu',
                'type' => 'navbar',
                'htmlOptions' => ['class'=>'pull-right'],
                'items' => $rightMenuItems
            ]
        ]
    ]
);