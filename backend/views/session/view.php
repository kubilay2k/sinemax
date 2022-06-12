<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Session */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="session-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Güncelle', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Sil', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Movie Name',
                'value'=>$model->movie->movie_name,
   
            ],
            [
                'label' => 'Saloon Name',
                'value'=>$model->theater->name,
   
            ],
            [
                'label'=>'Gün',
                'value'=>$model->day  
            ],
            [
                'label'=>'Saat',
                'value'=>$model->time        
            ],
            [
                'label'=>'Bilet Ücreti',
                'value'=>$model->cost        
            ],

        ],
    ]) ?>

</div>
