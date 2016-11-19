# routeros
A fluent interface to the MikroTik RouterOS API.

[Example Usage](#example-usage) |
[Testing](#testing) |
[Changelog](#changelog) |
[Links](#links)

## Installation

### Winbox
http://myhomelab.blogspot.co.za/2013/05/installing-mikrotik-routeros-under-VirtualBox.html

## Example Usage

```php
<?php

require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload files using Composer autoload

use Monitor\Monitor;
use Routeros\Routeros;

$router = new Routeros(); // Create new API instance
//$router->debug(); // Turn on debugging

$monitor = new Monitor(); // Initialise monitoring

$monitor->start();
echo $router->version() . "\n"; // Get router version information (/system/resource/print)
$monitor->show(); // Display the amount of time it took to get this info

echo $router->uptime() . "\n"; // Get router uptime information. Uses a saved variable
$monitor->show(); // Show how much quicker this happened

echo $router->resource('cpu-load') . "\n"; // An alternative way to get the CPU load

$queues = $router->queue()->simple()->pr(); // Get the result of /queue/simple/print
// print_r ($queues);

echo $router->credentials() . "\n"; // Return current credentials in use for the API in JSON format
echo $router->ping($router->ip_address); // Ping current IP address of API router
```

## Testing

The command below will link to a public router and run this API command ``/interface/getall`` 

```php
php tests/main.php 
```

## Changelog

* Fixed API for PhpStorm to avoid warnings

## Links

During the construction of this library various links were followed.

* http://blog.jgrossi.com/2013/creating-your-first-composer-packagist-package/
* https://github.com/BenMenking/routeros-api/blob/master/routeros_api.class.php
* http://wiki.mikrotik.com/wiki/API_PHP_class