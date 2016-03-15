<?php
class TP_yyToken implements ArrayAccess
{
public $string='';
public $metadata=array();

public function __construct($s,$m=array())
{
if($s instanceof TP_yyToken){
$this->string=$s->string;
$this->metadata=$s->metadata;
}else{
$this->string=(string) $s;
if($m instanceof TP_yyToken){
$this->metadata=$m->metadata;
} elseif(is_array($m)){
$this->metadata=$m;
}
}
}

public function __toString()
{
return $this->_string;
}

public function offsetExists($offset)
{
return isset($this->metadata[$offset]);
}

public function offsetGet($offset)
{
return $this->metadata[$offset];
}

public function offsetSet($offset,$value)
{
if($offset === null){
if(isset($value[0])){
$x=($value instanceof TP_yyToken) ?
$value->metadata : $value;
$this->metadata=array_merge($this->metadata,$x);

return;
}
$offset=count($this->metadata);
}
if($value === null){
return;
}
if($value instanceof TP_yyToken){
if($value->metadata){
$this->metadata[$offset]=$value->metadata;
}
} elseif($value){
$this->metadata[$offset]=$value;
}
}

public function offsetUnset($offset)
{
unset($this->metadata[$offset]);
}
}

class TP_yyStackEntry
{
public $stateno; 
public $major; 
public $minor; 
};
