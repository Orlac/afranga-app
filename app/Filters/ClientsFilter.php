<?php

namespace App\Filters;

use App\Dto\ClientsExportDto;
use App\Http\Requests\ClientsFilterRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;

class ClientsFilter implements IFilter
{

    public function apply(Builder|\Illuminate\Contracts\Database\Eloquent\Builder $builder, ClientsExportDto $inputs): Builder|\Illuminate\Contracts\Database\Eloquent\Builder
    {
//        if (!empty($inputs['name'])) {
//            $builder->where('name', 'like', '%' . $inputs['name'] . '%');
//        }
//        if (!empty($inputs['pass_id'])) {
//            $builder->where('pass_id', $inputs['pass_id']);
//        }
//        if (!empty($inputs['id'])) {
//            $builder->where('id', $inputs['id']);
//        }
//        if (!empty($inputs['phone'])) {
//            $builder->whereJsonContains('phones', $inputs['phone']);
//        }
        $builder->orderBy('id', 'desc');

        return $builder;
    }
}
