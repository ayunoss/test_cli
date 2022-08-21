<?php
/**
 * author Ayuna Sereneva <avsereneva@gmail.com>
 */

use Ayunoss\Cli\Component\ConsoleTools\Application\Cli;
use Ayunoss\Cli\DevOps\Commands;

require_once __DIR__."/../vendor/autoload.php";

$app = new Cli();
$app->addCommand(new Commands\TestCommand());

$app->run();
