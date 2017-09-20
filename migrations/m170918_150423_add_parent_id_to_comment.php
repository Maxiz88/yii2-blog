<?php

use yii\db\Migration;

/**
 * Class m170918_150423_add_parent_id_to_comment
 */
class m170918_150423_add_parent_id_to_comment extends Migration
{
    public function up()
    {
        $this->addColumn('comment', 'parent_id', $this->integer()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('comment', 'parent_id');
    }

}
