<?php
/**
 * author Ayuna Sereneva <avsereneva@gmail.com>
 */

namespace Ayunoss\Cli\Service;

class TextService extends AbstractService {

    public function camelCaseToUnderscore(string $text): string {
        preg_match_all('!([A-Z][A-Z0-9]|[A-Za-z][a-z0-9]+)!', $text, $matches);
        $result = $matches[0];
        foreach ($result as $key => $match) {
            $result[$key]= $match === strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $result);
    }

    public function removeBraces(string $text): string {
        return trim($text, '{}[]');
    }
}