<?php 
/**
 * @var $ticket \common\models\Ticket
 * @var $sessions \common\models\Ticket
 * @var $id
 * @var $keyword
 */

use common\helpers\Html;

use yii\helpers\Html as HelpersHtml;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\models\Session;
use frontend\assets\TicketAsset;

$this->title = 'Rezervasyon No: '.$model->rezno;
TicketAsset::register($this);
?>

<div class="container-fluid my-5 d-sm-flex justify-content-center">
    <div class="card px-2">
        <div class="card-header bg-white">
          <div class="row justify-content-between">
            <div class="col">
                <p class="text-muted">Rezervasyon No: <span class="font-weight-bold text-dark"><?= $model->rezno ?></span></p> 
                <p class="text-muted">Oluşturulma Tarihi: <span class="font-weight-bold text-dark"><?= date("d-m-y H:i:s", $model->created_at) ?></span> </p></div>
                <div class="flex-col my-auto">
                    <h6 class="ml-auto mr-3">
                        <a href="#">Biletlerim</a>
                    </h6>
                </div>
          </div>
        </div>
        <div class="card-body">
            <div class="media flex-column flex-sm-row">
                <div class="media-body ">
                    <h5 class="bold mr-2"><?=$model->session->movie->movie_name?></h5>
                    <p class="text-muted"> Bilet Ücreti</p>
                    <h4 class="mt-3 mb-4 bold"> <span class="mt-5">₺</span>50 <span class="small text-muted"></span></h4>
                    <p class="text-muted"> Koltuk Numarası : <?=$model->seat_no?></p>
                    <p class="text-muted">Seans Tarihi:<span class="Today"><?= $model->session->day?></span></p>
                    <p class="text-muted">Seans Saati:<span class="Today"><?= $model->session->time?></span></p>
                    <!--<button type="button" class="btn  btn-outline-primary d-flex">Reached Hub, Delhi</button>-->  
                </div><img class="align-self-center img-fluid" src="<?=$model->session->movie->getThumbnailLink()?>" width="180 " height="180">
            </div>
        </div>

        
         <div class="card-footer  bg-white px-sm-3 pt-sm-4 px-0">
            <div class="row text-center ">
                <div class="border-line"></div>
                <div class="col my-auto  border-line "><h5>Filmler</h5></div>
                <div class="col my-auto  border-line "><h5>Diğer Seanslar</h5></div>
                <div class="col my-auto  border-line "><h5>Ana Sayfa</h5></div>
            </div>
        </div>
    </div>
</div>