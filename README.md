Laravel Elephant IO
===================

This is a service provider for the Laravel PHP Framework, it provides access to socket.io via ElephantIO. [http://elephant.io](http://elephant.io)

### Installation

- [API on Packagist](https://packagist.org/packages/moura137/laravel-elephantio)
- [API on GitHub](https://github.com/moura137/LaravelElephantIO)

In the `require` key of `composer.json` file add the following

    "moura137/laravel-elephantio": "dev-master"

Run the Composer update comand

    $ composer update

In your `config/app.php` add `'LaravelElephant\ElephantServiceProvider'` to the end of the `$providers`Erray

```php
'providers' => array(

    'Illuminate\Foundation\Providers\ArtisanServiceProvider',
    'Illuminate\Auth\AuthServiceProvider',
    ...
    'LaravelElephant\ElephantServiceProvider',

),
```

At the end of `config/app.php` add `'Elephant'    => 'LaravelElephant\ElephantFacade'` to the `$aliases` array

```php
'aliases' => array(

    'App'        => 'Illuminate\Support\Facades\App',
    'Artisan'    => 'Illuminate\Support\Facades\Artisan',
    ...
    'Elephant'    => 'LaravelElephant\ElephantFacade',

),
```

### Configuration

Publish config using artisan CLI.

~~~
php artisan config:publish moura137/laravel-elephantio
~~~

### Usage
```php
Elephant::emit('eventMsg', array('foo' => 'bar'));
```