<?php

namespace App\Service;

class FooterDataService
{
    private array $data;

    public function __construct()
    {
        $this->data = JsonFileReaderService::readAndParseJson( __DIR__ . '/../../data/data.json');
    }

    public function getData(): array
    {
        return $this->data['footer'];
    }
}