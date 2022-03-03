<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ChainSites */

$this->title = $model->id;
?>
<div class="chain-sites-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'site_name',
            'county',
        ],
    ]) ?>

</div>
