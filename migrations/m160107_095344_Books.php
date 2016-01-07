<?php

use yii\db\Schema;
use yii\db\Migration;

class m160107_095344_Books extends Migration {

    public function up() {
        $this->createTable('{{%books}}', array(
            'id' => 'pk',
            'created_at' => 'timestamp NOT NULL default CURRENT_TIMESTAMP',
            'updated_at' => 'timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP',
            'name' => 'string NOT NULL',
            'preview' => 'string NOT NULL',
            'date' => 'date NOT NULL',
            'author_id' => 'integer NOT NULL',
        ));
        return true;
    }

    public function down() {
        echo "m160107_095344_Books cannot be reverted.\n";

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
