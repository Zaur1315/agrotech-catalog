<?php
declare(strict_types=1);

namespace App\Http\Requests\Lead;

use App\Models\Lead;
use Illuminate\Foundation\Http\FormRequest;

final class StoreContactLeadRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'max:255',
            ],
            'preferred_contact_method' => [
                'nullable',
                'string',
                'in:' . implode(',', [
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
            'subject' => [
                'nullable',
                'string',
                'max:255',
            ],
            'message' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ];
    }
}
