#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;


$application = new Application();

$applicationsDirectory = __DIR__ . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "Command" . DIRECTORY_SEPARATOR;

$files = array_diff(scandir($applicationsDirectory), array('..', '.'));

foreach ($files as $file) {

    $className = "\\CapimichiTools\\Command\\" . str_replace(".php", "", $file);

    $application->add(new $className());
}

$application->run();