<?php

/* @var $this \yii\web\View */
/* @var $content string */

use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Hệ Thống Lưu Trữ', //龙记公司出入库管理系统
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    //    echo GhostMenu::widget([
    //        'options' => ['class' => 'navbar-nav navbar-right'],
    //        'encodeLabels'=>false,
    //        'activateParents'=>true,
    //        'items' => [
    //            [
    //                'label' => 'Backend routes',
    //                'items'=>UserManagementModule::menuItems()
    //            ],
    //            [
    //                'label' => 'Frontend routes',
    //                'items'=>[
    //                    ['label'=>'Login', 'url'=>['/user-management/auth/login']],
    //                    ['label'=>'Logout', 'url'=>['/user-management/auth/logout']],
    //                    ['label'=>'Registration', 'url'=>['/user-management/auth/registration']],
    //                    ['label'=>'Change own password', 'url'=>['/user-management/auth/change-own-password']],
    //                    ['label'=>'Password recovery', 'url'=>['/user-management/auth/password-recovery']],
    //                    ['label'=>'E-mail confirmation', 'url'=>['/user-management/auth/confirm-email']],
    //                ],
    //            ],
    //        ],]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [

            ['label' => Yii::t('app', 'Delivery'), 'url' => ['/delivery/index']],
            ['label' => Yii::t('app', 'Stockin'), 'url' => ['/stockin/index']],
            ['label' => Yii::t('app', 'Collection'), 'url' => ['/collection/index']],
            ['label' => 'Báo cáo',
                'url' => ['#'],
                'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
                'items' => [
                    ['label' => Yii::t('app', 'Số lượng'), 'url' => ['/avg/index']],
                    ['label' => Yii::t('app', 'Tiền'), 'url' => ['/avg/tien']],
                    ['label' => Yii::t('app', 'Giá trung bình'), 'url' => ['/avg/giatb']],
                    ['label' => 'Something else here', 'url' => '#'],
                ],
            ],
//        ['label' => Yii::t('app', 'Bill'), 'url' => ['/bill/index']],


            ['label' => Yii::t('app', 'Product'), 'url' => ['/product/index']],
            ['label' => Yii::t('app', 'Customer'), 'url' => ['/customer/index']],


            // =user-management%2Fuser%2Findex
            Yii::$app->user->username != "superadmin" ? "" :  ['label' => Yii::t('app', 'Unit Pro'), 'url' => ['/unitpro/index']],
            Yii::$app->user->username != "superadmin" ? "" : ['label' => Yii::t('app', 'Usermanagement'), 'url' => ['/user-management/user/index']],
            Yii::$app->user->username != "superadmin" ? "" : ['label' => Yii::t('app', 'Loai chi phi'), 'url' => ['/account/index']],


            ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']],
            Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'Login'), 'url' => ['/user-management/auth/login']] :
                ['label' => Yii::$app->user->identity->username,
                    'url' => ['#'],
                    'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
                    'items' => [

                        ['label' => Yii::t('app', 'Logout') . ' (' . Yii::$app->user->identity->username . ')', 'url' => ['/user-management/auth/logout']],
                        ['label' => 'Đổi mật khẩu', 'url' => ['/user-management/auth/change-own-password']],

                    ],
                ],


        ], 'activateParents' => true,
    ]);
    NavBar::end();
    ?>
    <br/>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company010 <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
