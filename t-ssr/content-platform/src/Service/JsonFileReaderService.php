<?php

namespace App\Service;

class JsonFileReaderService {
    public static function readAndParseJson(string $filePath): array
    {
        $jsonContent = file_get_contents($filePath);
        return json_decode($jsonContent, true);
    }
}
