<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class menuRequest extends FormRequest
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
            'menu_name' => 'required|max:50',
            'icon' => 'nullable|mimes:svg,png',
         ];
        }
        else{
            return [
                'menu_name' => 'required|max:50',
                'icon' => 'required|mimes:svg,png',
             ];
         }
    
  
    }   

    public function  messages(){
            return[
                'menu_name.required'=>'تكایە ناو پڕكەرەوە',
                'icon.required'=>'تكایە وێنە هەڵبژێرە',
                'icon.mimes'=>'بێت (png , svg) پێویستە وێنەكە لە جۆری',
            ];

        }
}
