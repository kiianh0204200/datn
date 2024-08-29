<?php

namespace App\Enums;

enum DiscountType: string
{
    case PERCENTAGE = 'percentage';
    case FIXED_AMOUNT = 'fixed_amount';

    public static function getValues(): array
    {
        return [
            self::PERCENTAGE->value,
            self::FIXED_AMOUNT->value,
        ];
    }
}
