<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    
    public function analysts()
    {
        return $this->hasMany(User::class)->where('type', 'analyst');
    }

    
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}