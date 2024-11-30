<?php

namespace App\Filters;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;

interface IFilter
{
    public function apply(Builder|\Illuminate\Contracts\Database\Eloquent\Builder $builder, FormRequest $request): Builder|\Illuminate\Contracts\Database\Eloquent\Builder;
}
