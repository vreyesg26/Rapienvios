<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit37f01f0fdb84fc2a313d5f36a3012c01
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit37f01f0fdb84fc2a313d5f36a3012c01::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit37f01f0fdb84fc2a313d5f36a3012c01::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit37f01f0fdb84fc2a313d5f36a3012c01::$classMap;

        }, null, ClassLoader::class);
    }
}
