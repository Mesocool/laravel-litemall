<?php

namespace App\Models\Goods;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Goods extends BaseModel
{

    protected $table = 'goods';

    const UPDATED_AT = 'update_time';

    const CREATED_AT = 'add_time';

    protected $guarded = [];

    protected $casts = [
        'deleted' => 'boolean',
        'counter_price' => 'float',
        'retail_price' => 'float',
        'is_new' => 'boolean',
        'is_hot' => 'boolean',
        'gallery' => 'array',
        'is_on_sale' => 'boolean',
    ];
}