<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2aa81088f2917c34e131d918b4bea540
{
    public static $files = array (
        '8b3f8a3ae8e6735c5c18ca84e978b632' => __DIR__ . '/..' . '/rawr/t-regx/helper/helper.php',
        '55f583827cf6fd6711007159a002bff6' => __DIR__ . '/..' . '/rawr/t-regx/test/DataProviders.php',
        '43ebb3deeb9afd982e453a85e2049105' => __DIR__ . '/..' . '/rawr/t-regx/test/Warnings.php',
        '80869277fa6780f754a32adfe46dd3e4' => __DIR__ . '/..' . '/rawr/t-regx/test/ClassWithToString.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Cache\\' => 10,
        ),
        'M' => 
        array (
            'MatthiasMullie\\PathConverter\\' => 29,
            'MatthiasMullie\\Minify\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/cache/src',
        ),
        'MatthiasMullie\\PathConverter\\' => 
        array (
            0 => __DIR__ . '/..' . '/matthiasmullie/path-converter/src',
        ),
        'MatthiasMullie\\Minify\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
            1 => __DIR__ . '/..' . '/matthiasmullie/minify/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'SafeRegex\\Test\\' => 
            array (
                0 => __DIR__ . '/..' . '/rawr/t-regx/test',
            ),
            'SafeRegex\\' => 
            array (
                0 => __DIR__ . '/..' . '/rawr/t-regx/src',
            ),
        ),
        'C' => 
        array (
            'CleanRegex\\Test\\' => 
            array (
                0 => __DIR__ . '/..' . '/rawr/t-regx/test',
            ),
            'CleanRegex\\' => 
            array (
                0 => __DIR__ . '/..' . '/rawr/t-regx/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2aa81088f2917c34e131d918b4bea540::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2aa81088f2917c34e131d918b4bea540::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit2aa81088f2917c34e131d918b4bea540::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
