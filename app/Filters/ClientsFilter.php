<?php

namespace App\Filters;

use App\Dto\ClientsExportDto;
use Illuminate\Database\Query\Builder;

final readonly class ClientsFilter implements IFilter
{
    public function __construct(private ClientsExportDto $filterDto)
    {

    }

    public function apply(Builder|\Illuminate\Contracts\Database\Eloquent\Builder $builder): Builder|\Illuminate\Contracts\Database\Eloquent\Builder
    {
        if (!empty($this->filterDto->name)) {
            $builder->where('name', 'like', '%' . $this->filterDto->name . '%');
        }
        if (!empty($this->filterDto->pass_id)) {
            $builder->where('pass_id', $this->filterDto->pass_id);
        }
        if (!empty($this->filterDto->id)) {
            $builder->where('id', $this->filterDto->id);
        }
        if (!empty($this->filterDto->phone)) {
            $builder->whereJsonContains('phones', $this->filterDto->phone);
        }
        $builder->orderBy('id', 'desc');

        return $builder;
    }
}
