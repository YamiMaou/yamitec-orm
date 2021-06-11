<?php
namespace YamiTec\ORM\Extend;
abstract class AdapterExtends implements \YamiTec\ORM\Interfaces\AdapterInterface {
    protected $_driver = null;
    protected $_charset = null;
    protected $_host = null;
    protected $_port = null;
    protected $_user = null;
    protected $_pass = null;
    protected $_database = null;
    protected $pdo;
    public function __construct()
    {
        try {
            $this->_driver = $this->_driver ?? getenv("DATABASE_DRIVER");
            $this->_charset = $this->_charset ?? getenv("DATABASE_CHARSET");
            $this->_host = $this->_host ?? getenv("DATABASE_HOST");
            $this->_port = $this->_port ?? getenv("DATABASE_PORT");
            $this->_user = $this->_user ?? getenv("DATABASE_USER");
            $this->_pass = $this->_pass ?? getenv("DATABASE_PASS");
            $this->_database = $this->_database ?? getenv("DATABASE_NAME");
            return $this;
        } catch (\PDOException $e) {
            return [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
        
    }

    public function connect(){
        try {
            $this->pdo = new \PDO(sprintf("%s:dbname=%s;host=%s;port=%s;charset=%s",$this->_driver, $this->_database, $this->_host, $this->_port, $this->_charset), 
            $this->_user, $this->_pass, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
            return $this->pdo;
        } catch (\PDOException $e) {
            return [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
    }
}