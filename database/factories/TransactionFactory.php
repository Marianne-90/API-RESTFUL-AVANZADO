<?php

namespace Database\Factories;

use App\Models\Seller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Transaction::class;

    public function definition(): array
    {
        $vendedor = Seller::has('products')->get()->random();
        $comprador = User::all()->except($vendedor->id)->random();

        return [
            'quantity' => $this->faker->numberBetween(1, 3),
            'buyer_id' => $comprador->id,
            'product_id' => $vendedor->products->random()->id,
        ];
    }
}
