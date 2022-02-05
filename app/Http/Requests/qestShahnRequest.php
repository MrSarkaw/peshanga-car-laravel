<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class qestShahnRequest extends FormRequest
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
                'name' => 'required|min:4|max:23',
                'phone_number'=>'required|digits:11|numeric',
                'cars'=>'required|max:300',
                'menu'=>'required|max:10',
             ];
        
      
    }

    public function  messages(){
        return[
            'name.required'=>'تكایە ناو پڕكەرەوە',
            'name.min'=>'پێویستە ناوەكە لە 4 پیت كەمترنەبێ',
            'phone_number.required'=>"تكایە ژ.مۆبایل پڕكەرەوە پڕكەرەوە",
            'phone_number.digits'=>'پێویستە ژمارەكە لە 11 ڕەقەم بێت',
            'phone_number.numeric'=>'تەنیا ئەتوانیت ژمارە داغڵ بكەیت و وەبۆشای لەنێوان ژمارەكان نەبێ',
            'menu.required'=>'جؤر دياری بكە',
            'cars.required'=>'سەیارە دياری بكە',
        ];
   
    }
}
