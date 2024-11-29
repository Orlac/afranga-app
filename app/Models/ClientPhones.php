<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientPhones extends Model
{
    public function client(): BelongsTo
    {
        return $this->belongsTo(Clients::class, 'client_id', 'id');
    }
}
