<?php 
/**
 * @var $model \common\models\Movie
 */
use yii\web\View;
use yii\helpers\Url;
use common\helpers\Html;

?>
<?php 

?>
<!-- 286x180-->
<div class="card m-1" style="width: 16rem;">    
<a href="<?= Url::to(['/movie/view','id'=>$model->id])?>">
    <div class="embed-responsive-16by9">
    <img src="<?= $model->getThumbnailLink()?>" alt="<?= $model->movie_name ?>" class="img-thumbnail width: 250px; height: 350px;">

    </div>
</a>    
  <div class="card-body mx-auto">
    <h5 class="card-title m-2"><?= $model->movie_name?></h5>
  </div>
</div>