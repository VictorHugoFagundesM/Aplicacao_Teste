<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$categories = [
            [ "name" => "Blusa"],
            [ "name" => "Calça"],
            [ "name" => "Short"],
            [ "name" => "Camiseta"],
            [ "name" => "Acessório"],
            [ "name" => "Roupa íntima"],
        ];*/

        Category::truncate();
        //Category::insert($categories);*/

        Category::factory()->count(1000)->create();

    }
}
