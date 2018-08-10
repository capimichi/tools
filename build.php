<?php

ini_set("phar.readonly", 0);


$version = $argv[1];

$versionDirectory = __DIR__ . DIRECTORY_SEPARATOR . "dist" . DIRECTORY_SEPARATOR . $version . DIRECTORY_SEPARATOR;

if (!file_exists($versionDirectory)) {
    mkdir($versionDirectory, 0755, true);
}

$tempDistDirectory = sys_get_temp_dir() . DIRECTORY_SEPARATOR . "capimichitools" . DIRECTORY_SEPARATOR . $version . DIRECTORY_SEPARATOR;

if (!file_exists($tempDistDirectory)) {
    mkdir($tempDistDirectory, 0755, true);
}

copy(__DIR__ . DIRECTORY_SEPARATOR . "cmd.php", $tempDistDirectory . DIRECTORY_SEPARATOR . "cmd.php");
recurse_copy(__DIR__ . DIRECTORY_SEPARATOR . "vendor", $tempDistDirectory . DIRECTORY_SEPARATOR . "vendor");
recurse_copy(__DIR__ . DIRECTORY_SEPARATOR . "src", $tempDistDirectory . DIRECTORY_SEPARATOR . "src");

$pharFile = $versionDirectory . "cmtools.phar";
if (file_exists($pharFile)) {
    unlink($pharFile);
}
$p = new Phar($pharFile);
$p->buildFromDirectory($tempDistDirectory);
$p->setDefaultStub('cmd.php');
$p->compress(Phar::GZ);


function recurse_copy($src, $dst)
{
    $dir = opendir($src);
    @mkdir($dst);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                recurse_copy($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}