<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class Section extends Model
{
    use HasFactory;
    protected $table = 'section'; 
    protected $fillable = ['section'];     // je specifie section sans le "s" que laravel me met par default

public function user():HasMany {
    return $this->hasMany(User::class);
}
}