<?php

namespace CapimichiTools\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class WpCoreInstallCommand extends Command
{
    const WORDPRESS_URL = "https://wordpress.org/latest.zip";

    protected function configure()
    {
        $this
            ->setName('wp:core:install')
            ->setDescription('Install wordpress')
            ->setHelp('')
            ->addOption('project', 'p', InputOption::VALUE_REQUIRED, 'Project path');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $projectPath = rtrim($input->getOption('project') ? $input->getOption('project') : $io->ask('Proect path'), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

        $wpZipFile = $projectPath . "wp.zip";

        file_put_contents($wpZipFile, file_get_contents(self::WORDPRESS_URL));

        $zip = new \ZipArchive();

        $res = $zip->open($wpZipFile);
        if ($res === TRUE) {
            $zip->extractTo($projectPath);
            $zip->close();

            $io->writeln("WP DOWNLOADED");
        } else {
            $io->error("CANNOT EXTRACT WP");
        }

        unlink($wpZipFile);


    }
}