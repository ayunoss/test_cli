<?php
/**
 * author Ayuna Sereneva <avsereneva@gmail.com>
 */

namespace Ayunoss\Cli\Component\ConsoleTools\Entity;

class Argument {

    private const HELP_ARGUMENT = 'help';

    private string $_name;

    public function __construct(string $name) {
        $this->_name = $name;
    }

    public function name(): string {
        return $this->_name;
    }

    public function isHelpInfoRequired(): bool {
        return $this->_name === self::HELP_ARGUMENT;
    }
}