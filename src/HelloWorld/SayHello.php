<?php

namespace HelloWorld;

class SayHello
{
    public static function world()
    {
        include "routeros_api.class.php";
        return 'Hello World, Composer!';
    }
}