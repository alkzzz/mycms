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
      $rules = [
        'title_id' => 'required',
        'title_en' => 'required',
      ];

      if ($this->request->get('title_id') and $this->request->get('title_en') > 0) {
      foreach($this->request->get('title_id') as $key => $val)
      {
        $rules['title_id.'.$key] = 'required';
      }
      foreach($this->request->get('title_en') as $key => $val)
      {
        $rules['title_en.'.$key] = 'required';
      }
    }
      return $rules;
    }

    public function messages()
    {
      $messages = [];

      if ($this->request->get('title_id') and $this->request->get('title_en') > 0) {
      foreach($this->request->get('title_id') as $key => $val)
      {
        if ($key == 0) {
        $messages['title_id.'.$key.'.required'] = 'Judul menu utama bahasa Indonesia harus diisi.';
        }
        else {
        $messages['title_id.'.$key.'.required'] = 'Judul menu utama bahasa Indonesia ke-'.$key.' harus diisi.';
        }
      }
      foreach($this->request->get('title_en') as $key => $val)
      {
        if ($key == 0) {
        $messages['title_en.'.$key.'.required'] = 'Judul menu utama bahasa Inggris harus diisi.';
        }
        else {
        $messages['title_en.'.$key.'.required'] = 'Judul menu utama bahasa Inggris ke-'.$key.' harus diisi.';
        }
      }
    }

      return $messages;
    }

}
