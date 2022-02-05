<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class normalUserRequest extends FormRequest
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
                'mobile_number'=>'required|digits:11|numeric',
                'sec_id'=>'required',
                'comp_id'=>'required',
                'model'=>'required|digits:4|numeric',
                'plate_number'=>'required|digits_between:1,6|numeric',
                'price'=>'required|numeric',
                'note'=>'required',
                'images'=>'nullable|max:2000',
                'images.*'=>'mimes:jpg,png,jpeg',
                'city_name'=>'required|alpha|max:15'
             ];
        }else{
              return [
                'name' => 'required|alpha_dash|max:50',
                'mobile_number'=>'required|digits:11|numeric',
                'sec_id'=>'required',
                'comp_id'=>'required',
                'model'=>'required|digits:4|numeric',
                'plate_number'=>'required|digits_between:1,6|numeric',
                'price'=>'required|numeric',
                'note'=>'required',
                'images'=>'required|max:2000',
                'images.*'=>'mimes:jpg,png,jpeg',
                 'city_name'=>'required|alpha|max:15'
             ];
        }
      
    }

    public function  messages(){
        return[
            'name.required'=>'تكایە ناو پڕكەرەوە',
            'name.alpha'=>'تەنیا ئەتوانیت وشە  بەكاربێنی لە هەڵبژاردنی ناو',
            'mobile_number.required'=>"تكایە ژ.مۆبایل پڕكەرەوە ",
            'mobile_number.digits'=>'پێویستە ژمارەكە لە 11 ڕەقەم بێت',
            'mobile_number.numeric'=>'تەنیا ئەتوانیت ژمارە داغڵ بكەیت و وەبۆشای لەنێوان ژمارەكان نەبێ',
            'menu_id.required'=>'جۆر دياری بكە',
            'sec_id.required'=>'جۆری مۆدێل دياری بكە',
            'comp_id.required'=>'كۆمپانیا دياری بكە',
            'model.required'=>'مۆدێل دياری بكە',
            'city_name.required'=>'شار بۆ ژمارەی سەیارە دياری بكە',
            'plate_number.required'=>'ژمارەی ئۆتۆمبێل بنووسە',
            'plate_number.max'=>'ژمارەی ئۆتۆمبێل نابێ لە 6 زیاتربێ',
            'plate_number.numeric'=>'ژمارەی ئۆتۆمبێل نابێ پیتی تێدابێ',
            'note.required'=>'تێبینت بنووسە',
            'price.required'=>'نرخ بنووسە',
            'images.required'=>'ڕەسم هەڵبژێرە',
            'image.*'=>' هەڵبژێریت ( jpg,jpeg,png) تەنیا ئەتوانیت '

        ];
   
    }
}
