<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Theater */

$this->title = 'Create Theater';
$this->params['breadcrumbs'][] = ['label' => 'Theaters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="theater-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
