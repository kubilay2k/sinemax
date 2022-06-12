<?php 
/**
 * @var $model \common\models\Session
 * @var $sessions \common\models\Session
 */

use app\assets\SweetAlertAsset;
use common\helpers\Html;

use yii\helpers\Html as HelpersHtml;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\models\Session;
use aryelds\sweetalert\SweetAlert;
use kartik\grid\ActionColumn;

$this->title = $model->movie->movie_name;
SweetAlertAsset::register($this);
?>
<h5>Film Adı:</h5><?= $model->movie->movie_name?>
<h5>Sinema Salonu:</h5><?= $model->theater->name?>
<h5>Seans Saati:</h5><?= $model->time?>
<h5>Bilet Ücreti:</h5><?= $model->cost?> ₺
<hr>
<h4>Koltuk Seçiniz:</h4>


<?php
/*
SweetAlert::widget([
    'options' => [
        'title' => "Emin Misiniz?",
        'text' => "You will not be able to recover this imaginary file!",
        'type' => SweetAlert::TYPE_WARNING,
        'showCancelButton' => true,
        'confirmButtonColor' => "#DD6B55",
        'confirmButtonText' => "Evet!",
        'cancelButtonText' => "Hayır",
        'closeOnConfirm' => false,
        'closeOnCancel' => false
    ],
    'callbackJs' => new \yii\web\JsExpression(' function(isConfirm) {
        if (isConfirm) { 
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        } else { 
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    }')
]);*/

//'.$i.'Numaralı Koltuğa Biletinizi Almak İstediğinize Emin Misiniz''
for ($i=1; $i < 30; $i++)
{ if ($i%10 == 0) {
    echo '<br>';
}
    if (!$model->purcashed($model->id,$i))
    {
        echo HelpersHtml::a($i, ['ticket/create','id'=>$model->id,'seat'=>$i ], 
        [
            'class' => 'btn btn-success',
            'data' =>[
                'confirm'=>''.$i.' Numaralı koltuğa biletinizi almak istediğinize emin misiniz?',
                'cancelButtonText'=>'deneme',
                'method' => 'post',
                    ],
        ]);
    } 
    else {
        echo '<button type="button" class="btn btn-secondary" disabled>'.$i.'</button>';
    }  
}


        ?>





      