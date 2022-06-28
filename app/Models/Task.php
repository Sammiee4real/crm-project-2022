<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = ['title','description','deadline','status','project_id'];

    public const STATUS = ['open', 'in progress', 'blocked', 'cancelled', 'completed'];

    // protected $casts = [
    //     'deadline' => 'datetime:m',
    // ];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
