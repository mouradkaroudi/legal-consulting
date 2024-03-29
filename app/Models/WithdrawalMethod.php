<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalMethod extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["name", "description", "is_available", "minimum_amount", "maximum_amount", "fees", "information_required"];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "fees" => "json",
        "information_required" => "json",
    ];

    /**
     * Each withdrawal method may only belong to some countries 
     */
    public function countries()
    {
        return $this->belongsToMany(Country::class, 'withdrawal_method_countries', 'withdrawal_method_id', 'country_id');
    }

    /**
     * Scope only available methods
     */
    public function scopeAvailable($query) {
        return $query->where('is_available', true);
    }

}
