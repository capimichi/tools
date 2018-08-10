<?php

namespace CapimichiTools\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

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
        $console = new SymfonyStyle($input, $output);

        $console->writeln('Checking version...');

        $latestVersion = file_get_contents("https://raw.githubusercontent.com/capimichi/tools/master/dist/version.txt");
        $console->writeln($this->getApplication()->getVersion());
    }
}