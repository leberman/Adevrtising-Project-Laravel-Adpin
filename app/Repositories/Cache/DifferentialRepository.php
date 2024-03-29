<?php

declare(strict_types=1);

namespace App\Repositories\Cache;

use App\Brand;
use Carbon\Carbon;
use Exception;

class DifferentialRepository
{
    public const CACHE_KEY = 'DIFFERENTIAL';

    /**
     * Get all DIFFERENTIAL
     *
     * @return mixed|string
     */
    public function all()
    {
        $key = "all";
        $cacheKey = $this->getCacheKey($key);
        try {
            return cache()->remember($cacheKey, Carbon::now()->addDay(5), function () {
                return [
                    [
                        'id' => 1,
                        'title' => 'تک دیفرانسیل',
                        'slug' => 'used',
                    ],
                    [
                        'id' => 3,
                        'title' => 'دو دیفرانسیل',
                        'slug' => 'check'
                    ]
                ];
            });
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * find DIFFERENTIAL title from cache
     *
     * @param $id
     * @param array $select
     * @return mixed|string
     */
    public function find($id, $select)
    {
        $key = "find.{$id}";
        $cacheKey = $this->getCacheKey($key);
        try {
            return cache()->remember($cacheKey, Carbon::now()->addDay(5), function () use ($select, $id) {
                $gearboxStatuses = [
                    [
                        'id' => 1,
                        'title' => 'تک دیفرانسیل',
                        'slug' => 'used'
                    ],
                    //delete for show all defferntial (just show with id)
                    [
                        'id' => 2,
                        'title' => 'تمام چرخ متحرک',
                        'slug' => 'new'
                    ] ,
                    [
                        'id' => 3,
                        'title' => 'دو دیفرانسیل',
                        'slug' => 'check'
                    ]
                ];
                foreach ($gearboxStatuses as $status) {
                    if ($id == $status['id']) {
                        $title = $status[$select];
                    }
                }
                return $title;
            });
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create cache key
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
