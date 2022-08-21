<?php
/**
 * author Ayuna Sereneva <avsereneva@gmail.com>
 */

namespace Ayunoss\Cli\DevOps\Commands;

use Ayunoss\Cli\Component\ConsoleTools\Entity;

class TestCommand extends Entity\AbstractCommand {

    public function getDescription(): string {
        return 'The command allows you to display the passed arguments and params in a human-readable form.';
    }

    public function _run(Entity\Request $request): string {
        $commandName = $this->getName();

        $output = "Called command: {$commandName}\n";

        $argumentsForOutput = $request->arguments();
        if (count($argumentsForOutput) > 0) {
            $output .= "\n";
            $output .= $this->_prepareArgumentsForOutput($argumentsForOutput);
        }

        $optionsForOutput = $request->options();
        if (count($optionsForOutput) > 0) {
            $output .= "\n";
            $output .= $this->_prepareOptionsForOutput($optionsForOutput);
        }
        return $output;
    }

    /**
     * @param Entity\Argument[] $arguments
     * @return string
     */
    private function _prepareArgumentsForOutput(array $arguments): string {
        $result = "Arguments:\n";
        foreach ($arguments as $argument) {
            $result .= "\t-  {$argument->name()}\n";
        }
        return $result;
    }

    /**
     * @param Entity\Option[] $options
     * @return string
     */
    private function _prepareOptionsForOutput(array $options): string {
        $result = "Options:\n";
        foreach ($options as $option) {
            $result .= "\t{$option->name()}\n";
            $result .= $this->_prepareOptionValues($option->values());
        }
        return $result;
    }

    /**
     * @param string[] $values
     * @return string
     */
    private function _prepareOptionValues(array $values): string {
        $result = '';
        foreach ($values as $value) {
            $result .= "\t\t-  {$value}\n";
        }
        return $result;
    }
}