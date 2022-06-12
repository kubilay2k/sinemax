<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Html;

$this->title = 'Hata!';
?>
<div class="site-error">

    <h1><?= Html::encode('Hata!') ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Sorunun Bizden Kaynaklı Olduğunu Düşünüyorsanız İletişime Geçiniz.
    </p>


</div>
