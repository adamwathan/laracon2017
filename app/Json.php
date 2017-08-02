<?php

namespace App;

class Json
{
    public static function load($path)
    {
        return json_decode(file_get_contents($path), true);
    }
}
