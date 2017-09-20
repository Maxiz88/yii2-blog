<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="comment-form">

    <?php
    
    $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'parent_id')->textInput(['type' => 'hidden', 'value' => $parent_comment]) ?>

    <div class="form-group">
        <?= Html::submitButton('Reply', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
