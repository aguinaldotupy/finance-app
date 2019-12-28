<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthProvider extends Model
{
    protected $table = 'auth_providers';

    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'auth_provider_user', 'provider_id', 'user_id');
    }
}
