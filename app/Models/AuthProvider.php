<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AuthProvider.
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|AuthProvider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthProvider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthProvider query()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthProvider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthProvider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthProvider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthProvider whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AuthProvider extends Model
{
    protected $table = 'auth_providers';

    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'auth_provider_user', 'provider_id', 'user_id');
    }
}
