# PSR-15 interfaced wrapper for callable middleware

[![Build Status](http://img.shields.io/travis/madewithlove/psr15-bridge.svg?style=flat-square)](https://travis-ci.org/madewithlove/psr15-bridge)

## Installation

```bash
composer require madewithlove/psr15-bridge
```

## Usage

Wrap existing callable (double pass) PSR-7 middlewares in a PSR-15 middleware:

```php
$middleware = new Middleware($callableMiddleware, new Response());
```

And use the resulting middleware objects in a PSR-15 stack.

## Testing

After cloning this project, install its dependencies and run the test suite:

```bash
composer install
vendor/bin/phpunit
```

## License

[MIT](LICENSE)
