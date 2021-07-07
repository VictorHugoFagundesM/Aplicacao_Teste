<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //

        $sizes = [
            ["id" => 1, "name" => "PP"],
            ["id" => 2, "name" => "P"],
            ["id" => 3, "name" => "M"],
            ["id" => 4, "name" => "G"],
            ["id" => 5, "name" => "GG"],
        ];

        // Size::truncate();
        Size::insert($sizes);
    }
}
