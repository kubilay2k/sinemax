<?php 


use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

?>
<header>
    <?php
    NavBar::begin([
        'brandLabel' =>'Sinemax Admin Paneli',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-light bg-light static shadow-sm',
        ],
    ]);
    $menuItems = [
        //['label' => 'Uygulamaya Git', 'url' => ''],
        
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline text-danger'])
            . Html::submitButton(
                'Çıkış Yap (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-danger']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</header>