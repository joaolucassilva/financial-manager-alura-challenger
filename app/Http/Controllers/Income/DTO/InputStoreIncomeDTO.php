<?php

declare(strict_types=1);

namespace App\Http\Controllers\Income\DTO;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class InputStoreIncomeDTO extends DataTransferObject
{
    #[MapFrom('value')]
    public int $value;

    #[MapFrom('description')]
    public string $description;

    #[MapFrom('date')]
    public string $date;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(Request $request): self
    {
        return new self([
            'value' => $request->get('value'),
            'description' => $request->get('description'),
            'date' => Carbon::createFromFormat('Y/m/d', $request->get('date'))->format('Y/m/d'),
        ]);
    }
}
