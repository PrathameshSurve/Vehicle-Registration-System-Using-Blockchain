<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd47e0b5d240d08d620bd303c945882ca
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd47e0b5d240d08d620bd303c945882ca::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd47e0b5d240d08d620bd303c945882ca::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd47e0b5d240d08d620bd303c945882ca::$classMap;

        }, null, ClassLoader::class);
    }
}