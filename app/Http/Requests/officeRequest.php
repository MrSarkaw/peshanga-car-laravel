<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class officeRequest extends FormRequest
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
        if(in_array($this->method(),['PUT','PATCH'])){
            return [
                'name' => 'required|max:50',
                'address' => 'required|max:255',
                'phone_number' => 'required|digits:11|numeric',
             ];
            }
            else{
                return [
                    'name' => 'required|alpha|max:50',
                    'address' => 'required|max:255',
                    'phone_number' => 'required|digits:11|numeric',

                 ];
             }
    }


    public function  messages(){
        return[
            'name.required'=>'تكایە ناو پڕكەرەوە',
            'address.required'=>'تكایە ناونیشان پڕكەرەوە',
            'address.max'=>'ناونیشان پێوستە 255 پیت زیاتر نەبێ',
            'phone_number.required'=>'تكایە ژ.مۆبایل پڕكەرەوە',
            'phone_number.digits'=>'پێویستە ژمارەكە 11 ڕەقەم بێت',
            'phone_number.numeric'=>'تەنیا ئەتوانیت ژمارە داغڵ بكەیت و وەبۆشای لەنێوان ژمارەكان نەبێ',
        ];

    }
}
