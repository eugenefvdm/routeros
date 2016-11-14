<?php

namespace Routeros;

class Router
{
    public static function test()
    {

        $API = new RouterosAPI();

        $API->debug = true;

        if ($API->connect('154.119.54.254', 'api', 'test')) {

            $API->write('/interface/getall');

            $READ = $API->read(false);
            $ARRAY = $API->parseResponse($READ);

            print_r($ARRAY);

            $API->disconnect();

        }

    }
}