<?php

namespace cms;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['urutan', 'gambar'];
}
