<?php

namespace App\Exports;

use App\Models\Clients;
use Illuminate\Foundation\Http\FormRequest;
use Iterator;
use Maatwebsite\Excel\Concerns\FromIterator;

class ClientsExport implements FromIterator
{
    public function __construct(private readonly FormRequest $request)
    {

    }

    /**
     * @return Iterator
     */
    public function iterator(): Iterator
    {
        $models = Clients::
            orderBy('name')
//            ->take(10)
            ->get();
        /** @var Clients $model */
        foreach ($models as $model) {
            yield $model->toArray();
        }
    }

}
