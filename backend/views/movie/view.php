<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Movie */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Filmler', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="movie-view">

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
            'movie_name',
            'movie_description',
            'time',
            'director',
            'actors',
            [
                'label' => 'Category',
                'value'=> $model->category->category_name
            ],
            'created_at:datetime',
            'created_by',
            'updated_at:datetime',           
            'updated_by'
        ],
    ]) ?>

</div>
