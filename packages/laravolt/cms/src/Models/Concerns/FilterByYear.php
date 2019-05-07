<?php

namespace Laravolt\Cms\Models\Concerns;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait FilterByYear
{
    public static function availableYears()
    {
        $max = Carbon::now()->year;
        $min = static::published()->min(DB::raw('YEAR(created_at)')) ?? $max;

        $years = range($max, $min);

        return array_combine($years, $years);
    }

    public function scopeByYear(Builder $builder, $year)
    {
        $year = (int)$year;
        $builder->whereRaw("YEAR(updated_at) = $year");
    }

    public function scopeByMonth(Builder $builder, int $month, int $year = null)
    {
        $year = $year ?: Carbon::now()->year;
        $builder->whereRaw("MONTH(created_at) = $month");
        $builder->whereRaw("YEAR(created_at) = $year");
    }
}
