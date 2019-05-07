<?php

namespace Laravolt\Cms\Models\Concerns;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Jenssegers\Date\Date;

trait HasDateRange
{
    public function scopeEnded(Builder $builder)
    {
        $builder->where('meta->end_date', '<=', Carbon::now()->toDateString());
    }

    protected function getStartDateAttribute()
    {
        return $this->meta['start_date'];
    }

    protected function getEndDateAttribute()
    {
        return $this->meta['end_date'];
    }

    /**
     * Get minimum available date that user can select.
     * Usually used for daterange dropdown.
     */
    protected function getMinDateAttribute()
    {
        $min = $now = Carbon::now();

        if ($this->start_date) {
            $start = Carbon::createFromFormat('Y-m-d', $this->start_date);

            $min = $start->minimum($now);
        }

        return $min->format('Y-m-d');
    }

    protected function setStartDateAttribute(Carbon $date)
    {
        $this->meta->start_date = $date->toDateString();
    }

    protected function setEndDateAttribute(Carbon $date)
    {
        $this->meta->end_date = $date->toDateString();
    }

    protected function getPeriodAttribute()
    {
        $start = Date::createFromFormat('Y-m-d', $this->start_date);
        $end = Date::createFromFormat('Y-m-d', $this->end_date);

        if ($start->equalTo($end)) {
            return sprintf('%s', $start->format('j M Y'));
        } elseif ($start->isSameMonth($end) && $start->isSameYear($end)) {
            return sprintf('%s - %s', $start->format('j'), $end->format('j M Y'));
        } elseif ($start->isSameYear($end)) {
            return sprintf('%s - %s', $start->format('j M'), $end->format('j M Y'));
        } else {
            return sprintf('%s - %s', $start->format('j M Y'), $end->format('j M Y'));
        }
    }
}
