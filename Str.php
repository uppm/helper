<?php
namespace modules\helper;

class Str {

    public $string;
    function __construct($string) {
        $this->string = $string;
    }
    public function replace($stringToReplace, $replaceWith=false) {
        $out = $this->string;

        if (is_array($stringToReplace)) {
            foreach ($stringToReplace as $key=>$value) 
                $out = str_replace($key, $value, $out);
        } else {
            $out = str_replace($stringToReplace, $replaceWith,$this->string);
        }

        $this->string = $out;
        return $this;
    }

    public function append($string) {
        $this->string .= $string;
        return $this;
    }

    

    public function appendNewLine($string) {
        $this->string .= "\n".$string;
        return $this;
    }

    public function clear() {
        $this->string = "";
        return $this;
    }

    public function getString() {
        return $this->string;
    }

    public function contains($val) {
        return strpos($this->string, $val) !== false;
    }

    public function writeFile($path) {
        $this->string =  \file_put_contents($path, $this->string);
        return $this;
    }

    public function trim(){
        $this->string = trim($this->string);
        return $this;
    }

    public function __toString(){
        return $this->string;
    }
    public static function random($length = 10, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    } 

    public static function of($string) : Str {
        return new Str($string);
    }

    public static function containsValue($val, $string) {
        return strpos($string, $val) !== false;
    }
}