<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
                'max:1000',
            ]
        ];
    }

    // バリデーションエラーのメッセージ
    public function messages()
    {
        return [
            'n.required' => 'nは必須です。',
            'n.integer' => 'nは整数である必要があります。',
            'n.min' => 'nは1以上である必要があります。',
            'n.max' => 'nを1000以下にする必要があります。', 
        ];
    }

    // バリデーションに引っかかった場合は、エラーをレスポンスする。
    // リダイレクトをしていたのは、laravelの仕様でしたのでオーバーライドを行い、errorが入ったmessageのjsonが返されるように修正
    function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->first();
        throw new HttpResponseException(response()->json([
            'message' => $errors
        ], 400, [], JSON_UNESCAPED_UNICODE));
    }
}
