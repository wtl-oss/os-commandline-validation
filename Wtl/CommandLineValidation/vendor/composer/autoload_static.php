<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit37d17999df78bd22bb513f0ee27ebd2a
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Wtl\\CommandLineValidation\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Wtl\\CommandLineValidation\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit37d17999df78bd22bb513f0ee27ebd2a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit37d17999df78bd22bb513f0ee27ebd2a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit37d17999df78bd22bb513f0ee27ebd2a::$classMap;

        }, null, ClassLoader::class);
    }
}
