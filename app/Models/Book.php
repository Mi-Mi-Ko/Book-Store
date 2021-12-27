<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title' , 
        'author', 
        'description', 
        'category' , 
        'rate', 
        'publish_date', 
        'url',
        'is_available', 
        'status'
    ];
}
