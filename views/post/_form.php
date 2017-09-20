<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

   
    <?php if(!empty($model->image)){
        echo Html::img(Yii::$app->request->baseUrl.$model->image, $options = ['class' => 'postImg', 'style' => ['width' => '180px']]);
        echo Html::a('<span class="glyphicon glyphicon-trash"></span>', ['post/delete-image', 'id' => $model->id], [
            'onclick'=>
                "$.ajax({
             type:'POST',
             cache: false,
             url: '".Url::to(['post/delete-image', 'id' => $model->id])."',
             success  : function(response) {
                 $('.link-del').html(response);
                 $('.postImg').remove();
             }
          });
     return false;",
            'class' => 'link-del'
        ]);
    } ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'comments_status')->dropDownList([
    '0' => 'Off',
    '1' => 'On'
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
