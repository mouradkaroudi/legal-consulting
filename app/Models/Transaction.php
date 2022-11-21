<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public const PENDING = 'PENDING';
    public const FAILED = 'FAILED';
    public const SUCCESS = 'SUCCESS';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
        'type',
        'source',
        'status',
        'due_date',
        'metadata'
    ];

    public function transactionable()
    {
        return $this->morphTo();
    }

    public function completeTransaction()
    {
        $this->status = self::SUCCESS;
        $this->save();
    }

    public function failedTransaction()
    {
        $this->status = self::FAILED;
        $this->save();
    }
}
