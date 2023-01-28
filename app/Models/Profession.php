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
    public $translatedAttributes = ['name', 'slug'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_id',
    ];

    /**
     * Each profession belong to one service
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
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
}
