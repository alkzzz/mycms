<?php

namespace cms;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function articles()
    {
      return $this->hasMany('cms\Post', 'id_kategori');
    }

}
