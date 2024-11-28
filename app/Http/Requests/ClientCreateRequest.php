<?php

namespace App\Http\Requests;

use App\Models\Clients;

class ClientCreateRequest extends ClientStoreRequest
{
    public function validated($key = null, $default = null): array
    {
        $validated = parent::validated();
        $validated['id'] = Clients::query()->max('id') + 1;
        return $validated;
    }
}
