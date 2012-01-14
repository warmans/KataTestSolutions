#!/usr/bin/php
<?php
namespace Kata;

DEFINE('DS', '\\');
DEFINE('APPLICATION_PATH', realpath(dirname(__FILE__)));
DEFINE('RESOURCE', APPLICATION_PATH.DS.'Kata'.DS.'Resources'.DS);

require_once('Kata/Core/Loader.php');

$className = (!empty($argv[1])) ? $argv[1] : NULL;
$methodName = (!empty($argv[2])) ? $argv[2] : NULL;

$runner = new Core\Runner();
$runner->test($className, $methodName);