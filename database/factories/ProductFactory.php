<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoryId = Category::get()->random()->id;
        $size_id = Size::get()->random()->id;
        $color_id= Color::get()->random()->id;

        return [
            'name'=> $this->faker->firstName,
            'price'=> $this->faker->buildingNumber,
            'amount'=> $this->faker->buildingNumber,
            'description'=> $this->faker->text($maxNbChars = 35),
            'category_id'=> $categoryId,
            'size_id'=> $size_id,
            'color_id'=> $color_id,
        ];
    }
}
