<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'citizenship',
        'country_code',
        'currency_code'
    ];

    public function cities() {
        return $this->hasMany(City::class, 'country_code', 'country_code');
    }

}
