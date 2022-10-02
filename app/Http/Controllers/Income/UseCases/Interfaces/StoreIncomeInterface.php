<?php

declare(strict_types=1);

namespace App\Http\Controllers\Income\UseCases\Interfaces;

use App\Exceptions\IncomeCreateHasExistException;
use App\Http\Controllers\Income\DTO\InputStoreIncomeDTO;

interface StoreIncomeInterface
{
    /**
     * @throws IncomeCreateHasExistException
     */
    public function create(InputStoreIncomeDTO $inputDTO): void;
}
