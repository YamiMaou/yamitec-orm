<?php
namespace YamiTec\ORM\Methods;
trait Where{
    private $cond;

    public function where($cond, $type = "AND"){

        if(is_array($cond)){
            $this->cond = implode(', ',array_map(
                function($k, $v) use ($type) {
                    return sprintf("%s {$type} '%s'",$k,$v);
                }, $cond, array_keys($cond)));
        }elseif(is_string($cond)){
            $this->cond = $cond;
        }
        return $this;
    }
    
}