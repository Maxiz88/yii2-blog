<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="comment-form">

    <?php

    $form = ActiveForm::begin(['action' => 'update-comment?id='.$model->id]); ?>



    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton('Add comment', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
