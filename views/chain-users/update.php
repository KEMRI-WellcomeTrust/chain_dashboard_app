<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChainUsers */

$this->title = 'Update Chain Users: ' . $model->id;
?>
<div class="chain-users-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
