<?php
namespace de\interaapps\ulole\helper;


class Collection
{
    public $array;

    public function __construct($arr) {
        if (is_array($arr))
            $this->array = $arr;
        else if (is_object($arr)) {
            $this->array = [];
            foreach ($arr as $item){
                $this->array[] = $item;
            }
        } else {
            $this->array = [];
        }
    }

    public function sort() {
        sort($this->array);
        return $this;
    }

    public function add($value) {
        array_push($this->array, $value);
        return $this;
    }

    public function removeAt($index) {
        unset($this->array[$index]);
        return $this;
    }

    public function remove($item) {
        $this->array = array_diff($this->array, [$item]);
        return $this;
    }

    public function pop() {
        $this->array = array_pop($this->array);
        return $this;
    }

    public function diff(array $array) {
        $this->array = array_diff($this->array, $array);
        return $this;
    }

    public function map($closure) {
        $this->array = array_map($closure, $this->array);
        return $this;
    }

    public function each(\Closure $closure) {
        foreach ($this->array as $item) {
            $closure($item);
        }
        return $this;
    }


    public function join($glue = ", ") {
        return implode($glue, $this->array);
    }

    public function size() {
        return count($this->array);
    }

    public function contains($item) {
        return in_array($item, $this->array);
    }


    public static function from($arr) {
        return new Collection($arr);
    }


    public function array() : array {
        return $this->array;
    }
    public function arr() : array {
        return $this->array;
    }
    public function toArray() : array {
        return $this->array;
    }

    public function __invoke()
    {
        return "asfd";
    }
}