# Response Time Middleware for PHP

This middleware adds a Response Time header

## Usage

Just add the middleware as one of the first in your application.

For example:
```php
$app->pipe(new \LosMiddleware\ResponseTime\ResponseTime($options);
```

And the middleware will add a header
```
X-Request-Time: 49,96ms
```

The options are:
* header_name: Header name. Default: X-Response-Time 

<<<<<<< HEAD
### Laminas

If you are using [Laminas](https://github.com/laminas/laminas-skeleton), 
=======
### Mezzio

If you are using [mezzio-skeleton](https://github.com/mezzio/mezzio-skeleton), 
>>>>>>> origin/2.2.x
you can copy `config/los-response-time.global.php.dist` to 
`config/autoload/los-response-time.global.php` and modify configuration as your needs.
