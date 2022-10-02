<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Controllers\Income\DTO\InputStoreIncomeDTO;
use App\Models\Income;
use App\Repositories\Interfaces\IncomeRepositoryInterface;

class IncomeRepository implements IncomeRepositoryInterface
{
    public function createIncome(InputStoreIncomeDTO $InputDTO): void
    {
        Income::create([
            'value' => $InputDTO->value,
            'description' => $InputDTO->description,
            'date' => $InputDTO->date,
        ]);
    }

    public function validForCreateIncome(string $description, string $monthDate): bool
    {
        return Income::where('description', 'like', '%' . $description . '%')
            ->whereMonth('date', $monthDate)
            ->exists();
    }
}
