<?php

use de\interaapps\ulole\helper\Collection;
use de\interaapps\ulole\helper\Str;

function str($string) : Str {
    return new Str($string);
}

function collect($array){
    return new Collection($array);
}