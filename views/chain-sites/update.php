<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChainSites */

$this->title = 'Update Chain Sites: ' . $model->id;

?>
<div class="chain-sites-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
