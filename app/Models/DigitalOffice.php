<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class DigitalOffice extends Model
{
    use HasFactory, Notifiable;

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
        'location',
        'status'
    ];

    /**
     * 
     */
    public function employees()
    {
        return $this->hasMany(DigitalOfficeEmployee::class, 'office_id', 'id');
    }

    /**
     * 
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * 
     */
    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
    /**
     * 
     */
    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'digital_office_specializations', 'specialization_id', 'office_id');
    }
    
    /**
     * 
     */
    public function threads() {
        return $this->hasMany(Thread::class, 'office_id', 'id');
    }
    
    public function scopeAvailable($query) {
        return $query->where('status', 'available');
    }

    /**
     * 
     */
    public function owner() {
       return $this->hasOne(User::class, 'id', 'user_id');
    }

    function getLocationAttribute($value)
    {
        return json_encode([
            "lat" => (float)$this->lat,
            "lng" => (float)$this->lng,
        ]);
    }
    
}
