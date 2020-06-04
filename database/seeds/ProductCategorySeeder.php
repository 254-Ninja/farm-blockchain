<?php

use App\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = new ProductCategory();
        $cat->name = 'Animal Feeds';
        $cat->display_name = 'Animal';
        $cat->save();

        $cat = new ProductCategory();
        $cat->name = 'Farm Produce';
        $cat->display_name = 'Farm';
        $cat->save();
    }
}
