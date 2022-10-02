# WordPress Weather Dashboard Widget

WordPress Weather Dashboard Widget

## Table of Contents

* [Requirements](#requirements)
* [Installation](#installation)
* [Development](#development)
* [PHP Coding Standard (PHPCS)](#php-coding-standard)
* [Clean up code with PHPCBF](#clean-up-code-with-phpcbf)
* [PHP unit tests](#php-unit-tests)
* [Brief justification](#brief-justification)
* [Testing](#testing)
* [How long the test took to complete](#how-long-the-test-took-to-complete)

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

## Brief 

The key technical solutions are working with API from api.openweathermap.org and using a transient cache.

Also when running the plugin class

```
( new Plugin( new Api() ) )->init();
```

I am passing the API class as a parameter, so in the future, it will be possible to change the source of obtaining data to a class for obtaining data from a file, from a database, etc.

## Testing

Check situations

1. empty settings /wp-admin/options-general.php

2. wrong API key

3. wrong city name

4. check cache

5. validation of unit tests

```
composer unit
```

## How long the test took to complete

In total, it took me about 10 hours. This time includes preparing the project for deployment, writing unit tests
