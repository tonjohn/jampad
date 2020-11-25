<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\UserProduct;

class UserProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nickname' => $this->faker->word,
            'description' => $this->faker->text,
            'make' => $this->faker->word,
            'model' => $this->faker->word,
            'sku' => $this->faker->word,
            'serial_number' => $this->faker->word,
            'category' => $this->faker->word,
            'location' => $this->faker->word,
            'created_by' => User::factory()->create()->created_by,
            'updated_by' => User::factory()->create()->updated_by,
        ];
    }
}
