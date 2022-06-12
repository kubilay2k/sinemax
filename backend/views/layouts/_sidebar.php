<?php

use \yii\bootstrap4\Nav;

?>

<aside class="shadow">
<?php 
echo Nav::widget([
     'options'=>[
         'class'=>'d-flex flex-column nav-pills'
     ],
     'items'=>[
     [
         'label'=>'Dashboard',
         'url'=>['/site/index']
     ],
     [
         'label'=>'Kategoriler',
         'url'=>['/category/index']
     ],
     [
        'label'=>'Sinemalar',
        'url'=>['/theater/index']
    ],
    [
        'label'=>'Filmler',
        'url'=>['/movie/index']
    ],
    [
        'label'=>'Seanslar',
        'url'=>['/session/index']
    ],
    [
        'label'=>'Biletler',
        'url'=>['/ticket/index']
    ],
     ]]);
     ?>
</aside>