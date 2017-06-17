# laravel-agent

[![Latest Version on Packagist](https://img.shields.io/packagist/v/elfsundae/laravel-agent.svg?style=flat-square)](https://packagist.org/packages/elfsundae/laravel-agent)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/ElfSundae/laravel-agent/master.svg?style=flat-square)](https://travis-ci.org/ElfSundae/laravel-agent)
[![StyleCI](https://styleci.io/repos/94643252/shield)](https://styleci.io/repos/94643252)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/43b94cca-55cd-44ea-a8b3-43fe03171e99.svg?style=flat-square)](https://insight.sensiolabs.com/projects/43b94cca-55cd-44ea-a8b3-43fe03171e99)
[![Quality Score](https://img.shields.io/scrutinizer/g/ElfSundae/laravel-agent.svg?style=flat-square)](https://scrutinizer-ci.com/g/ElfSundae/laravel-agent)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/ElfSundae/laravel-agent/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/ElfSundae/laravel-agent/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/elfsundae/laravel-agent.svg?style=flat-square)](https://packagist.org/packages/elfsundae/laravel-agent)

## Installation

You can install this package via the [Composer](https://getcomposer.org) manager:

```sh
$ composer require elfsundae/laravel-agent
```

Then register the service provider by adding the following to the `providers` array in `config/app.php`:

```php
ElfSundae\Laravel\Agent\AgentServiceProvider::class,
```

## Testing

```sh
$ composer test
```

## License

This package is open-sourced software licensed under the [MIT License](LICENSE.md).
