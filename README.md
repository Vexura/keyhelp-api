KeyHelp PHP API Client
=======================
This **PHP 7.2+** library allows you to communicate with the KeyHelp-API.

[![Latest Stable Version](http://poser.pugx.org/vexura/keyhelp-api/v)](https://packagist.org/packages/vexura/keyhelp-api)
[![Total Downloads](http://poser.pugx.org/vexura/keyhelp-api/downloads)](https://packagist.org/packages/vexura/keyhelp-api)
[![Latest Unstable Version](http://poser.pugx.org/vexura/keyhelp-api/v/unstable)](https://packagist.org/packages/vexura/keyhelp-api)
[![License](http://poser.pugx.org/vexura/keyhelp-api/license)](https://packagist.org/packages/vexura/keyhelp-api)

> You can find the full API documentation [here](https://app.swaggerhub.com/apis-docs/keyhelp/api/2.4)!
## Getting Started

Recommended installation is using **Composer**!

In the root of your project execute the following:
```sh
$ composer require vexura/keyhelp-api
```

Or add this to your `composer.json` file:
```json
{
    "require": {
        "vexura/keyhelp-api": "^1.0"
    }
}
```

Then perform the installation:
```sh
$ composer install --no-dev
```

### Examples

Creating the KeyHelpAPI main object:

```php
<?php
// Require the autoloader
require_once 'vendor/autoload.php';
// Use the library namespace
use KeyHelpAPI\KeyHelpAPI;
// Then simply pass your API-Token when creating the API client object.
$client = new KeyHelpAPI('API-Token');
// Then you are able to perform a request
var_dump($client->server()->getPing());
?>
```