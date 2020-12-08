<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'school' => $this->faker->colorName . " " . $this->faker->name,
            'amount' => $this->faker->numberBetween(1000, 35000),
            'description' => $this->faker->text(25),
            'status' => $payed = $this->faker->boolean,
            'uri' => Str::random(30),
            'payer' => ($payed) ? $this->faker->name : null
        ];
    }
}
