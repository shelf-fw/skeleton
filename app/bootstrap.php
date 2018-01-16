<?php

use Zend\Config\Factory;
use Zend\ServiceManager\ServiceManager;

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
// Modules Settings
$modulesConfig = Factory::fromFiles(glob('app/code/*/*/etc/*.*'), true);
// Global Settings
$globalConfig = Factory::fromFiles(glob('app/etc/*.*'), true);
$configMerged = $modulesConfig->merge($globalConfig)->toArray();
$serviceManager = new ServiceManager();
$serviceManager->configure($configMerged['dependencies']);
$serviceManager->setService('config', $configMerged);

return $serviceManager;