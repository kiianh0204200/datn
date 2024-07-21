<?php

namespace App\Enum;

enum ProductCondition: string
{
    case New = 'new';
    case Hot = 'hot';
    case BestSeller = 'best_sale';
}
