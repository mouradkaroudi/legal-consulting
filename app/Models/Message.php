<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public const ATTACHMENT = 'attachment';
    public const TEXT = 'text';

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['thread'];

    /**
     * The attributes that can be set with Mass Assignment.
     *
     * @var array
     */
    protected $fillable = ['thread_id', 'user_id', 'body', 'type'];

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

    /**
     * Office relationship.
     *
     * @return BelongsTo
     *
     * @codeCoverageIgnore
     */
    public function office()
    {
        return $this->belongsTo(DigitalOffice::class, 'office_id');
    }

    /**
     * Participants relationship.
     *
     * @return HasMany
     *
     * @codeCoverageIgnore
     */
    public function participants()
    {
        return $this->hasMany(Participant::class, 'thread_id', 'thread_id');
    }

    /**
     * Recipients of this message.
     *
     * @return HasMany
     */
    public function recipients()
    {
        return $this->participants()->where('user_id', '!=', $this->user_id);
    }

    /**
     * Returns unread messages given the userId.
     *
     * @param Builder $query
     * @param mixed $userId
     * @return Builder
     */
    public function scopeUnreadForUser(Builder $query, $userId)
    {
        return $query->where('user_id', '!=', $userId)
            ->whereHas('participants', function (Builder $query) use ($userId) {
                $query->where('user_id', $userId)
                    ->where(function (Builder $q) {
                        $q->where('last_read', '<', $this->getConnection()->raw($this->getConnection()->getTablePrefix() . $this->getTable() . '.created_at'))
                            ->orWhereNull('last_read');
                    });
            })->whereHas('thread', function(Builder $query) use ($userId) {
                $query->where('user_id', $userId);
            });
    }

    /**
     * Returns unread messages given the userId and officeId.
     *
     * @param Builder $query
     * @param mixed $userId
     * @param mixed $officeId
     * @return Builder
     */
    public function scopeUnreadForUserOffice(Builder $query, $userId, $officeId)
    {
        return $query->where('user_id', '!=', $userId)
            ->whereHas('participants', function (Builder $query) use ($userId) {
                $query->where('user_id', $userId)
                    ->where(function (Builder $q) {
                        $q->where('last_read', '<', $this->getConnection()->raw($this->getConnection()->getTablePrefix() . $this->getTable() . '.created_at'))
                            ->orWhereNull('last_read');
                    });
            })->whereHas('thread', function(Builder $query) use ($userId, $officeId) {
                $query->where('office_id', $officeId);
            });
    }

}
