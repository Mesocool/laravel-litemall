<?php

namespace App\Models\Goods;

use App\Models\BaseModel;

class GoodsProduct extends BaseModel
{

    protected $table = 'goods_product';

    const UPDATED_AT = 'update_time';

    const CREATED_AT = 'add_time';

    protected $guarded = [];

    protected $casts = [
        'deleted' => 'boolean',
    ];
}