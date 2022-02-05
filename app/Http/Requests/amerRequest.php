<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class amerRequest extends FormRequest
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
                'sec_id'=>'required|numeric',
                'images'=>'nullable|max:2000',
                'images.*'=>'mimes:jpg,png,jpeg',
                'city_id'=>'required|numeric|max:15',
                'price'=>'required',
                'note'=>'required|max:255'
             ];
        }else{
              return [
                'name' => 'required|max:50',
                'sec_id'=>'required|numeric',
                'images'=>'required|max:2000',
                'images.*'=>'mimes:jpg,png,jpeg',
                'city_id'=>'required|numeric|max:15',
                'price'=>'required',
                'note'=>'required|max:255'
             ];
        }
      
    }

    public function  messages(){
        return[
            'name.required'=>'تكایە ناو پڕكەرەوە',
            'sec_id.required'=>'جۆری ئامێر دياری بكە',
            'city_id.required'=>'شار دياری بكە',
            'price.required'=>'نرخ بنووسە',
            'images.required'=>'ڕەسم هەڵبژێرە',
            'image.*'=>' هەڵبژێریت ( jpg,jpeg,png) تەنیا ئەتوانیت '

        ];
   
    }
}
