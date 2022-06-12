<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

use backend\assets\TagsAsset;
use common\models\Category;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

TagsAsset::register($this);
/* @var $this yii\web\View */
/* @var $model common\models\Movie */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="movie-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?php echo $form->errorSummary($model)?>

    <?= $form->field($model, 'movie_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'movie_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time')->textInput(['type'=>'number','maxlength' => true,'style'=>'width:100px','min'=>1]) ?>

    <div class="form-group">
    <label><?php echo $model->getAttributeLabel('thumbnail') ?></label>
    <div class="custom-file">
        <input type="file" class="custom-file-input"id="thumbnail" name="thumbnail">
        <label class="custom-file-label" for="thumbnail" style="width:40%;">Dosya Seçiniz</label>
    </div>
    </div>

    <?= $form->field($model, 'director')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'actors',[
                'inputOptions'=>['data-role' => 'tagsinput']
                ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Category::find()->all(),'category_id','category_name'),
        'language' => 'tr',
        'options' => [
            'multiple'=>false,
            'placeholder' => 'Kategori Seçiniz'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
