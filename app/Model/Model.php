<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    //

    protected $guarded=[];//不可以注入的数据字段

}
