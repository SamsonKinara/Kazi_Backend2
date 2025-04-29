<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural form of the model name
    // protected $table = 'jobs'; 

    protected $fillable = [
        'user_id', 
        'title', 
        'description', 
        'category_id'
    ];

    // Define the relationship with Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
