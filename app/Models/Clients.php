<?php

namespace App\Models;

use Database\Factories\ClientsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    /** @use HasFactory<ClientsFactory> */
    use HasFactory;
}
