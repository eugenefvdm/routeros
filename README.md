# routeros
A fluent interface to the MikroTik RouterOS API.

[Example Usage](#example-usage) |
[Testing](#testing) |
[Changelog](#changelog) |
[Links](#links)

## Example Usage

```php
<?php

require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload files using Composer autoload

use Routeros\Routeros;

$api = new Routeros();

$api->debug();

$result = $api->queue()->simple()->pr();

print_r ($result);

echo $api->credentials();
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