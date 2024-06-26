<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title', 
        'published_at',
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class, "author_book", "book_id", "author_id");
    }

    public function loans()
    {
        return $this->hasMany(Loan::class, "book_id", "id");
    }
}
