<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];
    protected $table = 'users';
    protected $fillable = [
        'card_id','name','birth_date','join_date'
    ];

    public function loan_transactions()
    {
        return $this->hasMany(LoanTransaction::class);
    }
    public function return_transactions()
    {
        return $this->hasMany(ReturnTransaction::class);
    }
}
