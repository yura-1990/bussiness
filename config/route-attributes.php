    <?php

return [
    /*
     *  Automatic registration of routes will only happen if this setting is `true`
     */
    'enabled' => true,

    /*
     * Controllers in these directories that have routing attributes
     * will automatically be registered.
     *
     * Optionally, you can specify group configuration by using key/values
     */
    'directories' => [
        app_path('Http/Controllers'),

        app_path('Http/Controllers/Web') => [
            'middleware' => ['web']
        ],

        app_path('Http/Controllers/Web/App') => [
            'middleware' => ['auth']
        ],

        app_path('Http/Controllers/Api') => [
            'prefix' => 'api',
            'middleware' => 'api'
        ],

        app_path('Http/Controllers/Api/App') => [
            'prefix' => 'api',
            'middleware' => 'auth:api'
        ],
    ],

    /**
     * This middleware will be applied to all routes.
     */
    'middleware' => [
        \Illuminate\Routing\Middleware\SubstituteBindings::class
    ]
];
