<?php
namespace Devcommits\Shelf\Command;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class testCommand extends SymfonyCommand
{
    private $config;

    public function __construct($name = null, array $config)
    {
        // Example inject config
        $this->config = $config;
        parent::__construct($name);
    }

    protected function configure()
    {
        parent::configure();
        $this
            ->setName('print:config')
            ->setDescription('description')
            ->setHelp('help');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        print_r($this->config);
    }
}
