<?php
namespace App;
use Illuminate\Database\Eloquent\Model as BaseModel;
class Model extends BaseModel{
    //公共模型
    protected $guarded=[];//不可以注入的数据字段
}
