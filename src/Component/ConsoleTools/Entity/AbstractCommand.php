<?php
/**
 * author Ayuna Sereneva <avsereneva@gmail.com>
 */

namespace Ayunoss\Cli\Component\ConsoleTools\Entity;

use Ayunoss\Cli\Core;
use Ayunoss\Cli\Service;

abstract class AbstractCommand {

    private const DEFAULT_COMMAND_NAMESPACE = 'Ayunoss\\Cli\\DevOps\\Commands\\';

    protected Service\TextService $_textService;

    public function __construct() {
        $this->_textService = Core\ServiceLocator::textService();
    }

    abstract public function getDescription(): string;

    abstract public function _run(Request $request): string;

    final public function getName(): string {
        $replaceRegexp = '#^' . preg_quote(self::DEFAULT_COMMAND_NAMESPACE, '#') . '#';
        $commandClass  = preg_replace($replaceRegexp, '', get_called_class());
        return $this->_textService->camelCaseToUnderscore($commandClass);
    }
}