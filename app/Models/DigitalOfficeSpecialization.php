<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class DigitalOfficeSpecialization extends Model
{
    use HasFactory, HasRoles, HasPermissions, Notifiable;

    public $timestamps = false;
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'office_id',
        'specialization_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    /**
     * Specialization user
     */
    public function office()
    {
        return $this->hasOne(DigitalOffice::class, 'id', 'office_id');
    }

    /**
     * Specialization user
     */
    public function specialization()
    {
        return $this->hasOne(Specialization::class, 'id', 'specialization_id');
    }


}
