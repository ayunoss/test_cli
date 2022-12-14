<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6d1100ec15ea33c1bd438c233c00bf0b
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Ayunoss\\Cli\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ayunoss\\Cli\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6d1100ec15ea33c1bd438c233c00bf0b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6d1100ec15ea33c1bd438c233c00bf0b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6d1100ec15ea33c1bd438c233c00bf0b::$classMap;

        }, null, ClassLoader::class);
    }
}
