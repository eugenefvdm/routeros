<?php

require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload files using Composer autoload

use Monitor\Monitor;
use Routeros\Routeros;

$router = new Routeros(); // Create new API instance 
//$router->debug(); // Turn on debugging

$monitor = new Monitor(); // Initialise monitoring

$monitor->start();
echo $router->version() . "\n"; // Get router version information (/system/resource/print)
echo $monitor->show() . "\n"; // Display the amount of time it took to get this info

echo $router->uptime() . "\n"; // Get router uptime information. Uses a saved variable
echo $monitor->show() . "\n"; // Show how much quicker this happened

echo $router->resource('cpu-load') . "\n"; // An alternative way to get the CPU load

$queues = $router->queue()->simple()->pr(); // Get the result of /queue/simple/print
// print_r ($queues);

echo $router->credentials() . "\n"; // Return current credentials in use for the API in JSON format
echo $router->ping($router->ip_address); // Ping current IP address of API router