<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ChainUsers */

$this->title = 'Create Chain Users';
$this->params['breadcrumbs'][] = ['label' => 'Chain Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chain-users-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
