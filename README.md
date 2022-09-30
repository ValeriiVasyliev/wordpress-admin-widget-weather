# WordPress skeleton

A skeleton WordPress project to be used as a base for new WordPress projects. 

## Table of Contents

* [Sites](#sites)
* [Requirements](#requirements)
* [Installation](#installation)
* [Structure](#structure)
* [Deployment](#deployment)
* [Frontend](#frontend)
* [PHP Coding Standard (PHPCS)](#php-coding-standard)
* [Clean up code with PHPCBF](#clean-up-code-with-phpcbf)
* [PHP unit tests](#php-unit-tests)

## Sites

| Environments | Sites                   |
| ------------ | ----------------------- |
| Development  | # |
| Stage  | # |
| Production   | # |

## Requirements

Make sure all dependencies have been installed before moving on:

| Requirement | How to Check | How to Install |
| :---------- | :----------- | :------------- |
| PHP >= 7.4 | `php -v` | [php.net](http://php.net/manual/en/install.php) |
| [WordPress >= 5.9]() | `Admin Footer` | [wordpress.org](https://codex.wordpress.org/Installing_WordPress) |
| Composer >= 2.1.6 | `composer --version` | [getcomposer.org](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) |
| Deployer >= 6.x | `dep -v` | [deployer.org](https://deployer.org/deployer.phar) |
| WP CLI >= 2.4.0 | `wp --info` | [githubusercontent.com](https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar) |

## 🧞 Installation

```
git clone git@github.com:ValeriiVasyliev/wordpress-admin-widget-weather.git
cd wordpress-admin-widget-weather
composer init-project
```

## 🚀 Structure

```
 .github/                                                     # → GitHub additional directories.
└── pull_request_template.md                                  # → template for pull request
└── workflows/                                                # → Workflows.
    ├── deploy.yml                                            # → Actions for deployment
wp-content/plugins/valerii-vasyliev-weather-widget/           # → WordPress Weather Dashboard Widget
.gitignore                                                    # → Git ignore file.
composer.json                                                 # → Composer dependencies and scripts.
README.md                                                     # → Readme MD for repository.
wp-cli.yml                                                    # → Config file for wp-cli
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
- Each test class must extend a `PluginNameUnitTests\TestCase` class.
- You can also add some code to `PluginNameUnitTests\TestCase.php`
- Each test method must have prefix `test_`
- Additional files for autoloading in tests running you can add to `.codeception/_support/*` folder.

## Monolog

Monolog-based logging package for WordPress.

Need to add a line to wp-config.php

````
require_once(ABSPATH . '/vendor/autoload.php'); 
````