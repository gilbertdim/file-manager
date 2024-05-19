<?php

namespace App\Models;

use App\Observers\FileObserver;
use App\Traits\HasModifierBy;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

#[ObservedBy(FileObserver::class)]
class File extends Model
{
    use HasFactory;
    use LogsActivity;
    use NodeTrait;
    use SoftDeletes;
    use HasModifierBy;

    protected $fillable = ['name', 'path', '_lft', '_rgt', 'parent_id', 'is_folder', 'mime', 'size', 'created_by', 'updated_by'];

    public $appends = ['is_root'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

    public function isOwnedBy(int $userId): bool
    {
        return $userId == $this->created_by;
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->parent)) {
                return ;
            }

            $model->path = ($model->parent->is_root ? '' : $model->parent->path . '/') . Str::slug($model->name);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(File::class, 'parent_id');
    }

    public function isRoot(): Attribute
    {
        return Attribute::make(
            get: fn () => empty($this->parent_id),
        );
    }

    public function owner(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_by == Auth::id() ? 'me' : $this->user->name,
        );
    }
}
