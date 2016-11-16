<?php

namespace Routeros;

class Router
{

    public static function ping($ip)
    {
        Network::ping($ip);
    }

}