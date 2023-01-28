<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Specialization extends Model implements TranslatableContract
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
        'name',
        'slug',
        'profession_id',
    ];

    /**
     * 
     */
    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }
}
