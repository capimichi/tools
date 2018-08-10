<?php

namespace CapimichiTools\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCommand extends Command
{


    protected function configure()
    {
        $this
            ->setName('update')
            ->setDescription('Update tools')
            ->setHelp('Update to the latest version');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Ciao");
    }
}