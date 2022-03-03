<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\utilities\DataHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ChainSitesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chain Sites';
?>
<div class="panel panel-info chain-sites-index">
      <div class="panel-heading">Administration Section</div>
      <div class="panel-body row">
        <div class="col-sm-3 sidebar panel panel-info">

      <?php
      
      $ranges = [
               '200000'=>Html::a('Users',['chain-users/index']), 
               '300000'=>Html::a('Sites',['chain-sites/index']), 
               ];
      echo "<ul class='list-group'>";
      foreach($ranges as $key => $range){
          
          echo "<li class='list-group-item'>".$range."</li>";
      }
      echo "<ul>";
      ?>

        </div>
       <div class="col-sm-9">
            <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id'=>'pjax-chain-sites']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php  // Html::a('Create Chain Users', ['create'], ['class' => 'btn btn-success']);
        $dh = new DataHelper();
        $url = Url::to(['create']);
        echo  $dh->getModalButton(new \app\models\ChainUsers, 'chain-sites/create', 'ChainSites', 'btn btn-info btn-create pull-right',"New",$url,"ChainSites");
         ?> <br/> 
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'site_name',
            'county',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update}{delete}',
            'buttons' => [
                           'view' => function ($url, $model){
                
                                    $dh = new DataHelper();
                                   $url = Url::to(['view','id'=>$model->id]);
                                  return $dh->getModalButton($model, "chain-sites/view", "Users", 'glyphicon glyphicon-eye-open','',$url,'Users');

                           }, 
                           'update' => function ($url, $model, $keyword) {
                                   $dh = new DataHelper();
                                   $url = Url::to(['update','id'=>$model->id]);
                                  return $dh->getModalButton($model, "chain-sites/update", "Users", 'glyphicon glyphicon-edit','',$url,'Users');
                           }
                   ], 
        ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
        </div>
    
    </div>
</div>