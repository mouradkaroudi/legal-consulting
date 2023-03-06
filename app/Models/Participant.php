<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    /**
     * The attributes that can be set with Mass Assignment.
     *
     * @var array
     */
    protected $fillable = ['thread_id', 'user_id', 'last_read'];

    /**
     * Thread relationship.
     *
     * @return BelongsTo
     *
     * @codeCoverageIgnore
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class, 'thread_id', 'id');
    }

    public function model() {
        return $this->morphTo();
    }

    /**
     * User relationship.
     *
     * @return BelongsTo
     *
     * @codeCoverageIgnore
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
