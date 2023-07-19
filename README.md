# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/innoboxrr/twilio-sdk.svg?style=flat-square)](https://packagist.org/packages/innoboxrr/twilio-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/innoboxrr/twilio-sdk.svg?style=flat-square)](https://packagist.org/packages/innoboxrr/twilio-sdk)
![GitHub Actions](https://github.com/innoboxrr/twilio-sdk/actions/workflows/main.yml/badge.svg)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require innoboxrr/twilio-sdk
```

## Usage

### SMS or WhatsApp message 
```php
$sid = 'AC28xxxxxxxxxxxxxxxxxxxxxxxxxx6ff';

$token = '82694xxxxxxxxxxxxxxxxxxxxxxxxd7df5';

$nombreTienda = "Sra. Nancy Guadalupe";

$fechaVisita = '3 de junio de 2023 a las 14:00';

$urlReseña = "https://innoboxrr.com/review?code=16815159";

$from = '120xxxxxxx9';

$to = '527xxxxxxx9';

$message = <<<EOL
Su Código de confirmación es 1524568
EOL;

$res = Sms::init(['sid' => $sid, 'token' => $token])
    ->from($from)
    ->to($to)
    ->message($message)
    ->sendMessage();

$res = Whatsapp::init(['sid' => $sid, 'token' => $token])
    ->from($from)
    ->to($to)
    ->message($message)
    ->sendMessage();

dd($res);
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email dev@innobox.systmes instead of using the issue tracker.

## Credits

-   [Homero Raul Vargas Cruz](https://github.com/innoboxrr)
-   [All Contributors](../../contributors)

## License

The The Unlicense. Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
