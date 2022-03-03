<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\ChainUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 

        $view_name = 'chain-users';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>
    <?= $form->field($model, 'passwd')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'confirmpass')->passwordInput() ?>
    
    <?= $form->field($model, 'checkpass')->hiddenInput()->label("") ?>

     <?= $form->field($model, 'emailpass')->checkBox() ?>
   <div class="form-group">
        <?php $url =  Url::to(["$view_name/setpass",'id'=>$model->id]);  ?>
        <?= Html::submitButton('Update', ['class' =>'btn btn-danger btn-success','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
