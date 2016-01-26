<?php

namespace cms;

use Illuminate\Database\Eloquent\Model;

class TopMenu extends Model
{
    protected $table = 'top_menu';
    protected $fillable = ['urutan','nama_topmenu','link_topmenu'];
}
