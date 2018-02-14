<?php

use Shelf\Config\ConfigFactoryAdapter as ShelfConfigFactory;
use Zend\ServiceManager\ServiceManager;

const BP = __DIR__ . '/../';

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
$serviceManager->configure($config['dependencies']);
$serviceManager->setService('config', $config);

return $serviceManager;