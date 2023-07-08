<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = ['book_code', 'title', 'year', 'author', 'publisher', 'isbn', 'class_code', 'shelf_position', 'book_origin', 'stocks'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}