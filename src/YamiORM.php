<?php
namespace YamiTec\ORM;

use YamiTec\ORM\Extend\AdapterExtends;
use YamiTec\ORM\Methods\Insert;
use YamiTec\ORM\Methods\Schema;
use YamiTec\ORM\Methods\Select;
use YamiTec\ORM\Methods\Update;

class YamiORM {
    protected $conn;
    use Schema;
    public function __construct(AdapterExtends $adapter){
        $adp = (new $adapter);
        $this->conn = $adp->connect();
        if($adp->getStatus() === false){
            echo json_encode(["succes" => false, "message" => "Falha na conexão com o servidor.", "code" => "x03"]);
            die;
        }
        
    }
    public function Query($query){
        return $this->conn->query($query)->fetchAll();
    }
    public function Select(){
        return new Select($this->conn);
    }

    public function Update($table, array $data){
        return (new Update($this->conn,$table, $data));
    }
    public function Create($table, array $data){
        return (new Insert($this->conn))->execute($table, $data);
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