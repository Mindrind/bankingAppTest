<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'balance',
        'description',
        'destination_user_id'
    ];

    /**
     * Get the user that owns the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the destination user for the transfer transaction.
     */
    public function destinationUser()
    {
        return $this->belongsTo(User::class, 'destination_user_id');
    }
}
