<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Http\Controllers\Income\DTO\InputStoreIncomeDTO;

interface IncomeRepositoryInterface
{
    public function createIncome(InputStoreIncomeDTO $InputDTO): void;

    public function validForCreateIncome(string $description, string $monthDate): bool;
}
