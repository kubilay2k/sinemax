<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Session */

$this->title = 'Seans Güncelle: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Seans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Güncelle';
?>
<div class="session-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
