<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Profession extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    /**
     * The attributes that are translatable.
     *
     * @var array<string>
     */
    public $translatedAttributes = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_id',
        'slug',
        'is_available',
        'fee_percentage'
    ];

    /**
     * Each profession belong to one service
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    
    public function offices() {
        return $this->hasMany(DigitalOffice::class);
    }

    /**
     * Each profession belong to a service. Services have translatable columns
     */
    public function serviceTranslation()
    {
        return $this->belongsTo(ServiceTranslation::class, 'service_id', 'id');
    }


    /**
     * Each profession may have one or more specialization
     */
    public function specializations()
    {
        return $this->hasMany(Specialization::class);
    }

    /**
     * Each profession may have many subscription plans
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(ProfessionSubscriptionPlan::class, 'profession_id', 'id');
    }

    /**
     * 
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }
}
