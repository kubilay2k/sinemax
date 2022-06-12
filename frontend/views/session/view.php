<?php 
/**
 * @var $model \common\models\Session
 * @var $sessions \common\models\Session
 * @var $sessionsday \common\models\Session
 */

use common\helpers\Html;

use yii\helpers\Html as HelpersHtml;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\models\Session;

$this->title = $model->movie->movie_name;

?>
<?php 
/*
foreach($sessions as $key)
  {


    printf('
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="table-active">
                <div class="table-active h6" id="contact-tab" data-toggle="tab" href="#s'.$key->id.'" role="tab" aria-controls="contact" aria-selected="false">
                '.$key->day.'
                </div>
              </li>
            </ul>
          ');
          
          $seans = Session::find()->where(['day'=>$key->day])->orderBy('time')->all();
        
          foreach($seans as $value)
          { 

              printf('<div class="tab-content" id="myTabContent">
              <div class="tab-pane active" id="s'.$value->id.'" role="tabpanel" aria-labelledby="contact-tab">            
                <a class="btn btn-secondary" href="'.Url::to(['session/seat','id'=>$model->id]).'">'.$value->time.'-'.$value->theater->name.'</a>
              </div>');     
          }
  
          echo('<br>');
  }*/
//2.tarz


    foreach ($sessions as $key) 
    {

        printf('<div class="table-active">'.Yii::$app->formatter->asDate(''.$key->fulltime.'', 'long').'</div> ');

        $day = Session::find()->where(['day'=>$key->day])->orderBy('theater_id,day')->groupBy('theater_id')->all();        
        foreach($day as $value)
        {
          printf('<div class="table-secondary">'.$value->theater->name.'</div>');
        
          $seans = Session::find()->where(['theater_id'=>$value->theater_id,'day'=>$key->day])->orderBy('theater_id,time')->all();
          foreach ($seans as $keys) 
          {
                printf('<div><a class="btn btn-success" href="'.Url::to(['session/seat','id'=>$keys->id]).'">'.$keys->time.'</a></div>');              
          }
        } 

          echo('<br>');
      }

?>