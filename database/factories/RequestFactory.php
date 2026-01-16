<?php

namespace Database\Factories;

use App\Models\Request;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Request::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = $this->faker->randomElement(['pending', 'verified', 'processing', 'ready', 'completed', 'rejected']);

        return [
            // 'tracking_id' is generated automatically by the model
            'email' => $this->faker->unique()->safeEmail,
            'contact_number' => $this->faker->phoneNumber,
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->lastName, // Using lastName for middle name for simplicity
            'last_name' => $this->faker->lastName,
            'lrn' => $this->faker->unique()->numerify('############'), // 12-digit LRN
            'grade_level' => $this->faker->numberBetween(7, 12),
            'section' => $this->faker->word,
            'track_strand' => $this->faker->randomElement(['Academic', 'TVL', 'Sports', 'Arts and Design']),
            'school_year_last_attended' => $this->faker->year,
            'document_type_id' => $this->faker->numberBetween(1, 5), // Assuming 5 document types exist
            'purpose' => $this->faker->sentence,
            'signature' => $this->faker->imageUrl(), // Placeholder for a signature image URL
            'quantity' => $this->faker->numberBetween(1, 3),
            'status' => $status,
            'estimated_completion_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'admin_remarks' => $this->faker->optional()->sentence,
            'internal_notes' => $this->faker->optional()->sentence,
            'processed_by' => ($status !== 'pending') ? \App\Models\User::all()->random()->id : null,
        ];
    }
}
