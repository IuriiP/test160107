<?php

use yii\db\Schema;
use yii\db\Migration;

class m160107_101842_Books_add_FK extends Migration {

    public function up() {
        $this->addForeignKey('fk_author', '{{%books}}', 'author_id', '{{%authors}}', 'id', 'CASCADE', 'RESTRICT');
        return true;
    }

    public function down() {
        $this->dropForeignKey('fk_author', '{{%books}}');
        return true;
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
