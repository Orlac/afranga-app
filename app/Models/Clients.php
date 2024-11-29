<?php

namespace App\Models;

use Database\Factories\ClientsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clients extends Model
{
    /** @use HasFactory<ClientsFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'pass_id',
        'name',
    ];

    public function phones(): HasMany
    {
        return $this->hasMany(ClientPhones::class, 'client_id', 'id');
    }
}
