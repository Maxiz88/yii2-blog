<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<span class="config-buttons">
                        <?php
                        Modal::begin([
                            'header' => '<h2>Update comment</h2>',
                            'toggleButton' => [
                                'tag' => 'button',
                                'class' => 'btn-xs btn-info',
                                'label' => 'update',
                            ]
                        ]);

                        echo $this->render('update_comment', [
                            'model' => $comment_data,
                        ]);

                        Modal::end();
                        ?>
                        <?php
                        echo Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete-comment', 'id' => $comment_data->id], [
                            'onclick'=>
                                "$.ajax({
                             type:'POST',
                             cache: false,
                             url: '".Url::to(['delete-comment', 'id' => $comment_data->id])."',
                             success  : function(response) {
                                 $('.comm-".$comment_data->id."').html(response);
                             }
                          });
                            return false;"

                        ]);
                        ?>
                        
                </span>