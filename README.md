# Agent

[![Latest Version on Packagist](https://img.shields.io/packagist/v/elfsundae/agent.svg?style=flat-square)](https://packagist.org/packages/elfsundae/agent)
[![Build Status](https://img.shields.io/travis/ElfSundae/agent/master.svg?style=flat-square)](https://travis-ci.org/ElfSundae/agent)
[![StyleCI](https://styleci.io/repos/94643252/shield)](https://styleci.io/repos/94643252)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/43b94cca-55cd-44ea-a8b3-43fe03171e99.svg?style=flat-square)](https://insight.sensiolabs.com/projects/43b94cca-55cd-44ea-a8b3-43fe03171e99)
[![Quality Score](https://img.shields.io/scrutinizer/g/ElfSundae/agent.svg?style=flat-square)](https://scrutinizer-ci.com/g/ElfSundae/agent)

A PHP mobile/desktop User-Agent parser, with support for Laravel, based on [`jenssegers/agent`](https://github.com/jenssegers/agent) which based on the [Mobile Detect](https://github.com/serbanghita/Mobile-Detect).

## Installation

```sh
$ composer require elfsundae/agent
```

## Laravel (Optional)

If your application runs on Lumen, or on earlier Laravel than v5.5 which does not support [package discovery](https://laravel.com/docs/5.5/packages#package-discovery), you need to register the service provider manually:

```php
ElfSundae\Agent\AgentServiceProvider::class,
```

And add the `Agent` facade alias:

```php
'Agent' => ElfSundae\Agent\Facades\Agent::class,
```

## Additional Methods

## License

This package is open-sourced software licensed under the [MIT License](LICENSE.md).
