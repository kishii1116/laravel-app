<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnqueteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'sex' => 'required',
            'age' => 'required',
            'mail' => 'required|max:100',
            'comment' => 'required|max:400',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attributeを入力してください。',
            'name.max' => ':attributeは:max文字以内で入力してください。',
            'sex.required' => ':attributeを入力してください。',
            'age.required' => ':attributeを入力してください。',
            'mail.required' => ':attributeを入力してください。',
            'mail.max' => ':attributeは:max文字以内で入力してください。',
            'comment.required' => ':attributeを入力してください。',
            'comment.max' => ':attributeは:max文字以内で入力してください。',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '氏名',
            'sex' => '性別',
            'age' => '年代',
            'mail' => 'メールアドレス',
            'comment' => 'ご意見',
        ];
    }
}
