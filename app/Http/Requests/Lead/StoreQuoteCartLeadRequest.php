<?php

declare(strict_types=1);

namespace App\Http\Requests\Lead;

use App\Models\Lead;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

final class StoreQuoteCartLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'website' => [
                'nullable',
                'string',
                'max:255',
            ],
            'fbp' => ['nullable', 'string', 'max:255'],
            'fbc' => ['nullable', 'string', 'max:255'],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'regex:/^\D*(\d\D*){10}$/',
                'max:30',
            ],
            'zip_code' => [
                'required',
                'string',
                'regex:/^\d{5}$/',
            ],
            'consent_accepted' => [
                'accepted',
            ],
            'preferred_contact_method' => [
                'nullable',
                'string',
                'in:'.implode(',', [
                    Lead::PREFERRED_CONTACT_PHONE,
                    Lead::PREFERRED_CONTACT_EMAIL,
                    Lead::PREFERRED_CONTACT_ANY,
                ]),
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
            ],
            'message' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            if ($this->filled('website')) {
                $validator->errors()->add('website', 'Invalid form submission.');
            }
        });
    }
}
