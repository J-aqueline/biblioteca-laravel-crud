<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id', 
        'user_id',
        'return_date',
        'loan_date',
    ];

    public function book()
    {
        return $this->hasOne(Book::class, "id", "book_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "id", "user_id");
    }
}
