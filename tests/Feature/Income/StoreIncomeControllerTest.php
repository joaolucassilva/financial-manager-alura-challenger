<?php

declare(strict_types=1);

namespace Income;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreIncomeControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testWhenAllParameterIsEmptyShouldReturnErrors(): void
    {
        $this->post('/api/incomes', [])->assertStatus(400)
            ->assertExactJson([
                'success' => false,
                'message' => 'Ops! Some errors ocurred',
                'errors' => [
                    'description' => [
                        0 => 'The description field is required.'
                    ],
                    'value' => [
                        0 => 'The value field is required.'
                    ],
                    'date' => [
                        0 => 'The date field is required.'
                    ],

                ]
            ]);
    }

    public function testWhenValueIsEmptyShouldReturnError(): void
    {
        $this->post('/api/incomes', [
            'description' => $this->faker->text(255),
            'date' => Carbon::now()->format('Y/m/d'),
        ])->assertStatus(400)
            ->assertExactJson([
                'success' => false,
                'message' => 'Ops! Some errors ocurred',
                'errors' => [
                    'value' => [
                        0 => 'The value field is required.'
                    ]
                ]
            ]);
    }

    public function testWhenDescriptionIsEmptyShouldReturnError(): void
    {
        $this->post('/api/incomes', [
            'value' => 110,
            'date' => Carbon::now()->format('Y/m/d')
        ])->assertStatus(400)
            ->assertExactJson([
                'success' => false,
                'message' => 'Ops! Some errors ocurred',
                'errors' => [
                    'description' => [
                        0 => 'The description field is required.'
                    ]
                ]
            ]);
    }

    public function testWhenDescriptionIsMore255CharactersShouldReturnError(): void
    {
        $this->post('/api/incomes', [
            'value' => 110,
            'date' => Carbon::now()->format('Y/m/d'),
            'description' => $this->faker->realTextBetween(256, 300),
        ])->assertStatus(400)
            ->assertExactJson([
                'success' => false,
                'message' => 'Ops! Some errors ocurred',
                'errors' => [
                    'description' => [
                        0 => 'The description must not be greater than 255 characters.'
                    ]
                ]
            ]);
    }

    public function testWhenDateIsEmptyShouldReturnError(): void
    {
        $this->post('/api/incomes', [
            'description' => $this->faker->text(255),
            'value' => 110,
        ])->assertStatus(400)
            ->assertExactJson([
                'success' => false,
                'message' => 'Ops! Some errors ocurred',
                'errors' => [
                    'date' => [
                        0 => 'The date field is required.'
                    ]
                ]
            ]);
    }

    public function testWhenDateIsInvalidShouldReturnError(): void
    {
        $this->post('/api/incomes', [
            'description' => $this->faker->text(255),
            'value' => 110,
            'date' => 12313,
        ])->assertStatus(400)
            ->assertExactJson([
                'success' => false,
                'message' => 'Ops! Some errors ocurred',
                'errors' => [
                    'date' => [
                        0 => 'The date is not a valid date.',
                        1 => 'The date does not match the format Y/m/d.'
                    ]
                ]
            ]);
    }

    public function testWhenDateIsFormatInvalidShouldReturnError(): void
    {
        $this->post('/api/incomes', [
            'description' => $this->faker->text(255),
            'value' => 110,
            'date' => Carbon::now()->format('d/m/Y')
        ])->assertStatus(400)
            ->assertExactJson([
                'success' => false,
                'message' => 'Ops! Some errors ocurred',
                'errors' => [
                    'date' => [
                        0 => 'The date does not match the format Y/m/d.'
                    ]
                ]
            ]);
    }

    public function testWhenAllParametersIsValidShouldReturnStatus201(): void
    {
        $this->post('/api/incomes', [
            'description' => $this->faker->text(255),
            'value' => 700,
            'date' => Carbon::now()->format('Y/m/d')
        ])->assertStatus(201);
    }
}
