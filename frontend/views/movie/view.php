<?php 
/**
 * @var $model \common\models\Video
 * @var $session \common\models\Session
 * @var $count \common\models\Session
 */

use common\helpers\Html;

use yii\helpers\Html as HelpersHtml;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\models\Session;

$this->title = $model->movie_name;

?>

<img src="<?=$model->getThumbnailLink()?>" alt="">
<h3><?= $model->movie_name ?></h3>
<p>Yaş Sınırı: <?= $model->category->min_age_limit ?></p>
<p>Yönetmen: <?= $model->director ?></p>
<p>Oyuncular: <?= $model->actors ?></p>
<hr>
<p>Süre: <?= HelpersHtml::encode($model->time) ?> Dakika </p>
<p>Tür: <?= HelpersHtml::encode($model->category->category_name) ?> </p>
<p>Özet:<?= HelpersHtml::encode($model->movie_description) ?>  </p>
<?php if(!$count==0)
{
  echo('<a class="btn btn-success " href="'.Url::to(['session/view','id'=>$model->id]).'">Seansları Görüntüle</a> ');
}else {
  echo('<p>Bu Filme Ait Seans Bulunmamaktadır.</p>');
}
?>



