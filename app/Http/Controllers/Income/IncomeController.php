<?php

declare(strict_types=1);

namespace App\Http\Controllers\Income;

use App\Exceptions\IncomeCreateHasExistException;
use App\Helpers\ResponseError;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Income\DTO\InputStoreIncomeDTO;
use App\Http\Controllers\Income\UseCases\Interfaces\StoreIncomeInterface;
use App\Http\Requests\Income\StoreIncomeRequest;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class IncomeController extends Controller
{
    public function __construct(
        private readonly StoreIncomeInterface $storeIncome
    ) {
    }

    /**
     * @param StoreIncomeRequest $request
     * @return JsonResponse
     * @throws UnknownProperties
     */
    public function store(StoreIncomeRequest $request): JsonResponse
    {
        try {
            $outputDTO = InputStoreIncomeDTO::fromRequest($request);
            $this->storeIncome->create($outputDTO);
            return response()->json(data: [], status: 201);
        } catch (IncomeCreateHasExistException $e) {
            return ResponseError::get(
                data: [
                    'income' => [
                        0 => $e->getMessage()
                    ],
                ],
                status: 400
            );
        }
    }
}
