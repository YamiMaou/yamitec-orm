<?php
namespace YamiTec\ORM\Methods;
trait Join{
    private $join = "";
    private $on = "";
    public function On($where, $type = "="){
        if(is_array($where)){
            $this->on .= implode('AND',array_map(
                function($v, $k) use ($type) {
                    return sprintf("%s {$type} '%s'",$k,$v);
                }, $where, array_keys($where)));
        }elseif(is_string($where)){
            $this->on .= $where;
        }
    }
    public function innerJoin($table){
        if($this->join) {
            $this->join .= " INNER JOIN {$table} {$this->on}";
        } else {
            $this->join = " INNER JOIN {$table} {$this->on}";
        }
    }

    public function leftJoin($table){
        if($this->join){
            $this->join .= " LEFT JOIN  {$this->on}";
        } else {
            $this->join = " LEFT JOIN {$table} {$this->on}";
        }
    }

    public function rigthJoin($table){
        if($this->join){
            $this->join .= " RIGTH JOIN {$table} {$this->on}";
        } else {
            $this->join = " RIGTH JOIN {$table} {$this->on}";
        }
    }
}