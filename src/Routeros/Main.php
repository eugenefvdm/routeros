<?php

require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload files using Composer autoload

use Routeros\Routeros;

$api = new Routeros(); // Create new API instance
$api->debug(); // Turn on debugging
$result = $api->queue()->simple()->pr(); // Get the result of /queue/simple/print
print_r ($result);
echo $api->credentials(); // Return current credentials in use for the API in JSON format
echo $api->router()->ping($api->ip_address);