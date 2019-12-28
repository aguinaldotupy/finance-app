<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tupy\AddressesManager\Traits\HasAddress;

class Company extends Model
{
    use HasAddress;

    protected $table = 'companies';

    protected $fillable = [
        'name', 'trading', 'person_type', 'number_social', 'business_type'
    ];
}
