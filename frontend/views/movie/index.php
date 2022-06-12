<?php 

/**
 * @var $dataProvider \yii\data\AvtiveDataProvider
 */

use yii\bootstrap4\LinkPager;
use yii\widgets\ListView;

$this->title = 'Ana Sayfa - Sinemax';

?>
<h3>Son Çıkanlar</h3>
<?php 
echo ListView::widget([
    'dataProvider'=>$dataProvider,
    'pager'=>[
        'class'=>LinkPager::class,
    ],
    'itemView'=>'_movie_item',
    'layout'=> '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions'=> [
        'tag'=>false
    ]
])
?>