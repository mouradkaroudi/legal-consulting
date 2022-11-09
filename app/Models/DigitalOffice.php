<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DigitalOffice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image',
        'phone_number',
        'license_number',
        'country_code',
        'city',
        'license_attachment',
        'lat',
        'lng',
        'status'
    ];

    public function employees()
    {
        return $this->hasMany(DigitalOfficeEmployee::class, 'office_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'digital_office_categories', 'office_id', 'category_id');
    }

    public function threads() {
        return $this->hasMany(Thread::class, 'office_id', 'id');
    }

    public function owner() {
       //return $this->hasOne(DigitalOfficeEmployee::class, 'user_id', '')
    }


    function getLocationAttribute($value)
    {
        return json_encode([
            "lat" => (float)$this->lat,
            "lng" => (float)$this->lng,
        ]);
    }

    public function scopeUserOffice($query)
    {
    }



    function setLocationAttribute($value)
    {
        $this->attributes['lat'] = $value["lat"];
        $this->attributes['lng'] = $value["lng"];
    }
}
