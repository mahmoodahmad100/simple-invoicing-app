<?php

namespace Core\Sale\Database\Factories;

use Core\Sale\Models\Invoice as Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product' => $this->faker->text(100),
        ];
    }
}
