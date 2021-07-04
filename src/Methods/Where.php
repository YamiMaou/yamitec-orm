<?php
namespace YamiTec\ORM\Methods;
trait Where{
    private $cond = "";

    public function Where($cond, $type = "="){
        if($this->cond !== ""){
            $this->cond .= " AND ";
        }
        if(is_array($cond)){
            $this->cond .= implode(' AND ',array_map(
                function($v, $k) use ($type) {
                    return sprintf("%s {$type} '%s'",$k,$v);
                }, $cond, array_keys($cond)));
        }elseif(is_string($cond)){
            $this->cond .= $cond;
        }
        return $this;
    }

    public function OrWhere($cond, $type = "="){
        if($this->cond !== ""){
            $this->cond .= " OR ";
        }
        if(is_array($cond)){
            $this->cond .= implode(' AND ',array_map(
                function($v, $k) use ($type) {
                    return sprintf("%s {$type} '%s'",$k,$v);
                }, $cond, array_keys($cond)));
        }elseif(is_string($cond)){
            $this->cond .= $cond;
        }
        return $this;
    }
    public function WhereBetween($field, $cond){
        if($this->cond !== ""){
            $this->cond .= " AND ";
        }
        if(is_array($cond)){
            $this->cond .= implode(' ',array_map(
                function($v, $k) use($field){
                    return sprintf("{$field} BETWEEN '%s' AND '%s'",$k,$v);
                }, $cond, array_keys($cond)));
        }elseif(is_string($cond)){
            $this->cond .= $cond;
        }
        return $this;
    }

    public function WhereIn($cond, $type = "IN"){
        if($this->cond !== ""){
            $this->cond .= " AND ";
        }
        if(is_array($cond)){
            $this->cond .= implode(' AND ',array_map(
                function($v, $k) use ($type) {
                    return sprintf("%s {$type} '%s'",$k,$v);
                }, $cond, array_keys($cond)));
        }elseif(is_string($cond)){
            $this->cond .= $cond;
        }
        return $this;
    }

    public function WhereNotIn($cond, $type = "NOT IN"){
        if($this->cond !== ""){
            $this->cond .= " AND ";
        }
        if(is_array($cond)){
            $this->cond .= implode(' AND ',array_map(
                function($v, $k) use ($type) {
                    return sprintf("%s {$type} '%s'",$k,$v);
                }, $cond, array_keys($cond)));
        }elseif(is_string($cond)){
            $this->cond .= $cond;
        }
        return $this;
    }
    
}