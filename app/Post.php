<?php

namespace cms;

use Sofa\Eloquence\Eloquence;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Eloquence;

   	protected $table = 'posts';

    protected $fillable = ['urutan','id_kategori','has_submenu','title_id', 'slug_id', 'content_id',
    						'title_en', 'slug_en', 'content_en', 'post_type', 'post_parent', 'has_child'];

    public function slider()
    {
      return $this->hasOne('cms\Slider', 'id', 'id_gambar');
    }

    public function scopePage($query)
    {
        return $query->where('post_type', '=', 'page');
    }

    public function scopeMenu($query)
    {
        return $query->where('post_parent', '=', '0');
    }

    public function scopeSubmenu($query)
    {
        return $query->where('post_parent', '<>', '0');
    }

    public function scopeArticle($query)
    {
      return $query->where('post_type', '=', 'article');
    }

    public function scopeLink($query)
    {
      return $query->where('post_type', '=', 'link');
    }

}
