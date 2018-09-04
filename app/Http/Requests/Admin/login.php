<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class login extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            //
            'username'=>'required',
            'password'=>'required',
            'captcha' => 'required|captcha'
        ];
    }

    /**
     * 定义字段名中文
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'username'=>'用户名',
            'password'=>'密码',
        ];
    }

    /**
     * 返回
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
            'captcha.captcha' => json_encode( ['code'=>0,'msg'=>'验证码错误'],JSON_UNESCAPED_UNICODE)
        ];
    }
}
