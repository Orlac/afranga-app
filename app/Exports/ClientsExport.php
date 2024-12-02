<?php

namespace App\Exports;

use App\Models\Clients;
use Illuminate\Database\Eloquent\Builder;
use Iterator;
use Maatwebsite\Excel\Concerns\FromIterator;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

readonly class ClientsExport implements FromIterator, ShouldAutoSize, WithHeadings, WithMapping
{
    public function __construct(private \Illuminate\Contracts\Database\Query\Builder|Builder $queryBuilder)
    {

    }

    public function map(mixed $model): array
    {
        /** @var Clients $model */
        return [
            $model->id,
            $model->pass_id,
            $model->name,
            implode(', ', $model->phones),
            date('d.m.Y H:i:s', strtotime($model->created_at)),
            date('d.m.Y H:i:s', strtotime($model->updated_at)),
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Pass Id',
            'Name',
            'Phones',
            'created_at',
            'updated_at',
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
            yield $model;
        }
    }

}
