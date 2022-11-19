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

    public function service() {
        $this->belongsTo(Service::class);
    }

    public function specializations() {
        return $this->hasMany(Specialization::class);
    }

}
