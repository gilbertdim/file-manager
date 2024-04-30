<?php

namespace App\Models;

use App\Observers\FileObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

#[ObservedBy(FileObserver::class)]
class File extends Model
{
    use HasFactory;
    use LogsActivity;
    use NodeTrait;

    protected $fillable = ['name', 'path', '_lft', '_rgt', 'parent_id', 'is_folder', 'mime', 'size', 'created_by', 'updated_by'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }
}
