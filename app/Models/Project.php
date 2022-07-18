<?php

namespace App\Models;

use App\Models\User;
use App\Models\Client;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, CascadeSoftDeletes;

    protected $cascadeDeletes = ['tasks'];

    protected $dates = ['deleted_at'];

    protected $fillable = ['title','description','deadline','user_id','client_id','status'];

    public const STATUS = ['open', 'in progress', 'blocked', 'cancelled', 'completed'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function tasks()
    {
       return $this->hasMany(Task::class);
    }
}
