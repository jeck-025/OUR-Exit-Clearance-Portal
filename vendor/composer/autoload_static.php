<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0904dd4dc71c033bf5aa668ad21748ed
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit0904dd4dc71c033bf5aa668ad21748ed::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0904dd4dc71c033bf5aa668ad21748ed::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0904dd4dc71c033bf5aa668ad21748ed::$classMap;

        }, null, ClassLoader::class);
    }
}
