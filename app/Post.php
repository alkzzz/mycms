<?php

namespace cms;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   	protected $table = 'posts';

    protected $fillable = ['urutan','has_submenu','title_id', 'slug_id', 'content_id',
    						'title_en', 'slug_en', 'content_en', 'post_type', 'post_parent', 'has_child'];

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
        return $query->where('post_parent', '!=', '0');
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
