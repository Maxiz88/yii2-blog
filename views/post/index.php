<?php

use yii\helpers\Html;
use \yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render(
        'post_blocks', [
        'model' => $model
    ]);
    ?>

</div>
