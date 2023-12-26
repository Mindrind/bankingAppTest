<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'user_id',
        'account_number',
        'balance'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optionally, you can add a relationship to transactions if needed
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
