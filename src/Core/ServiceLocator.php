<?php
/**
 * author Ayuna Sereneva <avsereneva@gmail.com>
 */

namespace Ayunoss\Cli\Core;

use Ayunoss\Cli\Service;

class ServiceLocator {

    public static function textService(): Service\TextService {
        return self::_factory()->get(Service\TextService::class);
    }

    public static function argvParserService(): Service\ArgvParserService {
        return self::_factory()->get(Service\ArgvParserService::class);
    }

    public static function loggerService(): Service\LoggerService {
        return self::_factory()->get(Service\LoggerService::class);
    }

    protected static function _factory(): ServiceFactory {
        return new ServiceFactory();
    }
}