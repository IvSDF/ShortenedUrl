<?php

namespace App\Services;

use App\Models\ShortenedUrl;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

function base62_encode(string $hashedUrl)
{
}

class ShortenUrlService
{
    public function generateShortCode($url)
    {
        $shortCode = rtrim(strtr(base64_encode($url), '+/', '-_'), '=');

        while (ShortenedUrl::where('short_code', $shortCode)->exists()) {
            $shortCode .= rand(0, 9);
        }

        $newUrl = new ShortenedUrl();
        $newUrl->original_url = $url;
        $newUrl->short_code = $shortCode;
        $newUrl->save();

        return $shortCode;
    }

    public function getOriginalUrl($shortCode)
    {
        try {

            DB::beginTransaction();

            $shortenedUrl = ShortenedUrl::where('short_code', $shortCode)->first();

            if ($shortenedUrl) {

                $shortenedUrl->increment('counts');
                $shortenedUrl->save();

                DB::commit();

                return $shortenedUrl->original_url;
            } else {

                DB::rollback();

                return '';
            }
        } catch (QueryException $e) {

            DB::rollback();

            return '';
        }
    }

}
