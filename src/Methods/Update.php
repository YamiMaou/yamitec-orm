<?php
namespace YamiTec\ORM\Methods;
class Update {
    private $adapter;
    private $set; 
    private $table;
    private $data;
    use Where;
    public function __construct(\PDO $adapter,$table, array $data){
        $this->adapter = $adapter;
        $this->table = $table;
        $this->data = $data;
    }

    public function execute(){
        if (empty($this->table)) {
            throw new \InvalidArgumentException("Table name can not be empty to insert");
        }

        if (!is_array($this->data)) {
            throw new \InvalidArgumentException("Variable data is not an array");
        }

        if (count($this->data) <= 0) {
            throw new \InvalidArgumentException("There is no data to insert");
        }
        $where = "";
        if($this->cond){
            $where .="WHERE {$this->cond}";
        }
        $set = implode(',',array_map(
            function($v, $k){
                return sprintf("%s = '%s'",$k,$v);
            }, $this->data, array_keys($this->data)));

        $sql = "UPDATE {$this->table} SET {$set} {$where}";
        echo $sql;
        $this->adapter->query($sql);
        return $this;
    }
}