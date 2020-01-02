<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Account.
 *
 * @property int $id
 * @property string $name
 * @property int $owner_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @property float $balance
 * @property string|null $currency
 * @property-read Entity $entity
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereCurrency($value)
 * @property int|null $entity_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereEntityId($value)
 */
class Account extends Model
{
    protected $table = 'bank_accounts';

    protected $fillable = [
        'name', 'entity_id', 'owner_id', 'currency', 'balance',
    ];

    protected $with = ['entity'];

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'bank_account_user', 'account_id', 'user_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'account_id', 'id');
    }
}
