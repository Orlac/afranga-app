<?php

namespace App\Filters;

use App\Dto\BaseDto;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;

interface IFilter
{
    public function __construct(BaseDto $dto);

    public function apply(Builder|\Illuminate\Contracts\Database\Eloquent\Builder $builder, BaseDto $inputs): Builder|\Illuminate\Contracts\Database\Eloquent\Builder;
}
