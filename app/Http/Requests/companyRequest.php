<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class companyRequest extends FormRequest
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
            'comp_name' => 'required|alpha|max:50',
         ];
    
  
    }   

    public function  messages(){
            return[
                'comp_name.required'=>'تكایە ناو پڕكەرەوە',
                'comp_name.alpha'=>'پێویستە ناوەكە تەنیا پیت بێ',
            ];

        }
}
