<?php

namespace Laravolt\Cms\Models\Concerns;

use ArrayAccess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Laravolt\Cms\Contracts\Sortable as SortableContract;

trait Sortable
{
    protected static $sortable = ['group_by' => 'type'];

    protected $previousPosition;

    public static function bootSortable()
    {
        static::creating(
            function ($model) {

                if ($model->getPosition() === null) {
                    $model->position = $model->getLastPosition() + 1;
                }

                // If there are another models with same position,
                // increment theirs position by 1
                if ($model->buildSortableQuery()->wherePosition($model->getPosition())->count() >= 1) {
                    $model->buildSortableQuery()
                        ->whereKeyNot($model->getKey())
                        ->where('position', '>=', $model->getPosition())
                        ->increment('position');
                }
            }
        );

        static::updating(
            function ($model) {
                // see reposition()
            }
        );
    }

    /**
     * Get current position.
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * Determine the order value for the new record.
     */
    public function getLastPosition(): int
    {
        return (int) $this->buildSortableQuery()->max('position');
    }

    /**
     * Let's be nice and provide an ordered scope.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string                                $direction
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeSorted(Builder $query, string $direction = 'asc')
    {
        return $query->orderBy('position', $direction);
    }

    /**
     * This function reorders the records: the record with the first id in the array
     * will get order 1, the record with the second it will get order 2, ...
     *
     * A starting order number can be optionally supplied (defaults to 1).
     *
     * @param array|\ArrayAccess $ids
     * @param int                $startPosition
     */
    public static function sort($ids, int $startPosition = 1)
    {
        if (! is_array($ids) && ! $ids instanceof ArrayAccess) {
            throw new InvalidArgumentException('You must pass an array or ArrayAccess object to setNewOrder');
        }

        foreach ($ids as $id) {
            if ($id instanceof Model) {
                $id = $id->getKey();
            }
            static::withoutGlobalScope(SoftDeletingScope::class)
                  ->whereKey($id)
                  ->update(['position' => $startPosition++]);
        }
    }

    /**
     * Move current model position to the beginning.
     */
    public function moveToFirst():void
    {
        $this->moveToPosition(1);
    }

    /**
     * Move current model position to the last.
     */
    public function moveToLast():void
    {
        $this->moveToPosition($this->getLastPosition());
    }

    /**
     * Move current model position before other $model.
     */
    public function moveBefore(SortableContract $model):void
    {
        $position = $model->getPosition();
        $delta = $position - $this->getPosition();

        // move up
        if ($delta > 0) {
            $position -= 1;
        }

        $this->moveToPosition($position);
    }

    /**
     * Move current model position after other $model.
     */
    public function moveAfter(SortableContract $model):void
    {
        $position = $model->getPosition();
        $delta = $position - $this->getPosition();

        // move down
        if ($delta < 0) {
            $position += 1;
        }

        $this->moveToPosition($position);
    }

    /**
     * Move to specific position.
     */
    public function moveToPosition(int $position):void
    {
        if ($position == $this->getPosition()) {
            return;
        }

        // Make sure position in between 1 and highest position
        $position = max(1, min($position, $this->getLastPosition()));

        DB::transaction(
            function () use ($position) {

                $delta = $position - $this->getPosition();

                // move up
                if ($delta > 0) {
                    $this->buildSortableQuery()
                        ->whereBetween('position', [$this->getPosition(), $position])
                        ->decrement('position');
                } else {
                    $this->buildSortableQuery()
                        ->whereBetween('position', [$position, $this->getPosition() - 1])
                        ->increment('position');
                }

                $this->update(['position' => $position]);
            }
        );
    }

    public function reposition()
    {
        $delta = $this->getPosition() - $this->previousPosition;

        // move up
        if ($delta > 0) {
            $this->buildSortableQuery()
                ->whereBetween('position', [$this->previousPosition, $this->getPosition()])
                ->whereKeyNot($this->getKey())
                ->decrement('position');
        } else {
            $this->buildSortableQuery()
                ->whereBetween('position', [$this->getPosition(), $this->previousPosition])
                ->whereKeyNot($this->getKey())
                ->increment('position');
        }
    }

    /**
     * Build eloquent builder of sortable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function buildSortableQuery()
    {
        $query = static::query();

        foreach ($this->getSortableGroupFields() as $field) {
            $query->where($field, $this->$field);
        }

        return $query;
    }

    /**
     * Mutator for position, make sure it always valid
     *
     * @param int|null $position
     */
    protected function setPositionAttribute(?int $position)
    {
        $lastPosition = $this->getLastPosition();
        $targetPosition = $this->exists ? $lastPosition : $lastPosition + 1;

        if ($position === null) {
            $position = $targetPosition;
        } else {
            $position = max(1, min($position, $lastPosition + 1));
        }

        if ($this->exists) {
            $this->previousPosition = $this->attributes['position'];
        }

        $this->attributes['position'] = $position;
    }

    protected function getSortableGroupFields(): array
    {
        return (array) (static::$sortable['group_by'] ?? null);
    }
}
