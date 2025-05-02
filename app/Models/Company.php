<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Company extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'website',
        'logo',
        'description',
    ];

    protected $keyType = 'string'; // Indicar que el id es un string (UUID)
    public $incrementing = false; // No usar auto incrementos

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($company) {
            // Si no tiene id, generar un UUID
            if (!$company->id) {
                $company->id = Str::uuid()->toString();
            }
        });
    }


    public function users()
    {
        return $this->hasMany(User::class);
    }
}
