<?php

namespace Routeros;

use Network\Network;

class Router
{

    public static function ping($ip)
    {
        return Network::ping($ip);
    }

}