<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table = 'financial_incomes';
    
    protected $fillable = [
        'value',
        'description',
        'date'
    ];
}
