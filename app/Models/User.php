<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany; // on creer une relation 1n
use Illuminate\Database\Eloquent\Relations\BelongTo;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'genre',
        // 'section',
        'email',
        'password',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function Word(): HasMany     //relation 0-n de la table user vers Word
    {
        return $this->HasMany(Word::class);
    }

    public function Translation(): HasMany //relation 0-n de la table user vers translation ( plusieur traduc concernent 1 utilisateur)
    {
        return $this->HasMany(Translation::class);
    }

    public function Section(): BelongsTo 
    {
        return $this->belongsto(Section::class);
    }

   
}
