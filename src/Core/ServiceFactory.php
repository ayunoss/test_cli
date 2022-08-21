<?php

namespace Ayunoss\Cli\Core;

use Ayunoss\Cli\Service\AbstractService;

class ServiceFactory {

    public function get(string $serviceClassName) {
        $serviceClassName = trim($serviceClassName, "\\");
        return self::_instance($serviceClassName);
    }

    private static function _instance($serviceClassName): AbstractService {
        return new $serviceClassName();
    }
}