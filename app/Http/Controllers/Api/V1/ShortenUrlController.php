<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShortenUrlRequest;
use App\Services\ShortenUrlService;

// Додали імпорт сервісу
use Illuminate\Http\Request;

class ShortenUrlController extends Controller
{
    protected $shortenUrlService;

    public function __construct(ShortenUrlService $shortenUrlService)
    {
        $this->shortenUrlService = $shortenUrlService;
    }

    public function store(ShortenUrlRequest $shortenUrlRequest)
    {
        $validatedData = $shortenUrlRequest->validated();

        $originalUrl = $validatedData['url'];

        $shortCode = $this->shortenUrlService->generateShortCode($originalUrl);

        return response()->json(['shortened_url' => route('shorten.redirect', $shortCode)]);
    }

    public function redirect($shortCode): string
    {
        $url = $this->shortenUrlService->getOriginalUrl($shortCode);

        if ($url) {
            return redirect()->away($url, 301);
        } else {
            abort(404);
        }
    }
}
