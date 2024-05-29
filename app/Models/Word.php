<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // on creer une relation 1n
class Word extends Model
{
    use HasFactory;
    
   protected $fillable =  ['words','isValid', 'isDictionary']; // mass assignement

    public function translations(): HasMany { // relation 1n plusileurs traduction pour un seul mot anglais

        return $this->HasMany(Translation::class); // jai retire un s a translation
}

public function User(): BelongTo {
    return $this->belongTo(User::class); // relation cardinalité 1-1 de word vers user
}
    
}


