<?php
namespace de\interaapps\ulole\helper;


class Str {
    public $string;

    public function __construct(string $string = '')
    {
        $this->string = $string;
    }

    public function replace($from, $to) : Str {
        $this->string = str_replace($from, $to, $this->string);
        return $this;
    }

    public function append($append) : Str {
        $this->string .= $append;
        return $this;
    }

    public function padLeft($length, $pad = " ") : Str {
        $this->string = str_pad($this->string, $length, $pad, STR_PAD_LEFT);
        return $this;
    }

    public function padRight($length, $pad = " ") : Str {
        $this->string = str_pad($this->string, $length, $pad, STR_PAD_RIGHT);
        return $this;
    }

    public function padBoth($length, $pad = " ") : Str {
        $this->string = str_pad($this->string, $length, $pad, STR_PAD_BOTH);
        return $this;
    }

    public function trim($charList = null) : Str {
        $this->string = $charList == null ? trim($this->string) : trim($this->string, $charList);
        return $this;
    }

    public function rightTrim($charList = null) : Str {
        $this->string = $charList == null ? rtrim($this->string) : rtrim($this->string, $charList);
        return $this;
    }

    public function leftTrim($charList = null) : Str {
        $this->string = $charList == null ? ltrim($this->string) : ltrim($this->string, $charList);
        return $this;
    }

    public function limit($limit, $close="", $showAlways = false) : Str {
        $this->string = substr($this->string, 0, $limit).($showAlways || strlen($this->string) > $limit ? $close : '');
        return $this;
    }

    public function lower() : Str {
        $this->string = strtolower($this->string);
        return $this;
    }

    public function upper() : Str {
        $this->string = strtoupper($this->string);
        return $this;
    }

    public function camelCase($delimiters = null) : Str {
        $this->string = $delimiters === null ? ucwords($this->string) : ucwords($this->string, $delimiters);
        return $this;
    }

    public function replaceArray(array $array) {
        $replaced = $this->string;
        foreach ($array as $key=>$value)
            $replaced = str_replace($key, $value, $replaced);
        return $replaced;
    }

    public function between($start, $end) : Str {
        $string = $this->string;
        $ini = strpos($string, $start);
        if ($ini === false)
            return new Str();
        $ini += strlen($start);
        if ($end=="") {
            $this->string = substr($string, $ini, strlen($string));
            return $this;
        }
        $len = strpos($string, $end, $ini) - $ini;
        $this->string = substr($string, $ini, $len);
        return $this;
    }

    public function before($end){
        $pos = strpos($this->string, $end);
        if ($pos === false)
            $this->string = "";
        else
            $this->string = substr($this->string, 0, $pos);
        return $this;
    }

    public function after($start){
        $pos = strpos($this->string, $start);

        if ($pos === false)
            $this->string = "";
        else
            $this->string = substr($this->string, $pos + strlen($start), strlen($this->string));
        return $this;
    }




    public function split($delimiter, $limit = null) {
        if ($limit == null)
            return explode($delimiter, $this->string);
        return explode($delimiter, $this->string, $limit);
    }

    public function pos($needle, $offset = 0) {
        return strpos($needle, $this->string, $offset);
    }

    public function length() {
        return strlen($this->string);
    }

    public function contains($needle) {
        return strpos($needle, $this->string) !== false;
    }

    public function containsAll(array $needles) {
        foreach ($needles as $needle) {
            if (strpos($this->string, $needle) === false)
                return false;
        }
        return true;
    }



    public static function from(string $string) : Str
    {
        return new Str($string);
    }

    public static function random(int $length, string $chars="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789")
    {
        $random = "";
        $charsLength = strlen($chars) - 1;
        for ($i = 0; $i < $length; $i++)
            $random .= $chars[rand(0, $charsLength)];
        return new Str($random);
    }




    public function __toString() {
        return $this->string;
    }

    public function toString() {
        return $this->string;
    }

    public function getString() {
        return $this->string;
    }

    public function str() {
        return $this->string;
    }

    public function __invoke()
    {
        return $this->string;
    }
}