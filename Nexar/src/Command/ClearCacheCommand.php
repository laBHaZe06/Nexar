<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'cache:clear')]
class ClearCacheCommand extends Command
{
    protected static $defaultName = 'cache:clear';

    protected function configure()
    {
        $this
            ->setDescription('Clear the application cache')
            ->setHelp('This command allows you to clear the cache...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $cacheDir = __DIR__ . '/../../var/cache';
        
        $this->clearDirectory($cacheDir);
        
        $output->writeln('Cache cleared successfully!');
        
        return Command::SUCCESS;
    }

    private function clearDirectory($dir)
    {
        if (!is_dir($dir)) {
            return;
        }

        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            $path = "$dir/$file";
            if (is_dir($path)) {
                $this->clearDirectory($path);
                rmdir($path);
            } else {
                unlink($path);
            }
        }
    }
}