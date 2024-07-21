<?php

namespace Database\Seeders;

use App\Models\ProductOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductOption::create([
            'name' => 'Blue',
            'type' => 'color',
            'value' => 'blue',
        ]);

        ProductOption::create([
            'name' => 'Red',
            'type' => 'color',
            'value' => 'red',
        ]);

        ProductOption::create([
            'name' => 'Green',
            'type' => 'color',
            'value' => 'green',
        ]);

        ProductOption::create([
            'name' => 'Yellow',
            'type' => 'color',
            'value' => 'yellow',
        ]);

        ProductOption::create([
            'name' => 'Black',
            'type' => 'color',
            'value' => 'black',
        ]);

        ProductOption::create([
            'name' => 'White',
            'type' => 'color',
            'value' => 'white',
        ]);

        ProductOption::create([
            'name' => 'Pink',
            'type' => 'color',
            'value' => 'pink',
        ]);

        ProductOption::create([
            'name' => 'Purple',
            'type' => 'color',
            'value' => 'purple',
        ]);

        ProductOption::create([
            'name' => 'Orange',
            'type' => 'color',
            'value' => 'orange',
        ]);

        ProductOption::create([
            'name' => 'Brown',
            'type' => 'color',
            'value' => 'brown',
        ]);

        ProductOption::create([
            'name' => 'Gray',
            'type' => 'color',
            'value' => 'gray',
        ]);

        ProductOption::create([
            'name' => 'XS',
            'type' => 'size',
            'value' => 'xs',
        ]);

        ProductOption::create([
            'name' => 'S',
            'type' => 'size',
            'value' => 's',
        ]);

        ProductOption::create([
            'name' => 'M',
            'type' => 'size',
            'value' => 'm',
        ]);

        ProductOption::create([
            'name' => 'L',
            'type' => 'size',
            'value' => 'l',
        ]);

        ProductOption::create([
            'name' => 'XL',
            'type' => 'size',
            'value' => 'xl',
        ]);

        ProductOption::create([
            'name' => 'XXL',
            'type' => 'size',
            'value' => 'xxl',
        ]);
    }
}
