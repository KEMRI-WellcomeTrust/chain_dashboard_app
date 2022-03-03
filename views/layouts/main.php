<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\bootstrap\Modal;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123796645-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-123796645-1');
    </script>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title> CHAIN Network Reports Dashboard <?php // echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div  class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => "CHAIN Network Reports Dashboard",
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
            'id'=>'titleBar'
        ],
    ]);
    $dh = new \app\utilities\DataHelper();
    if(!Yii::$app->user->isGuest){
        $url = Url::to(['chain-users/view','id'=>Yii::$app->user->identity->id]);
        $profile_btn =  $dh->getModalButton(Yii::$app->user->identity, "chain-users/view", "Users", 'btn btn-info btn-margin','My Profile',$url,'Users');
    }
    else{
        $profile_btn = "";
    }
    
    if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->fk_site == 10 || Yii::$app->user->identity->fk_site == 6)){
        $url = Url::to(['site/banfora','user_id'=>Yii::$app->user->identity->id]);
        $banforalink = Html::a("Banfora Samples", $url,['class'=>"btn btn-info btn-margin"]);
    }
    else{
        $banforalink = "";
    }
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index'],'linkOptions' => ['class'=>'btn btn-info btn-margin']],
             '<li>'
                . $banforalink
                . '</li>',
            !Yii::$app->user->isGuest ? (
                '<li>'
                . $profile_btn
                . '</li>'
            ) : "",
            !Yii::$app->user->isGuest ? (
                ['label' => 'Data Request', 'url' => "https://analysis.chainnetwork.org",'linkOptions' => ['class'=>'btn btn-info btn-margin']]
            ) : "",
            app\models\ChainUsers::isAdmin() ? (
                ['label' => 'Admin', 'url' => ['/chain-users/index'],'linkOptions' => ['class'=>'btn btn-info btn-margin']]
            ) : "",
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login'],'linkOptions' => ['class'=>'btn btn-default']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                  "Hi ". Yii::$app->user->identity->username. ', (Logout)',
                    ['class' => 'btn btn-success logout']
                )
                . Html::endForm()
                . '</li>'
            )
            
        ],
        
            
        
    ]);
    NavBar::end();
    ?>

    
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>

</div>
<?php 
 $url = Url::to('@web/js/jsLib.js', true);
$this->registerJsFile($url, ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

     <?php
       // Using a select2 widget inside a modal dialog
        Modal::begin([
            'options' => [
                'id' => 'modal_id',
                'tabindex' => false // important for Select2 to work properly
            ],
            'header' => '<div id="modal_title_div"> <h4 style="margin:0; padding:0">CHAIN Reports Dashboard</h4> </div>',
           // 'toggleButton' => ['label' => 'Show Modal', 'class' => 'btn btn-lg btn-primary'],
        ]);
       
        echo '<div class="modal-body" id="modal_body_div"> </div>';
          
        Modal::end();  
     ?>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; CHAIN Network <?= date('Y') ?> </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
