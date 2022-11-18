<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'national_ID',
        'degree',
        'nationality',
        'gender',
        'national_id_attachment'
    ];

    public function getGenderLabelAttribute() {
        return $this->gender ? ($this->gender == 'male' ? 'ذكر' : 'أنثى') : '-';
    }

}
