<?php
/** @var User $currentUser */
/** @var AccessControlList $acl */

$leftMenuItems = [];
$rightMenuItems = [];
if(!$currentUser->isGuest) {
    $leftMenuItems = [
        ['label' => Yii::t('main', 'Orders'), 'url' => ['order/index'], 'visible' => $acl->canAccessOrders()],
        ['label' => Yii::t('main', 'Users'), 'url' => ['user/index'], 'visible' => $acl->canPerformUsersAdminActions()],
        ['label' => Yii::t('main', 'Suppliers'), 'url' => ['supplier/admin'], 'visible' => $acl->canPerformUsersAdminActions()],
    ];
    $rightMenuItems[] = [
        'label' => sprintf("%s (%s)", $currentUser->fullname, User::getRoleLabel($currentUser->role_id)),
        'url' => ['user/view', 'id'=>$currentUser->id],
    ];
}
$rightMenuItems[] = [
    'label' => Yii::t('main', $currentUser->isGuest ? 'Login' : 'Logout'),
    'url' => [$currentUser->isGuest ? 'site/login' : 'site/logout'],
    'active' => false
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