# WordPress Weather Dashboard Widget

WordPress Weather Dashboard Widget

## Table of Contents

* [Requirements](#requirements)
* [Installation](#installation)
* [Development](#development)
* [PHP Coding Standard (PHPCS)](#php-coding-standard)
* [Clean up code with PHPCBF](#clean-up-code-with-phpcbf)
* [PHP unit tests](#php-unit-tests)

## Requirements

Make sure all dependencies have been installed before moving on:

| Requirement | How to Check | How to Install |
| :---------- | :----------- | :------------- |
| PHP >= 7.4 | `php -v` | [php.net](http://php.net/manual/en/install.php) |
| Composer >= 2.1.6 | `composer --version` | [getcomposer.org](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) |

## 🧞 Installation

```
composer install --no-dev
```

## 👀 Development

```
composer install
```

## PHP Coding Standard

Custom PHPCS your can find in the `.phpcs.xml`.

Your can check PHPCS using a CLI:
```
composer cs
```

## Clean up code with PHPCBF

Automatically  fix  as  many sniff violations as possible.

Your can check PHPCBF using a CLI:
```
composer cs-fix
```

## PHP unit tests

For running use a CLI command:
```
composer unit
```

- Main configuration file `.tests/php/unit.suite.yml`
- Unit tests inside `.tests/php/unit/*` folder.
- Bootstrap file `.tests/php/unit/_bootstrap.php`
- Each filename for test class must have a suffix on `*Test.php`.
- Each test class must extend a `WeatherWidgetTests\TestCase` class.
- You can also add some code to `WeatherWidgetTests\TestCase.php`
- Each test method must have prefix `test_`
- Additional files for autoloading in tests running you can add to `.codeception/_support/*` folder.
