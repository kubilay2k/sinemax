<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Session */

$this->title = 'Seans Oluştur';
$this->params['breadcrumbs'][] = ['label' => 'Seanslar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="session-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
