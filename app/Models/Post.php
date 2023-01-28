<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Post extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public const TYPE_PAGE = 'page';
    public const TYPE_FAQ = 'faq';
    public const TYPE_CUSTOM = 'custom';

    /**
     * The attributes that are translatable.
     *
     * @var array<string>
     */
    public $translatedAttributes = ['title', 'content'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['post_type'];

}
