<?php
namespace YamiTec\ORM\Methods;
class Select {
    private $columns = "*";
    private $from;
    private $orderBy;
    private $groupBy;
    private $limit;
    private $adapter;
    use Where;
    public function __construct(\PDO $adapter){
        $this->adapter = $adapter;
    }
    public function columns($columns){
        $this->columns = $columns;
        return $this;
    }
    public function from($table){
        $this->from = $table;
        return $this;
    }
    public function get(){
        return $this->adapter->query("SELECT {$this->columns} FROM $this->from")->fetchAll();
        //return [$this->from, $this->columns];
    }
}