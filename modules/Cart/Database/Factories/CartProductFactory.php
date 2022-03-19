<?php
namespace Modules\Cart\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CartProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Cart\Models\CartProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }
}

