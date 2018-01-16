<?php

use Devcommits\Shelf\Factory\ConfigResolverFactory;
use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;
use Devcommits\Shelf\Api\ShelfApplicationInterface as AppInterface;

return [
    AppInterface::SHELF_APPLICATION_KEY => [
        AppInterface::COMMANDS_KEY => [
            //Devcommits\App\Command\testCommand::class
        ]
    ],
    AppInterface::CONTAINER_CONFIG_KEY => [
        'abstract_factories' => [
            ReflectionBasedAbstractFactory::class
        ],
        'factories' => [
            AppInterface::SHELF_APPLICATION_KEY => ConfigResolverFactory::class,
            //Devcommits\App\Command\testCommand::class => ReflectionBasedAbstractFactory::class
        ]
    ]
];