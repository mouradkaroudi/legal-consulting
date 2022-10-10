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

    function getLocationAttribute($value)
    {
        return json_encode([
            "lat" => (float)$this->lat,
            "lng" => (float)$this->lng,
        ]);
    }

    public function scopeUserOffice($query)
    {
        $user = Auth::user();

        $employee = DigitalOfficeEmployee::where('user_id', $user->id)->first();

        return $query->where('id', $employee->office_id);
    }


    function setLocationAttribute($value)
    {
        $this->attributes['lat'] = $value["lat"];
        $this->attributes['lng'] = $value["lng"];
    }
}
