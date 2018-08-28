# Mdc Sign On

Our internal single signon package for Laravel applications

## Installation

Install via composer
```
composer require daltcore/mdc-sign-on
```

### Register Service Provider

**Note! This and next step are optional if you use laravel>=5.5 with package
auto discovery feature.**

Add service provider to `config/app.php` in `providers` section
```php
DALTCORE\MdcSignOn\ServiceProvider::class,
```

### Publish Configuration File

```
php artisan vendor:publish --provider="DALTCORE\MdcSignOn\ServiceProvider" --tag="config"
```

## Usage

### Adding token to package
Add your `app_token` to the config file thats provided by the IT department in `config/mdc-sign-on.php`
```php
<?php

return [
    'url' => 'https://mdc.dev',
    'app_token' => 'bc1efbc9-3d2f-4e97-956b-1c6d7c6ab7a3',
];
```

### Adding middleware to 'web' middleware



## Security

If you discover any security related issues, please email 
instead of using the issue tracker.

## Credits

- [](https://github.com/DALTCORE/MdcSignOn)
- [All contributors](https://github.com/DALTCORE/MdcSignOn/graphs/contributors)
