<?php
namespace YamiTec\ORM;

use YamiTec\ORM\Extend\AdapterExtends;
use YamiTec\ORM\Methods\Schema;
use YamiTec\ORM\Methods\Select;

class YamiORM {
    protected $conn;
    use Schema;
    public function __construct(AdapterExtends $adapter){
        $this->conn = (new $adapter)->connect();
    }
    public function Select(){
        return new Select($this->conn);
    }

    public function Update(){

    }
    public function Insert(){

    }
    public function Delete(){

    }
    public function createTable($table, $handler){
        return $this->create_table($table, $handler);
    }
    public function showTables(){
        $rows = $this->conn->query("show tables")->fetchAll(\PDO::FETCH_ASSOC);
        return [
            "rows" => count($rows),
            "data" => $rows,
        ];
    }
}