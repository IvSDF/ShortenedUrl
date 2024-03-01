<?php

namespace App\Services;

interface ShortCodeGeneratorInterface
{
    public function generateShortCode(string $url): string;
    public function getOriginalUrl(string $shortCode): string;
}
