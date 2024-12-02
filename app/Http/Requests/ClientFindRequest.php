<?php

namespace App\Http\Requests;

use Closure;
use App\Models\Clients;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

final class ClientFindRequest extends FormRequest
{
    private ?Clients $client = null;

    public function getClient(): ?Clients
    {
        return $this->client;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
            'id' => [
                function (string $attribute, mixed $value, Closure $fail) {
                    $this->client = Clients::where('id', $value)->first();
                }],
        ];
    }
}
