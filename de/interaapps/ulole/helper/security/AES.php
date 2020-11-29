<?php


namespace de\interaapps\ulole\helper\security;


use de\interaapps\ulole\helper\Str;

class AES
{
    private $key,
        $data,
        $method,
        $options = 0,
        $customIV = null;

    function __construct($data = null, $key = null, $blockSize = null, $mode = 'CBC') {
        $this->data = $data;
        $this->key = $key;
        if ($mode === 'ECB')
            $this->customIV = "";
        $this->method = 'AES-' . $blockSize . '-' . $mode;
    }

    private function getInitializationVector() {
        if (isset($this->customIV))
            return $this->customIV;
        if (strpos($this->data, ":")) {
            [$iv, $data] = explode(":", $this->data, 2);
            return $iv;
        }

        return '1234567890123456';
    }

    public function decryptThis() {
        $data = $this->data;
        if (strpos($this->data, ":")) {
            $data = explode(":", $this->data, 2)[1];
        }

        if ($this->data != null && $this->method != null)
            return trim(openssl_decrypt(
                $data,
                $this->method,
                $this->key,
                $this->options,
                $this->getInitializationVector()
            ));
        else {
            throw new \Exception("Given Invalid parameters!");
        }
    }

    public function encryptThis() {
        $data = $this->data;
        $iv = $this->getInitializationVector();
        if ($this->customIV === null) {
            $iv = Str::random(16)->str();
        }

        if ($this->data != null && $this->method != null)
            return ($this->customIV === null ? $iv.":" : '').trim(openssl_encrypt(
                $data,
                $this->method,
                $this->key,
                $this->options,
                $iv
            ));
        else {
            throw new \Exception('Given Invalid parameters!');
        }
    }

    public static function encrypt($inputText, $inputKey, $blockSize = 256, $mode = "CBC") {
        if ($inputText != "") {
            $aes = new AES($inputText, $inputKey, $blockSize, $mode);
            return $aes->encryptThis();
        } else return "";
    }

    public static function decrypt($inputText, $inputKey, $blockSize = 256, $mode = "CBC") {
        if ($inputText == "") return "";
        $aes = new AES($inputText, $inputKey, $blockSize, $mode);
        return $aes->decryptThis($inputText);
    }

    public function setCustomIV($customIV) {
        $this->customIV = $customIV;
        return $this;
    }


}