<?php
/**
 * author Ayuna Sereneva <avsereneva@gmail.com>
 */

namespace Ayunoss\Cli\Service;

use Ayunoss\Cli\Component\ConsoleTools\Entity;
use Ayunoss\Cli\Core\ServiceLocator;
use Ayunoss\Cli\Exception;

class ArgvParserService extends AbstractService {

    public function parse(array $argvParams): Entity\Request {
        $textService = ServiceLocator::textService();

        $requestArguments = [];
        $requestOptions   = [];
        while (true) {
            $argvParam = array_shift($argvParams);
            if ($argvParam === null) {
                break;
            }

            $isArgument = $this->_isArgument($argvParam);
            $isOption   = $this->_isOption($argvParam);
            if (!$isArgument && !$isOption) {
                throw new Exception\BadUsage("Invalid parameter {$argvParam}");
            }

            if ($isArgument) {
                $arguments = explode(',', $textService->removeBraces($argvParam));
                foreach ($arguments as $argument) {
                    $requestArgument = new Entity\Argument($argument);
                    if ($requestArgument->isHelpInfoRequired()) {
                        return new Entity\Request([$requestArgument], []);
                    }

                    $requestArguments[] = $requestArgument;
                }
            } elseif ($isOption) {
                $optionParts = explode('=', $textService->removeBraces($argvParam));
                $optionName  = $optionParts[0];
                if (str_contains($optionParts[1], '{'))  {
                    $optionValues = explode(',', $textService->removeBraces($optionParts[1]));
                    $requestOptions[] = new Entity\Option($optionName, $optionValues);
                } else {
                    $requestOptions[] = new Entity\Option($optionName, [$optionParts[1]]);
                }
            } else {
                throw new Exception\BadUsage("Invalid option {$argvParam}");
            }
        }
        return new Entity\Request($requestArguments, $requestOptions);
    }

    private function _isArgument(string $argvParam): bool {
        return (bool)preg_match("/^\{.*\}$/", $argvParam);
    }

    private function _isOption(string $argvParam): bool {
        return (bool)preg_match('/^\[.*(=).*\]$/', $argvParam);
    }
}