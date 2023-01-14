<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionSubscriptionFee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['profession_id', 'fee', 'type'];

    /**
     * 
     */
    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}
