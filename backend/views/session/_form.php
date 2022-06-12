<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Movie;
use common\models\Theater;
use yii\widgets\MaskedInput;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Session */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="session-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'movie_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Movie::find()->all(),'id','movie_name'),
        'language' => 'tr',
        'options' => [
            'multiple'=>false,
            'placeholder' => 'Film Seçiniz'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'theater_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Theater::find()->all(),'id','name'),
        'language' => 'tr',
        'options' => [
            'multiple'=>false,
            'placeholder' => 'Salon Seçiniz'],
        'pluginOptions' => [
            'allowClear' => true
        ]
    ]);
    ?>

    <?= $form->field($model, 'day')->widget(MaskedInput::classname(), [
        'name' => 'input-31',
        'clientOptions' => ['alias' => 'yyyy-mm-dd']
    ]);
    ?>

    <?= $form->field($model, 'time')->textInput(['type'=>'time','maxlength' => true,'style'=>'width:100px']) ?>
    <?php /* $form->field($model, 'time')->widget(TimePicker::widget([
	'name' => 'start_time', 
	'value' => '11:24 AM',

            ])); */?>

    <?= $form->field($model, 'cost')->textInput(['type'=>'number','maxlength' => true,'style'=>'width:100px','alias'=>'H-m']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
