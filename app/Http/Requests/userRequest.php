<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
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
        $id=$this->route()->parameter('user');
        if(in_array($this->method(),['PUT','PATCH'])){
            return [
                'username' => 'required|alpha_num|min:4|max:50|unique:users,username,'.$id.',user_id',
                'password' => 'sometimes|nullable|min:6|max:50|regex:/^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,20}$/',
                'phone_number'=>'required|digits:11|numeric',
                'role_id'=>'required'
             ];
        }else{
              return [
                'username' => 'required|unique:users|alpha_num|min:4|max:50',
                'password' => 'required|min:6|max:50|regex:/^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,20}$/',
                'phone_number'=>'required|digits:11|numeric',
                'role_id'=>'required'
             ];
        }
      
    }

    public function  messages(){
        return[
            'username.required'=>'تكایە ناو پڕكەرەوە',
            'username.unique'=>'ئەم ناوە هەڵبژێردراوە و ناوێكی دیكە بەكاربێنە',
            'username.alpha_num'=>'تەنیا ئەتوانیت وشە و پیت بەكاربێنی لە هەڵبژاردنی ناو',
            'username.min'=>'پێویستە ناوەكە لە 4 پیت كەمترنەبێ',
            'password.min'=>'پێویستە پاسۆردەكە لە 6 پیت كەمترنەبێ',
            'password.required'=>'تكایە پاسۆرد پڕكەرەوە',
            'password.regex'=>'پێویستە پاسۆردەكە پێكهاتبێت لە ژمارە و پیت (كەپیتاڵ و سمۆڵ ) وە نیشانەكانی وەك (& , * , # ) ــ',
            'phone_number.required'=>"تكایە ژ.مۆبایل پڕكەرەوە پڕكەرەوە",
            'phone_number.digits'=>'پێویستە ژمارەكە لە 11 ڕەقەم بێت',
            'phone_number.numeric'=>'تەنیا ئەتوانیت ژمارە داغڵ بكەیت و وەبۆشای لەنێوان ژمارەكان نەبێ',
            'role_id.required'=>'ئاست دياری بكە'
        ];
   
    }
       
       
}
