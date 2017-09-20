<?php

use yii\helpers\Html;


$this->title = 'My Blog';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my-blog">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= $this->render('post_blocks', [
        'model' => $model,
    ]) ?>

</div>