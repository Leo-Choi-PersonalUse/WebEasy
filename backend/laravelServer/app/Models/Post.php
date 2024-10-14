<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    // Define the table associated with the model
    protected $table = 'posts';

    // Define the fillable attributes
    protected $fillable = [
        'title',
        'content',
    ];
}