<?php

namespace cms;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = ['filename', 'extension', 'size'];
}
