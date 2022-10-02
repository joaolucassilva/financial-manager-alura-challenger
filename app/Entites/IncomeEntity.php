<?php

declare(strict_types=1);

namespace App\Entites;

use App\Exceptions\IncomeCreateHasExistException;
use App\Http\Controllers\Income\DTO\InputStoreIncomeDTO;
use App\Repositories\Interfaces\IncomeRepositoryInterface;
use Carbon\Carbon;

class IncomeEntity
{
    public function __construct(
        private readonly IncomeRepositoryInterface $repository
    ) {
    }

    /**
     * @throws IncomeCreateHasExistException
     */
    public function create(InputStoreIncomeDTO $inputDTO): void
    {
        $incomeHasExist = $this->repository->validForCreateIncome(
            description: $inputDTO->description,
            monthDate: Carbon::createFromFormat('Y/m/d', $inputDTO->date)->format('m')
        );
        if ($incomeHasExist) {
            throw new IncomeCreateHasExistException(
                message: 'Já existe uma Receita criada com esta descricão para o mês desejado'
            );
        }
        $this->repository->createIncome($inputDTO);
    }
}
