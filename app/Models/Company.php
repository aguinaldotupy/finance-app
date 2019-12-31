<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tupy\AddressesManager\Traits\HasAddress;
use Tupy\Contacts\Traits\HasContacts;

/**
 * App\Models\Company.
 *
 * @property int $id
 * @property string $name
 * @property string $trading
 * @property string $person_type
 * @property string $number_social
 * @property string $business_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Tupy\AddressesManager\Models\Address $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\Tupy\AddressesManager\Models\Address[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \Tupy\Contacts\Models\Contact $contact
 * @property-read \Illuminate\Database\Eloquent\Collection|\Tupy\Contacts\Models\Contact[] $contacts
 * @property-read int|null $contacts_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereBusinessType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereNumberSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company wherePersonType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereTrading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|Transaction[] $transactions
 * @property-read int|null $transactions_count
 */
class Company extends Model
{
    use HasAddress;
    use HasContacts;

    protected $table = 'companies';

    protected $fillable = [
        'name', 'trading', 'person_type', 'number_social', 'business_type',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'company_id', 'id');
    }
}
