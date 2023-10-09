<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcf52d6a9e8a4ff25f260114868166ab3
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
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcf52d6a9e8a4ff25f260114868166ab3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcf52d6a9e8a4ff25f260114868166ab3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcf52d6a9e8a4ff25f260114868166ab3::$classMap;

        }, null, ClassLoader::class);
    }
}