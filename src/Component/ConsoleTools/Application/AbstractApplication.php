<?php
/**
 * author Ayuna Sereneva <avsereneva@gmail.com>
 */

namespace Ayunoss\Cli\Component\ConsoleTools\Application;

use Ayunoss\Cli\Component\ConsoleTools\Entity;
use Ayunoss\Cli\Core\ServiceLocator;
use Ayunoss\Cli\Service;
use Ayunoss\Cli\Exception;

abstract class AbstractApplication {

    /** @var Entity\AbstractCommand[] */
    protected array $_commandsByName = [];

    protected Service\ArgvParserService $_argvParser;

    protected Service\LoggerService $_logger;

    public function __construct() {
        $this->_argvParser = ServiceLocator::argvParserService();
        $this->_logger     = ServiceLocator::loggerService();
    }

    public function addCommand(Entity\AbstractCommand $command): void {
        $this->_validateCommand($command);
        $this->_commandsByName[$command->getName()] = $command;
    }

    final protected function _runCommand(Entity\AbstractCommand $command, Entity\Request $requestParams): string {
        try {
            $result = $command->_run($requestParams);
        } catch (Exception\BadUsage $e) {
            $result = $e->getMessage();
        } catch (\Throwable $t) {
            $result = $this->_logger->logThrowable($t);
        }
        return $result;
    }

    /**
     * @param Entity\AbstractCommand $command
     * @throws Exception\BadUsage
     */
    private function _validateCommand(Entity\AbstractCommand $command): void {
        $commandName = $command->getName();
        if (!preg_match('/^[a-z_]+$/', $commandName)) {
            throw new Exception\BadUsage("Incorrect command name: {$commandName}");
        }
        if (array_key_exists($commandName, $this->_commandsByName)) {
            throw new Exception\BadUsage("Command '{$commandName}' is already added. Command name must be unique");
        }
    }
}