<?php
namespace YamiTec\ORM\Methods;
class Select {
    private $query;
    private $columns = "*";
    private $from;
    private $orderBy;
    private $groupBy;
    private $limit;
    private $adapter;
    use Where;
    use Join;
    public function __construct(\PDO $adapter){
        $this->adapter = $adapter;
    }

    public function columns($columns){
        $this->columns = $columns;
        return $this;
    }

    public function order($field, $order = "ASC"){
        $this->orderBy = "{$field} {$order}";
        return $this;
    }

    public function limit($limit){
        $this->limit = $limit;
        return $this;
    }

    public function group($field){
        $lfield = $field;
        if(is_array($lfield)){
            $lfield = implode(",", $lfield);
        }
        $this->groupBy = "{$lfield}";
        return $this;
    }

    public function from($table){
        $this->from = $table;
        return $this;
    }

    public function get($type = \PDO::FETCH_ASSOC){
        return self::exec()->fetch($type);
    }
    public function getAll($type = \PDO::FETCH_ASSOC){
        return self::exec()->fetchAll($type);
    }
    public function prepareSql(){
        $join = "";
        $where = "";
        $group = "";
        $order = "";
        $limit = "";
        if($this->join){
            $join = $this->join;
        }
        if($this->cond){
            $where .="WHERE {$this->cond}";
        }
        if($this->orderBy){
            $order .="ORDER BY {$this->orderBy}";
        }
        if($this->groupBy){
            $group .="GROUP BY {$this->groupBy}";
        }
        if($this->limit){
            $limit .="LIMIT {$this->limit}";
        }
        $this->query = "SELECT {$this->columns} FROM {$this->from} {$join} {$where} {$order} {$group} {$limit}";
        // echo $sql;
    }
    public function toString(){
        self::prepareSql();
        echo $this->query;
    }
    public function exec(){
        self::prepareSql();
        return $this->adapter->query($this->query);
        //return [$this->from, $this->columns];
    }
}