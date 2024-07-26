<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // on creer une relation 1n
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Word extends Model
{
    use HasFactory;
    
   protected $fillable =  ['words','isValid', 'isDictionary', 'user_id']; // mass assignement
    protected $attributes = [ 'user_id' => 1]; // valeur par default de user_id
    public function translations(): HasMany { // relation 1n plusileurs traduction pour un seul mot anglais

        return $this->HasMany(Translation::class); // jai retire un s a translation
}

public function User(): BelongsTo {
    return $this->belongsTo(User::class); // relation cardinalité 1-1 de word vers user
}
    
}


