<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['projects'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'contact_name',
        'contact_email',
        'contact_phone_number',
        'company_name',
        'company_address',
        'company_city',
        'company_zip',
        'company_vat',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function setCompanyNameAttribute($value)
    {
        $this->attributes['company_name'] = ucfirst($value);
    }

    protected $casts = [
        'created_at' => 'datetime:F d, Y',
        'updated_at' => 'datetime:F d, Y', 
    ];


    // public static function getContactNameAttribute($value){
    //     return strtoupper($value);
    // }


    public function projects()
    {
       return $this->hasMany(Project::class);
    }
}
