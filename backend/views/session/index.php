<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\Session;
use common\models\Movie;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sessions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="session-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Seans oluştur', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label'=>'Film Adı',
                'value'=>'movie.movie_name'        
            ],
            [
                'label'=>'Sinema Adı',
                'value'=>'theater.name'        
            ],
            [
                'label'=>'Sinema Adı',
                'value'=>'theater.name'        
            ],
            [
                'label'=>'Gün',
                'value'=>'day'        
            ],
            [
                'label'=>'Saat',
                'value'=>'time'        
            ],
            [
                'label'=>'Bilet Ücreti',
                'value'=>'cost'        
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Session $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
