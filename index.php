<?php
require("vendor/autoload.php");
(new \YamiTec\DotENV\DotENV(__DIR__ . '/.env'))->load();
try{
    $adp = new \YamiTec\ORM\Adapters\MySQLAdapter();
    $database = new \YamiTec\ORM\YamiORM($adp);
    var_dump($database->Select()->from("users")->get());
    //print_r($database->showTables());
}catch(\Exception $ex){
    echo $ex->getMessage();
}