# WordPress Weather Dashboard Widget

WordPress Weather Dashboard Widget

## Table of Contents

* [Sites](#sites)
* [Requirements](#requirements)
* [Installation](#installation)
* [Structure](#structure)

## Sites

| Environments | Sites                   |
| ------------ | ----------------------- |
| Production   | https://test.gratta.pro/ |

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