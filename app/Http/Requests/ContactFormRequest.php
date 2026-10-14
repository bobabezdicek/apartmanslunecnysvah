<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:180'],
            'message' => ['required', 'string', 'min:10', 'max:4000'],
            'website' => ['nullable', 'prohibited'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => __('site.contact.fields.name'),
            'email' => __('site.contact.fields.email'),
            'message' => __('site.contact.fields.message'),
            'website' => __('site.contact.fields.website'),
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => __('site.contact.validation.name_required'),
            'name.min' => __('site.contact.validation.name_min'),
            'name.max' => __('site.contact.validation.name_max'),
            'email.required' => __('site.contact.validation.email_required'),
            'email.email' => __('site.contact.validation.email_email'),
            'email.max' => __('site.contact.validation.email_max'),
            'message.required' => __('site.contact.validation.message_required'),
            'message.min' => __('site.contact.validation.message_min'),
            'message.max' => __('site.contact.validation.message_max'),
            'website.prohibited' => __('site.contact.validation.website_prohibited'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(response()->json([
                'message' => __('site.contact.validation_failed'),
                'errors' => $validator->errors()->toArray(),
            ], 422));
        }

        parent::failedValidation($validator);
    }
}
