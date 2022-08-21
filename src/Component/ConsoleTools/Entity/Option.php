<?php
/**
 * author Ayuna Sereneva <avsereneva@gmail.com>
 */

namespace Ayunoss\Cli\Component\ConsoleTools\Entity;

class Option {

    private string $_name;

    /**
     * @var string[]
     */
    private array $_values;

    /**
     * @param string $name
     * @param string[] $value
     */
    public function __construct(string $name, array $value) {
        $this->_name   = $name;
        $this->_values = $value;
    }

    public function name(): string {
        return $this->_name;
    }

    /**
     * @return string[]
     */
    public function values(): array {
        return $this->_values;
    }
}