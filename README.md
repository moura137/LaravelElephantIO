Laravel Elephant IO
===================

[![Build Status](https://travis-ci.org/moura137/LaravelElephantIO.svg?branch=master)](https://travis-ci.org/moura137/LaravelElephantIO)
[![Coverage Status](https://coveralls.io/repos/moura137/LaravelElephantIO/badge.png?branch=master)](https://coveralls.io/r/moura137/LaravelElephantIO?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/moura137/LaravelElephantIO/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/moura137/LaravelElephantIO/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/2eeba11e-5120-4f35-b80e-970798ed3a43/mini.png)](https://insight.sensiolabs.com/projects/2eeba11e-5120-4f35-b80e-970798ed3a43)

This is a service provider for the Laravel PHP Framework, it provides access to socket.io via ElephantIO. [http://elephant.io](http://elephant.io)

### Installation

- [API on Packagist](https://packagist.org/packages/moura137/laravel-elephantio)
- [API on GitHub](https://github.com/moura137/LaravelElephantIO)

In the `require` key of `composer.json` file add the following

    "moura137/laravel-elephantio": "~0.1"

Run the Composer update comand

    $ composer update

In your `config/app.php` add `'Moura137\LaravelElephant\ElephantServiceProvider'` to the end of the `$providers` array

```php
'providers' => array(

    'Illuminate\Foundation\Providers\ArtisanServiceProvider',
    'Illuminate\Auth\AuthServiceProvider',
    ...
    'Moura137\LaravelElephant\ElephantServiceProvider',

),
```

At the end of `config/app.php` add `'Elephant'    => 'Moura137\LaravelElephant\ElephantFacade'` to the `$aliases` array

```php
'aliases' => array(

    'App'        => 'Illuminate\Support\Facades\App',
    'Artisan'    => 'Illuminate\Support\Facades\Artisan',
    ...
    'Elephant'    => 'Moura137\LaravelElephant\ElephantFacade',

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
