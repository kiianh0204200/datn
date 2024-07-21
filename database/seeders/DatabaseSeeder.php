<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(RolesPermissionsSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductOptionSeeder::class);
        $this->call(PostCategorySeeder::class);
        Product::create([
            'brand_id' => 1,
            'product_category_id' => 1,
            'name' => 'Product 1',
            'subtitle' => 'Product 1 subtitle',
            'description' => 'Product 1 description',
            'sku' => 'product-1',
            'slug' => 'product-1',
            'price' => 100,
            'condition' => 'new',
            'is_active' => true,
            'discount' => 0,
            'thumbnail' => 'product-1.jpg',
        ]);
        $this->call(ProductCommentSeeder::class);
    }
}
