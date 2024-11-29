<?php

namespace App\Models;

use App\Casts\Json;
use Database\Factories\ClientsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/** @property int $id */
/** @property int $pass_id */
/** @property name $name */
/** @property int[] $phones */
/** @property int[] $lastPhones */
class Clients extends Model
{
    /** @use HasFactory<ClientsFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'pass_id',
        'name',
        'phones',
    ];

    protected function casts(): array
    {
        return [
            'phones' => Json::class,
            'lastPhones' => function ($model) {
                return implode(', ', array_slice(array_reverse($model->phones), 0, 2)) ;
            },
        ];
    }

    public function getLastPhones(): array
    {
        return array_slice(array_reverse(json_decode($this->phones, true)), 0, 2);
    }

}
