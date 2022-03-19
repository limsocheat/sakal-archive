<?php

namespace Modules\Blog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Blog\Models\Post;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Blog\Models\Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'                => $this->faker->id,
            'uuid'              => $this->faker->uuid,
            'title'             => $this->faker->sentence,
            'content'           => $this->faker->paragraph,
            'status'            => $this->faker->randomElement([
                Post::STATUS_DRAFT,
                Post::STATUS_PUBLISHED,
            ]),
            'format'            => $this->faker->randomElement([
                Post::FORMAT_STANDARD,
                Post::FORMAT_VIDEO,
                Post::FORMAT_AUDIO,
            ]),
            'published_at'          => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'featured_image_url'    => $this->faker->imageUrl(),
        ];
    }
}
