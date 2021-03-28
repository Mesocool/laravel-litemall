<?php

namespace App\Models\Goods;

use App\Models\BaseModel;

class GoodsAttribute extends BaseModel
{

    protected $table = 'goods_attribute';

    const UPDATED_AT = 'update_time';

    const CREATED_AT = 'add_time';

    protected $guarded = [];

    protected $casts = [
        'deleted' => 'boolean',
    ];
}