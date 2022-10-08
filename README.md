# 📜 Papyrus Serializer: Symfony implementation
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
