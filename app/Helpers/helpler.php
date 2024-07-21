<?php

if (!function_exists('productDiscount')) {
    function productDiscount($price, $discount): string
    {
        $discountedPrice = $price - ($price * $discount / 100);
        return number_format(round($discountedPrice, 2), 0, '', '.');
    }
}
if (!function_exists('subTotal')) {
    function subTotal($price, $quantity): string
    {
        $subTotal = $price * $quantity;
        return number_format(round($subTotal, 2), 0, '', '.'); // Làm tròn giá trị đến 2 chữ số thập phân
    }
}

if (!function_exists('formatPrice')) {
    function formatPrice($price): string
    {
        return number_format($price, 0, '', '.'); // Làm tròn giá trị đến 2 chữ số thập phân
    }
}

if (!function_exists('convertRatingToPercentage')) {
    function convertRatingToPercentage($rating): float
    {
        $percentage = (($rating - 1) / 4) * 90 + 10;
        return round(number_format($percentage, 0, ',', '.')); // Làm tròn phần trăm đến số nguyên gần nhất
    }
}
if (!function_exists('calculateRatingPercentage')) {
    function calculateRatingPercentage($ratings): array
    {
        $totalRatings = count($ratings);
        $starCounts = array_fill(0, 5, 0); // Tạo một mảng có 5 phần tử ban đầu đều là 0

        foreach ($ratings as $rating) {
            if ($rating >= 1 && $rating <= 5) {
                $starCounts[$rating - 1]++;
            }
        }

        $percentage = array();
        for ($i = 0; $i < 5; $i++) {
            $ratingPercentage = ($starCounts[$i] / $totalRatings) * 100;
            $percentage[$i] = round($ratingPercentage, 1);
        }

        return $percentage;
    }
}
