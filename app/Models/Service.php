<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Service extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name'];

    protected $fillable = ['slug', 'is_available'];

	protected $casts = [
		"is_available" => "boolean",
	];

    /**
     * Each service has many professions
     */
    public function professions()
    {
        return $this->hasMany(Profession::class);
    }
    
    /**
     * 
     */
    public function offices() {
        return $this->hasMany(DigitalOffice::class);
    }

    /**
     * 
     */
    public function scopeAvailable($query) {
        return $query->where('is_available', true);
    }
}
