<?php

namespace Database\Factories;

use App\Models\Accommodation;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accommodation>
 */
class AccommodationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Accommodation::class;

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Accommodation $accommodation) {
            //
        })->afterCreating(function (Accommodation $accommodation) {
            // use faker to create 1 fake image
            $image = Image::factory()->create([
                'imageable_id' => $accommodation->id,
                'imageable_type' => Accommodation::class
            ]);
            $accommodation->images()->save($image);
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(7),
            'description' => $this->faker->text(),
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'wifi' => $this->faker->boolean(),
            'price' => $this->faker->randomFloat(2, 100, 2000),
            'bed' => $this->faker->numberBetween(1, 5),
            'amenities' => $this->faker->sentence(50),
            'host_id' => User::first()
        ];
    }
}

