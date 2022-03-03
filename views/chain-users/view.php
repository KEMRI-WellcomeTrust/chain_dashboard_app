<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ChainUsers */

$this->title = $model->id;
?>
<div class="chain-users-view">
  <?php
    $dh = new \app\utilities\DataHelper();
    $url = Url::to(['setpass','id'=>$model->id]);
  echo $dh->getModalButton($model, "chain-users/setpass", "Users", 'btn btn-warning btn-sm','Set Password',$url,'Users');
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
              'label'=>"Site",
                'format'=>'raw',
                'value'=>$model->fkSite->site_name,
            ],
            'email:email',
            'username',
            'role',
            'last_login',
        ],
    ]) ?>

</div>
