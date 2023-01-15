<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["started_at", "expire_at"];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "started_at" => "datetime",
        "expire_at" => "datetime",
    ];


    public static function isEnabled()
    {
        return get_option('subscriptions_enable_subscription') == 1;
    }

    public function subscriber()
    {
        return $this->morphTo();
    }
}
