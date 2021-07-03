<?php
namespace YamiTec\ORM\Methods;
class Insert {
    private $adapter;
    public function __construct(\PDO $adapter){
        $this->adapter = $adapter;
    }

    public function execute($table, array $data){
        if (empty($table)) {
            throw new \InvalidArgumentException("Table name can not be empty to insert");
        }

        if (!is_array($data)) {
            throw new \InvalidArgumentException("Variable data is not an array");
        }

        if (count($data) <= 0) {
            throw new \InvalidArgumentException("There is no data to insert");
        }

        $fields = implode(', ', array_keys($data));

        $values = rtrim(str_repeat('?,', count($data)), ',');
        $fields = rtrim($fields, ', ');

        $query = sprintf('INSERT INTO %s (%s) VALUES(%s)', $table, $fields, $values);

        $stmt = $this->adapter->prepare($query);

        $i = 1;
        foreach ($data  as $key => $value) {
            $stmt->bindValue($i, $value);
            $i++;
        }
        $stmt->execute();
        return $stmt;
    }
}