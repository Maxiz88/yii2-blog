<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m170917_163350_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'description' => $this->text(),
            'image' => $this->string(),
            'created' => $this->dateTime(),
            'comments_status' => $this->smallInteger()->defaultValue(0),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-post-user_id',
            'post',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-post-user_id',
            'post',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }



    /**
     * @inheritdoc
     */
    public function down()
    {

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-post-user_id',
            'post'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-post-user_id',
            'post'
        );

        $this->dropTable('post');
    }
}
