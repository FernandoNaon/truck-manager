<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition()
    {
        $truckModels = ['ThunderHauler', 'ApexTruck', 'TitanRoadmaster', 'MegaMover', 'BlazeRunner'];
        $randomModel = $truckModels[array_rand($truckModels)];

        return [
            'name' => $randomModel,
            'price' => $this->faker->numberBetween(1000, 10000),
            'speed' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'fuel_cons' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'acceleration' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'has_owner' => false,
        ];
    }
}
