<?php

namespace App\Services;

interface ParserServiceInterface
{
    public function getData(string $file): array;
}