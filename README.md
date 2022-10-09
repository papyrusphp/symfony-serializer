# 📜 Papyrus Serializer: Symfony implementation
[![Build Status](https://scrutinizer-ci.com/g/papyrusphp/symfony-serializer/badges/build.png?b=main)](https://github.com/papyrusphp/symfony-serializer/actions)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/papyrusphp/symfony-serializer.svg?style=flat)](https://scrutinizer-ci.com/g/papyrusphp/symfony-serializer/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/papyrusphp/symfony-serializer.svg?style=flat)](https://scrutinizer-ci.com/g/papyrusphp/symfony-serializer)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/papyrus/symfony-serializer.svg?style=flat&include_prereleases)](https://packagist.org/packages/papyrus/symfony-serializer)
[![PHP Version](https://img.shields.io/badge/php-%5E8.1-8892BF.svg?style=flat)](http://www.php.net)

Implementation of [papyrus/serializer](https://github.com/papyrusphp/serializer), based on [symfony/serializer](https://github.com/symfony/serializer).

### Installation
Install via composer:
```bash
$ composer install papyrus/symfony-serializer
```

## Configuration
Bind this implementation to the interface `Serializer` in your service definitions, e.g.:

A plain PHP PSR-11 Container definition:

```php
use Papyrus\Serializer\Serializer;
use Papyrus\SymfonySerializer\SymfonySerializer;
use Psr\Container\ContainerInterface;

return [
    // Other definitions
    // ...

    Serializer::class => static function (ContainerInterface $container): Serializer {
        return new SymfonySerializer(
            new Serializer(
                [
                    new DateTimeNormalizer([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d\TH:i:s.uP']),
                    new ObjectNormalizer(),
                ],
                [
                    new JsonEncoder(),
                ],
            ),
            JsonEncoder::FORMAT,
        ); 
    },
];
```
A Symfony YAML-file definition:
```yaml
services:
    Papyrus\Serializer\Serializer:
        class: Papyrus\SymfonySerializer\SymfonySerializer
```
