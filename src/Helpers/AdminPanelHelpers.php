<?php

namespace Koraycicekciogullari\HydroAdministrator\Helpers;

use Analytics;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Spatie\Analytics\Period;

class AdminPanelHelpers
{

    /**
     * @param $value
     * @return string
     */
    public function makePassword($value): string
    {
        return Hash::make($value);
    }

    /**
     * @param $days
     * @return Collection
     */
    public static function getFetchVisitorsAndPageViews($days): Collection
    {
        return Analytics::fetchVisitorsAndPageViews(Period::days($days));
    }

    /**
     * @param $days
     * @return Collection
     */
    public static function getFetchTopReferrers($days): Collection
    {
        return Analytics::fetchTopReferrers(Period::days($days));
    }

    /**
     * @param $days
     * @return Collection
     */
    public static function getFetchMostVisitedPages($days): Collection
    {
        return Analytics::fetchMostVisitedPages(Period::years($days));
    }

    /**
     * @param $date
     * @return mixed
     */
    public static function googleChartDateNormalize($date): mixed
    {
        return $date->map(function($query){
            return Carbon::parse($query)->format('d/m/Y');
        });
    }
}
