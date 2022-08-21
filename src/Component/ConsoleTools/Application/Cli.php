<?php
/**
 * author Ayuna Sereneva <avsereneva@gmail.com>
 */

namespace Ayunoss\Cli\Component\ConsoleTools\Application;

use Ayunoss\Cli\Component\ConsoleTools\Entity;

class Cli extends AbstractApplication {

    public function run(): void {
        $commandName = $this->_getCommandName();

        $result = null;
        if (array_key_exists($commandName, $this->_commandsByName)) {
            $requestParams = $this->_parseParams();
            if ($requestParams->isCommandHelpInfoRequired()) {
                $this->_showResult($this->_getHelpInfoForCommand($this->_commandsByName[$commandName]));
                return;
            }
            $result = $this->_runCommand($this->_commandsByName[$commandName], $requestParams);
        } else {
            $result = $this->_getHelpInfo("Command '{$commandName}' not found");
        }
        $this->_showResult($result);
    }

    private function _getCommandName(): ?string {
        global $argv;
        return array_key_exists(1, $argv) ? $argv[1] : null;
    }

    private function _parseParams(): Entity\Request {
        global $argv;
        $options = $argv;
        // remove script path and command name
        unset($options[0], $options[1]);
        $options = array_values($options);
        return $this->_argvParser->parse($options);
    }

    private function _getHelpInfoForCommand(Entity\AbstractCommand $command): string {
        return "Command name: {$command->getName()}\nDescription: {$command->getDescription()}\n";
    }

    private function _getHelpInfo(string $errorMessage): string {
        $result = "{$errorMessage}\n\n";
        if (count($this->_commandsByName) > 0) {
            $result .= "Allowed commands list:\n";
        }
        foreach ($this->_commandsByName as $command) {
            $result .= $this->_getHelpInfoForCommand($command);
        }
        return $result;
    }

    private function _showResult(string $output): void {
        echo $output;
    }
}