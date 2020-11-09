<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuRequest extends FormRequest
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
            'bu_name'=>'required | min:5 | max:100',
            'bu_rooms'=>'nullable | integer | required',
            'bu_price'=>'numeric | required',
            'bu_rent'=>'required',
            'bu_square'=>'required | min:2 | max:30',
            'bu_type'=>'required',
            'bu_small_dis'=>'required | min:5 | max:200',
            'bu_meta'=>'required | min:5 | max:160',
            'bu_longitude'=>'required | string',
            'bu_Latitude'=>'required | string',
            'bu_large_dis'=>'nullable  | min:5 | required',
            'image'=>'image'

        ];
    }
}
