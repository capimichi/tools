<?php

namespace CapimichiTools\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TestCommand extends Command
{


    protected function configure()
    {
        $this
            ->setName('test')
            ->setDescription('Update tools')
            ->setHelp('Update to the latest version');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $console = new SymfonyStyle($input, $output);

        $console->writeln('Test...');
    }
}