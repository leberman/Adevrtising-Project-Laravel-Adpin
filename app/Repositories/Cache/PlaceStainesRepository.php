<?php

declare(strict_types=1);

namespace App\Repositories\Cache;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class Production.
 */
class PlaceStainesRepository
{
    public const CACHE_KEY = 'PLACESTAINES';

    /**
     * get all Productions
     *
     * @return mixed|string
     */
    public function all()
    {
        $key = "all";
        $cacheKey = $this->getCacheKey($key);
        try {
            return cache()->remember($cacheKey, Carbon::now()->addDay(5), function () {
                return  DB::table('placestaines')->select('id', 'title', 'slug')->get();
            });
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * create cache key
     *
     * @param $key
     * @return string
     */
    public function getCacheKey($key)
    {
        $key = strtoupper($key);
        return self::CACHE_KEY . ".$key";
    }
}
