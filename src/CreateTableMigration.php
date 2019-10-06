<?php
namespace codexten\yii\db\migration;

use yii\db\Connection;
use yii\db\Migration;
use yii\di\Instance;

/**
 * Class CreateTableMigration
 * @package codexten\mine\core\migrations
 *
 * @property string $tableName
 */
abstract class CreateTableMigration extends Migration
{

    public $table;

    public function init()
    {
//        $this->db = Instance::ensure($this->migrationDb, Connection::class);
        parent::init();
    }

    abstract protected function columns(): array;

    protected function indices()
    {
        return [];
    }

    public function safeUp()
    {
        $this->createTable($this->tableName, $this->columns());
//        if (!empty($this->indices())){
//            $this->createIndex("index{$this->table}", $this->tableName, $this->indices());
//
//        }
    }


    public function safeDown()
    {
        foreach ($this->indices() as $column) {
            $this->dropIndex($this->getIndexName($column), $this->tableName);
        }
        $this->dropTable($this->tableName);
    }

    protected function getIndexName($name)
    {
        return "index{$name}";
    }


    public function getTableName()
    {
        return "{$this->db->tablePrefix}{$this->table}";
    }
}