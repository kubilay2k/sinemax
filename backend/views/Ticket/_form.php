<?php

use common\models\Session;
use common\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'session_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Session::find()->all(),'id','id'),
        'language' => 'tr',
        'options' => [
            'multiple'=>false,
            'placeholder' => 'Seans Seçiniz'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(User::find()->all(),'id','username'),
        'language' => 'tr',
        'options' => [
            'multiple'=>false,
            'placeholder' => 'Kullanıcı Seçiniz'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?= $form->field($model,'seat_no')->textInput(['type'=>'number','maxlength' => true,''])?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
