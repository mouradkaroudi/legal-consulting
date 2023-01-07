<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class DigitalOfficeEmployee extends Model
{
    use HasFactory, HasRoles, HasPermissions, Notifiable;
    
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'office_id',
        'user_id',
        'job_title'
    ];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		"ended_at" => "datetime",
	];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function isOwner( DigitalOffice $office ): bool {
        return $this->id === $office->user_id;
    }

    public function scopeActive( $query ) {
        return $query->where('ended_at', null);
    }

}
