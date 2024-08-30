<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc36a1f6fd5a537240d1bfe87bfd59447
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\Team\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\Team\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Modules\\Team\\Config\\Setup' => __DIR__ . '/../..' . '/Config/Setup.php',
        'Modules\\Team\\Database\\Seeders\\TeamDatabaseSeeder' => __DIR__ . '/../..' . '/Database/Seeders/TeamDatabaseSeeder.php',
        'Modules\\Team\\Entities\\Team' => __DIR__ . '/../..' . '/Entities/Team.php',
        'Modules\\Team\\Http\\Controllers\\TeamController' => __DIR__ . '/../..' . '/Http/Controllers/TeamController.php',
        'Modules\\Team\\Http\\Requests\\CreateTeamValidation' => __DIR__ . '/../..' . '/Http/Requests/CreateTeamValidation.php',
        'Modules\\Team\\Providers\\RouteServiceProvider' => __DIR__ . '/../..' . '/Providers/RouteServiceProvider.php',
        'Modules\\Team\\Providers\\TeamServiceProvider' => __DIR__ . '/../..' . '/Providers/TeamServiceProvider.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc36a1f6fd5a537240d1bfe87bfd59447::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc36a1f6fd5a537240d1bfe87bfd59447::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc36a1f6fd5a537240d1bfe87bfd59447::$classMap;

        }, null, ClassLoader::class);
    }
}
