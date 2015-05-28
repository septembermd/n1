<?php
/** @var User $currentUser */
/** @var AccessControlList $acl */

$leftMenuItems = [];
$rightMenuItems = [];
if(!$currentUser->isGuest) {

    $profileLabel = '<div class="profile">
                            <div class="profile-data">
                                <div class="profile-data-name">%s</div>
                                <div class="profile-data-title">%s</div>
                            </div>
                        </div>';

    $leftMenuItems = [
        [
            'label' => '',
            'itemOptions' => ['class' => 'xn-logo'],
            'linkOptions' => ['class' => 'x-navigation-control'],
        ],
        [
            'label' => sprintf($profileLabel, $currentUser->fullname, User::getRoleLabel($currentUser->role_id)),
            'url' => ['user/view', 'id'=>$currentUser->id],
        ],
        [
            'label' => sprintf('<span class="fa fa-paperclip"></span> <span class="xn-text">%s</span>', Yii::t('main', 'Orders')),
            'url' => ['order/index'],
            'visible' => $acl->canAccessOrders()
        ],
        [
            'label' => sprintf('<span class="fa fa-user"></span> <span class="xn-text">%s</span>', Yii::t('main', 'Users')),
            'url' => ['user/index'],
            'visible' => $acl->canPerformUsersAdminActions()
        ],
        [
            'label' => sprintf('<span class="fa fa-truck"></span> <span class="xn-text">%s</span>', Yii::t('main', 'Suppliers')),
            'url' => ['supplier/admin'],
            'visible' => $acl->canPerformSuppliersAdminActions()
        ],
        [
            'label' => sprintf('<span class="fa fa-envelope"></span> <span class="xn-text">%s</span>', Yii::t('main', 'Email templates')),
            'url' => ['emailTemplate/admin'],
            'visible' => $acl->canManageEmailTemplates()
        ],
    ];
}
$rightMenuItems[] = [
    'label' => Yii::t('main', $currentUser->isGuest ? 'Login' : 'Logout'),
    'url' => [$currentUser->isGuest ? 'site/login' : 'site/logout'],
    'active' => false
];
?>

<div class="page-sidebar">

    <?php $this->widget(
        'zii.widgets.CMenu',
        [
            'encodeLabel' => false,
            'htmlOptions' => [
                'class' => 'x-navigation'
            ],
            'itemCssClass' => '',
            'items' => $leftMenuItems
        ]
    );?>
</div>

