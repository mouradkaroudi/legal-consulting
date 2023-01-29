<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postmeta extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'postmetas';

    protected $fillable = ['option', 'value'];
}
