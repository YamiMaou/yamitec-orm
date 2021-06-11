<?php
namespace YamiTec\ORM\Methods;
trait Schema {
    public function create_table(string $table, $handler){
        return $handler;
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