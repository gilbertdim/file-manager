<?php

namespace App\Traits;

trait HasModifierBy
{
    protected static function bootHasModifierBy()
    {
        static::creating(function ($model) {
            if (auth()->check()) {
                $model->created_by = auth()->user()->id;
                $model->updated_by = auth()->user()->id;
            }
        });

        static::updating(function ($model) {
            if (auth()->check()) {
                $model->updated_by = auth()->user()->id;
            }
        });
    }
}
