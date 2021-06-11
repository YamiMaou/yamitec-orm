<?php
namespace YamiTec\ORM\Methods;
class TableFactory {
    public $field;
    public $type;
    public $auto_increment;
    public $default;
    public function default($value){
        $this->default = $value;
        return $this;
    }
    public function integer(string $field, int $size = 11){
        $this->type = "INTEGER({$size})";
        $this->field = $field;
        return $this;
    }
    public function date(string $field){
        $this->type = "DATE()";
        $this->field = $field;
        return $this;
    }
    public function datetime(string $field){
        $this->type = "DATETIME()";
        $this->field = $field;
        return $this;
    }
    public function varchar(string $field, int $size = 50){
        $this->type = "VARCHAR({$size})";
        $this->field = $field;
        return $this;
    }
    public function text(string$field){
        $this->type = "TEXT";
        $this->field = $field;
        return $this;
    }
}
class Table {
    private $columns;
    private $table;
    private $orderBy;
    private $groupBy;
    private $limit;
    private $adapter;
    public function __construct(\PDO $adapter, $table){
        $this->table = $table;
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
    public function make(){
        $sql ="CREATE table $this->table(
            ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
            Prename VARCHAR( 50 ) NOT NULL, 
            Name VARCHAR( 250 ) NOT NULL,
            StreetA VARCHAR( 150 ) NOT NULL, 
            StreetB VARCHAR( 150 ) NOT NULL, 
            StreetC VARCHAR( 150 ) NOT NULL, 
            County VARCHAR( 100 ) NOT NULL,
            Postcode VARCHAR( 50 ) NOT NULL,
            Country VARCHAR( 50 ) NOT NULL);" ;
        return $this->adapter->query($sql);
        //return [$this->from, $this->columns];
    }
}