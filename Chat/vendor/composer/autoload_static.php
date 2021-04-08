<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit26f3d495e759decc8f6a593e618a64a9
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit26f3d495e759decc8f6a593e618a64a9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit26f3d495e759decc8f6a593e618a64a9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit26f3d495e759decc8f6a593e618a64a9::$classMap;

        }, null, ClassLoader::class);
    }
}
