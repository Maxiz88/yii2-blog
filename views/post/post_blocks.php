<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;

foreach ($model as $post) {

    ?>
    <div class="row post-blocks">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="info">
                    <span class="username"><i class="fa glyphicon-user"><?php echo Html::encode($post->user->username); ?></i></span>
                    <span class="date"><i class="fa glyphicon-calendar"><?php echo Html::encode($post->created); ?></i></span>
                    <span class="comment-count"><i class="fa glyphicon-comment"><?php echo Html::encode($post->getComments()->count()); ?></i></span>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div>
                    <?php echo Html::a(Html::img(!empty($post->image) ? Yii::$app->request->baseUrl.$post->image : Yii::$app->request->baseUrl.$post->no_image, $options = ['class' => 'postImg img-responsive', 'style' => ['width' => '250px']]),
                        ['post/view', 'id' => $post->id]
                    );
                    ?>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <h4><span class="content"><?php echo Html::a(Html::encode($post->title), ['post/view', 'id' => $post->id]);?></span></h4>
                <div class="content text">
                    <p><?php echo StringHelper::truncate(Html::encode($post->description), 150, '...'); ?></p>
                </div>
            </div>
        </div>
    </div>


    <?php
}
?>