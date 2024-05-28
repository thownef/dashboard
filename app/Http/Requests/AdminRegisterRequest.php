<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisterRequest extends FormRequest
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
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password|string'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Hãy nhập tên của bạn',
            'email.required' => 'Hãy nhập email của bạn',
            'email.email' => 'Email không đúng định dạng. Vd: abc@xyz.com',
            'password.required' => 'Hãy nhập mật khẩu của bạn',
            'confirm_password.required' => 'Bạn chưa nhập lại mật khẩu',
            'confirm_password.same' => 'Mật khẩu không khớp',
        ];
    }
}
