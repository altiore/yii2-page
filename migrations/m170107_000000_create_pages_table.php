<?php
namespace altiore\page\migrations;

use altiore\base\console\Migration;
use Yii;

class m170107_000000_create_pages_table extends Migration
{
    private $table = '{{%page}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->table, [
            'id'          => $this->primaryKey(),
            'title'       => $this->string()->notNull(),
            'text'        => $this->text()->notNull(),
            'created_at'  => $this->integer()->notNull(),
            'updated_at'  => $this->integer()->notNull(),
            'created_by'  => $this->integer(),
            'updated_by'  => $this->integer(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
