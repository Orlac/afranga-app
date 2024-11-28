<?php

namespace App\Filters;

use App\Dto\BaseDto;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;

interface IFilter
{
    public function apply(Builder|\Illuminate\Contracts\Database\Eloquent\Builder $builder): Builder|\Illuminate\Contracts\Database\Eloquent\Builder;
}
