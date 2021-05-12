<?php

return [
	/*
	|--------------------------------------------------------------------------
	| Default Settings Store
	|--------------------------------------------------------------------------
	|
	| This option controls the default settings store that gets used while
	| using this settings library.
	|
	| Supported: "json", "database"
	|
	*/
	'store' => 'database',

	/*
	|--------------------------------------------------------------------------
	| JSON Store
	|--------------------------------------------------------------------------
	|
	| If the store is set to "json", settings are stored in the defined
	| file path in JSON format. Use full path to file.
	|
	*/
	'path' => storage_path() . '/settings.json',

	/*
	|--------------------------------------------------------------------------
	| Database Store
	|--------------------------------------------------------------------------
	|
	| The settings are stored in the defined file path in JSON format.
	| Use full path to JSON file.
	|
	*/

	// If set to null, the default connection will be used.
	'connection' => null,
	// Name of the table used.

	'table' => 'settings',
	// If you want to use custom column names in database store you could
	// set them in this configuration
	'keyColumn' => 'key',
	'valueColumn' => 'value',

    /*
    |--------------------------------------------------------------------------
    | Cache settings
    |--------------------------------------------------------------------------
    |
    | If you want all setting calls to go through Laravel's cache system.
    |
    */
	'enableCache' => true,
	// Whether to reset the cache when changing a setting.
	'forgetCacheByWrite' => true,
	// TTL in seconds.
	'cacheTtl' => 15,

    /*
    |--------------------------------------------------------------------------
    | Default Settings
    |--------------------------------------------------------------------------
    |
    | Define all default settings that will be used before any settings are set,
    | this avoids all settings being set to false to begin with and avoids
    | hardcoding the same defaults in all 'Settings::get()' calls
    |
    */
    'defaults' => [
		'site_name' => config('app.name'),
		'theme_active' => env('APP_THEME', 'default'),
		'site_logo' => null,
		'site_url' => '/',
		'main_menu' => 1,
		'app_lang' => config('app.locale'),
		'currency_code' => 'USD',

		'stripe_key' => config('services.stripe.key'),
		'stripe_secret' => config('services.stripe.secret'),
		'stripe_sandbox' => config('services.stripe.sandbox' ),

        'paypal_key' => config('services.paypal.client_id'),
        'paypal_secret' => config('services.paypal.secret'),
		'paypal_sandbox' => config('services.paypal.sandbox' ),

		'wompi_key' => config('services.wompi.client_id' ),
		'wompi_secret' => config('services.wompi.secret' ),
		'wompi_sandbox' => config('services.wompi.sandbox'),
    ]
];
