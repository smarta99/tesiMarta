<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcb49d86373e50f8212142f47afae5df0
{
    public static $files = array (
        '9c67151ae59aff4788964ce8eb2a0f43' => __DIR__ . '/..' . '/clue/stream-filter/src/functions_include.php',
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
        '8cff32064859f4559445b89279f3199c' => __DIR__ . '/..' . '/php-http/message/src/filters.php',
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Symfony\\Component\\OptionsResolver\\' => 34,
        ),
        'P' => 
        array (
            'Psr\\SimpleCache\\' => 16,
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
        ),
        'N' => 
        array (
            'Nyholm\\Psr7\\' => 12,
            'Nyholm\\Psr7Server\\' => 18,
        ),
        'L' => 
        array (
            'Laudis\\TypedEnum\\' => 17,
            'Laudis\\Neo4j\\' => 13,
        ),
        'H' => 
        array (
            'Http\\Promise\\' => 13,
            'Http\\Message\\' => 13,
            'Http\\Discovery\\' => 15,
            'Http\\Client\\' => 12,
        ),
        'C' => 
        array (
            'Clue\\StreamFilter\\' => 18,
        ),
        'B' => 
        array (
            'Buzz\\' => 5,
            'Bolt\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Symfony\\Component\\OptionsResolver\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/options-resolver',
        ),
        'Psr\\SimpleCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/simple-cache/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-factory/src',
            1 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-client/src',
        ),
        'Nyholm\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/nyholm/psr7/src',
        ),
        'Nyholm\\Psr7Server\\' => 
        array (
            0 => __DIR__ . '/..' . '/nyholm/psr7-server/src',
        ),
        'Laudis\\TypedEnum\\' => 
        array (
            0 => __DIR__ . '/..' . '/laudis/typed-enum/src',
        ),
        'Laudis\\Neo4j\\' => 
        array (
            0 => __DIR__ . '/..' . '/laudis/neo4j-php-client/src',
        ),
        'Http\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-http/promise/src',
        ),
        'Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-http/message/src',
            1 => __DIR__ . '/..' . '/php-http/message-factory/src',
        ),
        'Http\\Discovery\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-http/discovery/src',
        ),
        'Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-http/httplug/src',
        ),
        'Clue\\StreamFilter\\' => 
        array (
            0 => __DIR__ . '/..' . '/clue/stream-filter/src',
        ),
        'Buzz\\' => 
        array (
            0 => __DIR__ . '/..' . '/kriswallsmith/buzz/lib',
        ),
        'Bolt\\' => 
        array (
            0 => __DIR__ . '/..' . '/stefanak-michal/bolt/src',
        ),
    );

    public static $classMap = array (
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PhpToken' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcb49d86373e50f8212142f47afae5df0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcb49d86373e50f8212142f47afae5df0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcb49d86373e50f8212142f47afae5df0::$classMap;

        }, null, ClassLoader::class);
    }
}
