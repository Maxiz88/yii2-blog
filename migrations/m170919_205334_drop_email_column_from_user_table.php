<?php

use yii\db\Migration;

/**
 * Handles dropping email from table `user`.
 */
class m170919_205334_drop_email_column_from_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('user', 'email');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('user', 'email', $this->string());
    }
}
