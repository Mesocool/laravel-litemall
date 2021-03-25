<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $table = 'address';

    const UPDATED_AT = 'update_time';

    const CREATED_AT = 'add_time';

    protected $guarded = [];

    protected $casts = [
        'deleted' => 'boolean',
        'is_default' => 'boolean',
    ];
}
