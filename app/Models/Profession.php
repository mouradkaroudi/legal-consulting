<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'service_id',
    ];

    /**
     * Each profession belong to one service
     */
    public function service() {
        return $this->belongsTo(Service::class);
    }

    /**
     * Each profession may have one or more specialization
     */
    public function specializations() {
        return $this->hasMany(Specialization::class);
    }

    /**
     * Each profession may have many subscription plans
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions() {
        return $this->hasMany(ProfessionSubscriptionPlan::class, 'profession_id', 'id');
    }

}
