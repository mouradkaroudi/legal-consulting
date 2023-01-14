<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalMethodCountry extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["withdrawal_method_id", "country_id"];

    public function country() {
        return $this->hasOne(Country::class);
    }

    public function withdrawalMethod() {
        return $this->hasOne(WithdrawalMethod::class);
    }

}
