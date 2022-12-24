<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    public function withdrawalable()
    {
        return $this->morphTo();
    }

    public function office() {
        return $this->morphOne(DigitalOffice::class, 'withdrawalable');
    }

    public function user() {
        return $this->morphTo(User::class, 'withdrawalable');
    }
}
