<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Closure;;

class ClientStoreRequest extends FormRequest
{
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
            'pass_id' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'phones' => ['required'],
            'phones' => ['array'],
            'phones' => [
                function (string $attribute, mixed $value, Closure $fail) {
                    $phones = array_filter( array_slice($value, 0, env('CLIENTS_MAX_PHONE_COUNT')));
                    foreach ($phones as $phone) {
                        if (!is_numeric($phone)) {
                            $fail("The {$attribute} {$phone} is invalid.");
                        }
                    }
            }],
        ];
    }

    public function validated($key = null, $default = null): array
    {
        $validated = parent::validated();
        if (!empty($validated['phones'])) {
            $validated['phones'] = array_slice(
                array_values(array_filter($validated['phones'])),
                0,
                env('CLIENTS_MAX_PHONE_COUNT')
            );
        }
        return $validated;
    }
}
