<?php

require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload files using Composer autoload

use Routeros\Routeros;

$api = new Routeros();

$api->debug();

$result = $api->queue()->simple()->pr();

print_r ($result);

echo $api->credentials();
