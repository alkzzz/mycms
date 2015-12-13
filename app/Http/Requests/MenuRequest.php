<?php

namespace cms\Http\Requests;

use cms\Http\Requests\Request;
use Entrust;

class MenuRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Entrust::hasRole('administrator');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title_id'=>'required | unique:posts',
            'title_en'=>'required | unique:posts',
        ];
    }
}
