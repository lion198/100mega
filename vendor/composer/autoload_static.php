<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4cb74d86baa0f789ef43d61fc039c144
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit4cb74d86baa0f789ef43d61fc039c144::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4cb74d86baa0f789ef43d61fc039c144::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4cb74d86baa0f789ef43d61fc039c144::$classMap;

        }, null, ClassLoader::class);
    }
}
