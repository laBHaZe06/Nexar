<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'server')]
class StartServerCommand extends Command
{
    protected static $defaultName = 'nexar:server';

    protected function configure()
    {
        $this
            ->setDescription('Start the Nexar server.')
            ->setHelp('This command starts the Nexar server.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Starting Nexar server...');
        exec('php -S localhost:8000 -t public');
        $output->writeln('Nexar server started!'); 

        return Command::SUCCESS;
    }
}