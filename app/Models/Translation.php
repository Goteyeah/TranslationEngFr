<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongTo; //relation 1n avec la table Word

class Translation extends Model
{
    use HasFactory;
protected $attributes =
 ['stars' => 1,
 'word_id' =>1,
    ]; //met des valeurs par default
    public function word(): BelongTo { //relation 1n avec table word un seul mot plusieurs traduction
        return $this->belongTo(Word::class);
    }
}
