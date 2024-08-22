<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];
    protected $table = 'books';
    protected $fillable = [
        'title','stock','pages','price'
    ];

    public function loan_transactions()
    {
        return $this->hasMany(Loan_Transaction::class);
    }
    public function return_transactions()
    {
        return $this->hasMany(Return_Transaction::class);
    }
}
