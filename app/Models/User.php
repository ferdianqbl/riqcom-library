<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];
    protected $table = 'users';
    protected $fillable = [
        'card_id','name','birth_date','join_date','member_id'
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
