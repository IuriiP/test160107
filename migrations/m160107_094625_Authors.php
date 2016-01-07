<?php

use yii\db\Schema;
use yii\db\Migration;

class m160107_094625_Authors extends Migration {

    public function up() {
        $this->createTable('{{%authors}}', array(
            'id' => 'pk',
            'firstname' => 'string NOT NULL',
            'lastname' => 'string NOT NULL',
        ));
        return true;
    }

    public function down() {
        echo "m160107_094625_Authors cannot be reverted.\n";

        return false;
    }

    /*
      // Use safeUp/safeDown to run migration code within a transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}
