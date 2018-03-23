# TextConveyor

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

The TextConveyor takes your text, whatever size, and runs it through a list of formatters that is defined by you.

## Installation

Via Composer

``` bash
$ composer require jeroen-g/textconveyor
```

In case you're using Laravel, a service provider and facade get registered automatically.

## Usage

```php
$assembler = new JeroenG\TextConveyor\Assembler;
$assembler->setFormatters([App\RemoveBadWords::class, App\LowercaseNames::class]);
$assembler->addFormatter(App\CapitalizeNames::class);
$assembler->removeFormatter(App\LowercaseNames::class);
$formattedText = $assembler->sendContentThroughFormatters($content);
```

This is how it could be used in an Eloquent model:
```php
public function setBodyAttribute($body)
{
    $this->attributes['body'] = app(JeroenG\TextConveyor\Assembler::class)->sendContentThroughFormatters($body);
}
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/jeroen-g/textconveyor.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/jeroen-g/textconveyor/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/125524541/shield

[link-packagist]: https://packagist.org/packages/jeroen-g/textconveyor
[link-downloads]: https://packagist.org/packages/jeroen-g/textconveyor
[link-travis]: https://travis-ci.org/Jeroen-G/TextConveyor
[link-styleci]: https://styleci.io/repos/125524541
[link-author]: https://github.com/jeroen-g
[link-contributors]: ../../contributors]