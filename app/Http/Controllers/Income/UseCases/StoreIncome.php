<?php

declare(strict_types=1);

namespace App\Http\Controllers\Income\UseCases;

use App\Entites\IncomeEntity;
use App\Exceptions\IncomeCreateHasExistException;
use App\Http\Controllers\Income\DTO\InputStoreIncomeDTO;
use App\Http\Controllers\Income\UseCases\Interfaces\StoreIncomeInterface;

class StoreIncome implements StoreIncomeInterface
{
    public function __construct(
        private readonly IncomeEntity $incomeEntity
    ) {
    }

    /**
     * @throws IncomeCreateHasExistException
     */
    public function create(InputStoreIncomeDTO $inputDTO): void
    {
        $this->incomeEntity->create($inputDTO);
    }
}
