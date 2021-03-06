# Rancor
![version](https://img.shields.io/github/v/release/andrykvp/rancor?color=orange) ![repo size](https://img.shields.io/github/repo-size/AndrykVP/Rancor) ![license](https://img.shields.io/github/license/AndrykVP/Rancor) ![activity](https://img.shields.io/github/last-commit/AndrykVP/Rancor) ![downloads](https://img.shields.io/packagist/dt/andrykvp/rancor)

Rancor is a [Laravel](http://www.laravel.com) package built for quickly scaffolding a project related to the MMORPG [Star Wars Combine](http://www.swcombine.com), and make use of common functionality required by factions and/or independent groups of this game. Such as:

- Generating server-side avatars and signatures using a given template
- Recording scan logs and browsing them in an expressive interface
- Consume web services provided by the game
- Forum boards that integrate with user information relevant to the game
- News articles released by the faction or group
- Managing faction data such as ranks, departments and sub-factions
- Kickstarting a dashboard/admin panel

## Getting Started
### Prerequisites

Before installing the Rancor package. Make sure that you meet the following requirements:

- PHP 7^
- Laravel 8^

### Dependencies

The following packages will be installed by Composer if they have not yet been installed:

- [HTMLPurifier](https://github.com/mewebstudio/Purifier)

### Installing

Installation is done through the [Composer](https://getcomposer.org/) dependency manager with the following command:

```bash
composer require andrykvp/rancor
```

Because of the development in Laravel 7, the package is auto-discovered and you do not need to register the Service Provider.

Backwards compatibility to previous versions of Laravel has not been tested and it is not recommended to use with previous versions of Laravel 7. However, if you wish to test it yourself, you may add the following lines of code at the end of your `config/app.php` file:

```php
AndrykVP\Rancor\Providers\PackageServiceProvider::class,
Mews\Purifier\PurifierServiceProvider::class,
```

### Configuring

After installation of the package, some configurations need to be set before you can make full use of its functionality. Such as:

- User API Authentication
- Implementing User Traits
- Running Migrations

For detailed instructions, visit the [Wiki](https://github.com/AndrykVP/Rancor/wiki). 

## Authors

* **Andrés Velázquez** - *Initial work* - [AndrykVP](https://github.com/AndrykVP)

See also the list of [contributors](https://github.com/AndrykVP/Rancor/graphs/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
