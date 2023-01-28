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
    public $translatedAttributes = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['profession_id', 'slug'];

    /**
     * Each specialization belong to a profession
     */
    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }

    /**
     * Each specialization belong to a profession. Professions have translatable columns
     */
    public function professionTranslation()
    {
        return $this->belongsTo(ProfessionTranslation::class, 'profession_id', 'id');
    }

}
