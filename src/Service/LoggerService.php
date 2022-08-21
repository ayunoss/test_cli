<?php
/**
 * author Ayuna Sereneva <avsereneva@gmail.com>
 */

namespace Ayunoss\Cli\Service;

class LoggerService extends AbstractService {

    private const LOGS_PATH = __DIR__.'/../logs';

    public function logThrowable(\Throwable $t): string {
        $logFile = self::LOGS_PATH . "/exception_handler.log";
        $date    = date("Y.m.d H:i:s");
        $output  = "[{$date}]" . $this->_prepareErrorInfoWithTrace($t) . "\n";
        $this->_logToFile($output, $logFile);
        return $output;
    }

    private function _prepareErrorInfoWithTrace(\Throwable $t): string {
        $result = $t->getCode() . " " . get_class($t) . " " . $t->getMessage() . "\n" . (print_r($t->getTraceAsString(), true)) . "\n";
        $previousThrowable = $t->getPrevious();
        if ($previousThrowable !== null) {
            $result .= $previousThrowable->getCode() . " " . get_class($previousThrowable) . " " . $previousThrowable->getMessage() . "\n" . (print_r($previousThrowable->getTraceAsString(), true)) . "\n";
        }
        return $result;
    }

    private function _logToFile(string $message, string $logFile): void {
        $dirName = dirname($logFile);
        if (!file_exists($dirName)) {
            $oldMask = umask(0);
            mkdir($dirName, 0777, true);
            umask($oldMask);
        }
        $message = "{$message}\n";
        $fh = fopen($logFile, 'a');
        fwrite($fh, $message);
        fclose($fh);
    }
}