# Config

Lightweight config support [Phico](https://github.com/phico-php/phico)

## Installation

Using composer

```sh
composer require phico/config
```

## Usage

Create a config file

```php
// /config/apis.php

return [
    'example' => [
        'url' => 'https://api.example.com',
        'secret' => 'top-secret'
    ]
];
```

Fetch a defined value

```php
echo config('apis.example.secret');
//  top-secret
```

Return a default value if the config is missing

```php
echo config('apis.example.missing', 'abc-123');
//  abc-123
```

## Issues

Config is considered feature complete, however if you discover any bugs or issues in it's behaviour or performance please create an issue, and if you are able a pull request with a fix.

Please make sure to update tests as appropriate.

For major changes, please open an issue first to discuss what you would like to change.

## License

[BSD-3-Clause](https://choosealicense.com/licenses/bsd-3-clause/)
