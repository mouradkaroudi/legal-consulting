<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class DigitalOfficeEmployee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'office_id',
        'user_id',
        'role_name',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function scopeCurrentUserOffice($query)
    {
        $user = Auth::user();

        $employee = DigitalOfficeEmployee::where('user_id', $user->id)->first();

        $query->where('office_id', $employee->office_id);
    }
}
