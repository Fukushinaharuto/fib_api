<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FibonacciRequest extends FormRequest
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

    // バリデーション設定
    public function rules(): array
    {
        return [
            'n' => [
                'required',
                'integer',
                'min:1',
            ]
        ];
    }

    // バリデーションエラーのメッセージ
    public function messages()
    {
        return [
            'n.required' => 'nは必須です。',
            'n.integer' => 'nは整数にしてください。',
            'n.min' => 'nは正の数にしてください。',
        ];
    }
}
