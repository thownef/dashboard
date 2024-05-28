<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MemberRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'member_img' => 'required',
            'member_name' => [
                'required',
                'json',
                function ($attribute, $value, $fail) {
                    $this->validateJsonLanguage($attribute, $value, $fail);
                }
            ],
            'member_position' => [
                'required',
                'json',
                function ($attribute, $value, $fail) {
                    $this->validateJsonLanguage($attribute, $value, $fail);
                }
            ],
            'member_desc' => [
                'required',
                'json',
                function ($attribute, $value, $fail) {
                    $this->validateJsonLanguage($attribute, $value, $fail);
                }
            ],
        ];
    }
    private function validateJsonLanguage($attribute, $value, $fail)
    {
        $languages = ['vi', 'en', 'ja'];
        $decodedData = json_decode($value, true);

        if ($decodedData === null) {
            $fail('The ' . $attribute . ' must be a valid JSON string.');
            return;
        }

        foreach ($languages as $language) {
            if (!array_key_exists($language, $decodedData)) {
                $fail('The ' . $attribute . ' must contain the ' . $language . ' language.');
                return;
            }
        }
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
