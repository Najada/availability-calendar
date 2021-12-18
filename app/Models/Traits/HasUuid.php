<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

/**
 * Trait thad adds UUID behaviour
 */
trait HasUuid
{
    /**
     * Bootable method. Runs on boot() of the model.
     * @return void
     */
    public static function bootHasUuid()
    {
        static::creating(function ($user) {
            $user->uuid = Str::uuid();
        });
    }

    /**
     * Iterate and filter properties of the model
     * @param array $values
     * @return mixed
     */
    protected function getArrayableItems(array $values)
    {
        if (! in_array('id', $this->hidden)) {
            // $this->hidden[] = 'id';
        }

        return parent::getArrayableItems($values);
    }

    /**
     * Set the route key name to uuid to allow route model binding
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
