<?php

namespace App\Exports;

use App\Models\Clients;
use Illuminate\Database\Eloquent\Builder;
use Iterator;
use Maatwebsite\Excel\Concerns\FromIterator;

readonly class ClientsExport implements FromIterator
{
    public function __construct(private \Illuminate\Contracts\Database\Query\Builder|Builder $queryBuilder)
    {

    }

    public function headings(): array
    {
        return [
            '#',
            'Pass Id',
            'Name',
            'Phones',
        ];
    }

    /**
     * @return Iterator
     */
    public function iterator(): Iterator
    {
        $models = $this->queryBuilder->get();
        /** @var Clients $model */
        foreach ($models as $model) {
            yield $model->toArray();
        }
    }

}
