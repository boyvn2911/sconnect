# Laravel SConnect Util

SConnect Integration with Laravel

## Table of Contents

1.  [Installation](#installation)
2.  [Configuration](#configuration)
3.  [Custom Models](#custom-models)
    
## Installation

Execute the following command to get the latest version of the package:

```terminal
composer require sonleu/sconnect
``` 

## Configuration

Add these inside of .env

```.env
S_CONNECT_URL=<SCONNECT_BASE_API_URL>
S_CONNECT_API_KEY=<SCONNECT_API_KEY>
```

Publish configs

```terminal
php artisan vendor:publish --tag=s_connect_config
```

## Custom models

By default, packages' models will be returned in api responses.

In case you want to customize the models, change the namespaces inside config.s_connect.models. For example:

```php
// config/s_connect.php

return [
    /*
    |--------------------------------------------------------------------------
    | Custom models
    |--------------------------------------------------------------------------
    | Your models to which SConnect data should be returned.
    |
    | Your own models should extends the base models.
    |
    */
    'models' => [
        'user' => \App\User::class,
        'position' => '\SonLeu\SConnect\Models\Position',
        'department' => '\SonLeu\SConnect\Models\Department', 
    ]
];
```
