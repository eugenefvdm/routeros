<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use HelloWorld\SayHello;

echo SayHello::world();

require('routeros_api.class.php');

$API = new routeros_api();

$API->debug = true;

if ($API->connect('111.111.111.111', 'LOGIN', 'PASSWORD')) {

    $API->write('/interface/getall');

    $READ = $API->read(false);
    $ARRAY = $API->parse_response($READ);

    print_r($ARRAY);

    $API->disconnect();

}

// Go to the terminal (or create a PHP web server inside "tests" dir) and type:
// php tests/test.php