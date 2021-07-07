<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $colors = [
            ["id" => 1, "name" => "Branco"],
            ["id" => 2, "name" => "Cinza"],
            ["id" => 3, "name" => "Preto"],
            ["id" => 4, "name" => "Azul"],
            ["id" => 5, "name" => "Vermelho"],
            ["id" => 6, "name" => "Amarelo"],
        ];

        Color::truncate();
        Color::insert($colors);
    }
}
