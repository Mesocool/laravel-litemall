<?php

namespace App\Models\Goods;

use App\Models\BaseModel;

class GoodsSpecification extends BaseModel
{

    protected $table = 'goods_specification';

    const UPDATED_AT = 'update_time';

    const CREATED_AT = 'add_time';

    protected $guarded = [];

    protected $casts = [
        'deleted' => 'boolean',
    ];
}