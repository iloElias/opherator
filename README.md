# opherator Router @IloElias

[![Maintainer](http://img.shields.io/badge/maintainer-@iloElias-blue.svg)](https://github.com/iloElias)
[![Package](https://img.shields.io/badge/package-iloelias/opherator-orange.svg)](https://packagist.org/packages/ilias/opherator)
[![Source Code](https://img.shields.io/badge/source-iloelias/opherator-blue.svg)](https://github.com/iloElias/opherator)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)

This PHP router system allows you to define and manage your application's routes in a simple and organized manner, inspired by Laravel's routing system.
## Installation

To install the package, add it to your `composer.json` file:

```json
{
  "require": {
    "ilias/opherator": "1.0.0"
  }
}
```

Or simply run the terminal command

```bash
composer require ilias/opherator
```

Then, run the following command to install the package:

```bash
composer install
```

## Usage

### Step 1: Setup The Handler

Create a file to define your routes, for example, in your project root folder, `routes.php`:

```php
<?php

use Ilias\Opherator\Request\Handler;

Handler::setup();
```

### Step 2: Use As Your Needs

The handler provides the next methods:

```php
class Handler
{
  public static function getMethod() : string;

  public static function getBody(): array;

  public static function getQuery(): array;

  public static function hasBody(): bool;
}
```

And the `Response` provides:

```php
class Response
{
  public static function setResponse(array $response): void;

  public static function appendResponse(string $key = "data", string|array $response, bool $override = true): void;

  public static function jsonResponse(): void;

  public static function htmlResponse(): void;

  public static function answer(): void;
}
```

## Explanations

* `::class`

  Is recommended to use the static reference to your class, so te code does know exactly which class to use
