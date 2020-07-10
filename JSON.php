<?php
namespace modules\helper;

class JSON {


    // DECODING
    public static function stringify($obj) {
        return \json_encode($obj);
    }

    public static function toJson($obj) {
        return \json_encode($obj);
    }

    // DECODING
    public static function parse($obj) {
        return \json_decode($obj);
    }

    public static function fromJson($obj) {
        return \json_decode($obj);
    }

    public static function fromFile($file) {
        return json_decode(file_get_contents($obj));
    }

}