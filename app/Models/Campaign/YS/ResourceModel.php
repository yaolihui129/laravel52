<?php namespace App\Models\Campaign\YS;

use Illuminate\Database\Eloquent\Model;

class ResourceModel extends Model {

    /**
     * 关联到模型的数据表
     *  定义关联数据表
     * @var string
     */
    protected $table = 'ys_resource';

    /**
     * The primary key associated with the table.
     *  定于主键
     * @var string
     */
    protected $primaryKey = 'id';
    protected $fillable = [
        'enumType',
        'resDate',
        'intVersionID',
        'intIntegrateID',
        'textJson'
    ];//开启白名单字段
    /**
     * 隐藏属性
     */
    protected $hidden = ['created_by','updated_by','created_at','updated_at'];

}
