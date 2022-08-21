<?php
/**
 * author Ayuna Sereneva <avsereneva@gmail.com>
 */

namespace Ayunoss\Cli\Component\ConsoleTools\Entity;

class Request {

    /**
     * @var Argument[]
     */
    private array $arguments;

    /**
     * @var Option[]
     */
    private array $options;

    /**
     * @param Argument[] $arguments
     * @param Option[] $options
     */
    public function __construct(array $arguments, array $options) {
        $this->arguments = $arguments;
        $this->options   = $options;
    }

    /**
     * @return Argument[]
     */
    public function arguments(): array {
        return $this->arguments;
    }

    /**
     * @return Option[]
     */
    public function options(): array {
        return $this->options;
    }

    public function isCommandHelpInfoRequired(): bool {
        if (count($this->arguments) === 1 && count($this->options) === 0) {
            return current($this->arguments)->isHelpInfoRequired();
        }
        return false;
    }
}