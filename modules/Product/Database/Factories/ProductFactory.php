<?php

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Product\Models\Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->name,
            'description'   => $this->faker->text,
            'type'          => $this->faker->randomElement([
                \Modules\Product\Models\Product::TYPE_SIMPLE,
                \Modules\Product\Models\Product::TYPE_VARIABLE,
            ]),
            'weight'        => $this->faker->randomFloat(2, 0, 100),
            'price'         => $this->faker->randomFloat(2, 0, 100),
            'sale_price'    => $this->faker->randomFloat(2, 0, 100),
            'active'        => $this->faker->boolean,
        ];
    }
}
