<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'company_id',  // Id de la empresa
        'dni',          // DNI del usuario
        'name',       // Nombre del usuario
        'email',       // Correo electrónico
        'password',   // Contraseña (se encriptará)
        'is_active',       // Estado del usuario
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'is_active' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
    // public $incrementing = false;

    // /**
    //  * The attributes that are auto-cast to UUID.
    //  *
    //  * @var array
    //  */
    // protected $keyType = 'string';

    // /**
    //  * Boot method to handle automatic UUID generation for new users.
    //  *
    //  * @return void
    //  */
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($user) {
    //         if (!$user->id) {
    //             $user->id = (string) Str::uuid();
    //         }
    //     });
    // }

    /**
     * Get the company that the user belongs to.
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'empresa_id');
    }
}
