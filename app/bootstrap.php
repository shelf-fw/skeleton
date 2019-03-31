<?php

use Shelf\Config\ConfigFactoryAdapter as ShelfConfigFactory;
use Zend\ServiceManager\ServiceManager;

define('BP', dirname(__DIR__));

/* PHP version validation */
if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 70000) {
    if (PHP_SAPI == 'cli') {
        echo 'This app supports PHP 7 or later. ';
    } else {
        echo <<<HTML
<div style="font:12px/1.35em arial, helvetica, sans-serif;">
    <p>This app supports PHP 7 or later.</p>
</div>
HTML;
    }
    exit(1);
}

// Setup/verify autoloading
if (file_exists($a = __DIR__ . '/../../../autoload.php')) {
    require $a;
} elseif (file_exists($a = __DIR__ . '/../vendor/autoload.php')) {
    require $a;
} elseif (file_exists($a = __DIR__ . '/../autoload.php')) {
    require $a;
} else {
    fwrite(STDERR, 'Cannot locate autoloader; please run "composer install"' . PHP_EOL);
    exit(1);
}

$config = ShelfConfigFactory::getConfig()->toArray();

$serviceManager = new ServiceManager();

if (isset($config['dependencies'])) {
    $serviceManager->configure($config['dependencies']);
}

$serviceManager->setService('config', $config);

return $serviceManager;