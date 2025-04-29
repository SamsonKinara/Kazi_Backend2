<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural form of the model name
    // protected $table = 'categories'; 

    protected $fillable = ['name'];

    // Define the inverse relationship with Job model
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
