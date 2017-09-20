<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">



    <div class="row post">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="info">
                    <span class="username"><i class="fa glyphicon-user"><?php echo Html::encode($model->user->username); ?></i></span>
                    <span class="date"><i class="fa glyphicon-calendar"><?php echo Html::encode($model->created); ?></i></span>
                    <?php if(!Yii::$app->user->isGuest && $model->user->id == Yii::$app->user->identity->id) { ?>
                    <span class="config-buttons">
                    <?php echo Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id], ['title' => 'update']); ?>
                    <?php echo Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], ['title' => 'delete'], [
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this post?',
                            'method' => 'post',
                        ],
                    ]); ?>
                    </span>
                    <?php } ?>
                </div>


            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div>
                    <?php echo Html::img(!empty($model->image) ? Yii::$app->request->baseUrl.$model->image : Yii::$app->request->baseUrl.$model->no_image, $options = ['class' => 'postImg img-responsive', 'style' => ['width' => '250px']]); ?>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <h4><span class="content"><?php echo Html::encode($model->title);?></span></h4>
                <div class="content text">
                    <p><?php echo Html::encode($model->description); ?></p>
                </div>
            </div>
        </div>
        <hr
        <div class="row comments">
            <?php if($model->comments_status) { ?>

                <?php if($model->getComments()->count() >= 1) { ?>
                    <h4><?php echo $model->getComments()->count() . ' comment(s)'; ?></h4>
                    <?php  echo $this->render('view_comment', [
                        'post'=>$model,
                        'comments'=>$model->comments,
                        'model'=>$comment
                    ]); ?>
                <?php }  ?>
                    <?php
                    echo !Yii::$app->getSession()->hasFlash('error_comment') ?
                        $this->render('create_comment', ['model'=>$comment]) :
                        Alert::widget([
                            'options' => [
                                'class' => 'alert-danger'
                            ],
                            'body' => Yii::$app->getSession()->getFlash('error_comment')
                        ]);
                    ?>

            <?php } else {
                echo Alert::widget([
                    'options' => [
                        'class' => 'alert-danger'
                    ],
                    'body' => '<b>Comments are disabled for this post!</b>'
                ]);
            } ?>
        </div>
    </div>

</div>
