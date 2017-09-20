<?php

use yii\helpers\Html;
use yii\bootstrap\Collapse;

?>

<?php foreach($comments as $comment_data) { ?>
    <?php if($comment_data->parent_id == 0) { ?>
        <div class="row alert-info comment-block comm-<?php echo Html::encode($comment_data->id); ?>">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="info">
                    <span class="username"><i class="fa glyphicon-user"><?php echo Html::encode($comment_data->user->username); ?></i></span>
                    <span class="date"><i class="fa glyphicon-calendar"><?php echo Html::encode($comment_data->created); ?></i></span>
                    <?php if(!Yii::$app->user->isGuest && $comment_data->user->id == Yii::$app->user->identity->id) { ?>
                        <?php echo $this->render('comment_config_buttons', [
                            'comment_data' => $comment_data
                        ]); ?>
                    <?php } ?>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php echo Html::encode($comment_data->text); ?>
            </div>
            <?php foreach ($comment_data->children as $comment_children) { ?>
                <div class="alert-warning comment-children comm-<?php echo Html::encode($comment_children->id); ?>">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <span class="username"><i class="fa glyphicon-user"><?php echo Html::encode($comment_children->user->username); ?></i></span>
                        <span class="date"><i class="fa glyphicon-calendar"><?php echo Html::encode($comment_children->created); ?></i></span>
                        <?php if(!Yii::$app->user->isGuest && $comment_children->user->id == Yii::$app->user->identity->id) { ?>
                            <?php echo $this->render('comment_config_buttons', [
                                'comment_data' => $comment_children
                            ]); ?>
                        <?php } ?>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php echo Html::encode($comment_children->text); ?>
                    </div>
                </div>
            <?php } ?>
            <?php
            if(!Yii::$app->getSession()->hasFlash('error_comment')) {
                echo Collapse::widget([
                    'items' => [
                        [
                            'label' => 'reply',
                            'content' => $this->render('create_reply_comment', [
                                'model' => $model,
                                'parent_comment' => $comment_data->id
                            ]),
                            'contentOptions' => [],
                            'options' => []
                        ],
                    ]]);
            }
            ?>

        </div>
    <?php } ?>
<?php } ?>