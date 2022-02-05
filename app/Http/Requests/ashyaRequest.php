<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ashyaRequest extends FormRequest
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
                'ashya_name' => 'required|max:50',
                'image' => 'nullable|mimes:jpg,png,jpeg',
                'address' => 'required|max:255',
                'phone_number' => 'required|digits:11|numeric',
                'car'=>'required|alpha|max:50'
             ];
            }
            else{
                return [
                    'ashya_name' => 'required|alpha|max:50',
                    'image' => 'required|mimes:jpg,png,jpeg',
                    'address' => 'required|max:255',
                    'phone_number' => 'required|digits:11|numeric',
                    'car'=>'required|alpha|max:50'

                 ];
             }
    }


    public function  messages(){
        return[
            'ashya_name.required'=>'تكایە ناو پڕكەرەوە',
            'image.required'=>'تكایە وێنە هەڵبژێرە',
            'address.required'=>'تكایە ناونیشان پڕكەرەوە',
            'car.required'=>'تكایە ئۆتۆمبیل پڕكەرەوە',
            'car.max'=>'ناوی سەیارە پێوستە 50 پیت زیاتر نەبێ',
            'address.max'=>'ناونیشان پێوستە 255 پیت زیاتر نەبێ',
            'phone_number.required'=>'تكایە ژ.مۆبایل پڕكەرەوە',
            'image.mimes'=>'بێت (png,jpg) پێویستە وێنەكە لە جۆری',
            'phone_number.digits'=>'پێویستە ژمارەكە 11 ڕەقەم بێت',
            'phone_number.numeric'=>'تەنیا ئەتوانیت ژمارە داغڵ بكەیت و وەبۆشای لەنێوان ژمارەكان نەبێ',
            'car.alpha'=>"پێویستە ناوی سەیارەكە هەمووی پیت بێ"
        ];

    }
}
