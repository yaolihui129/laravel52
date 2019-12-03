<?php namespace App\Models\Campaign\YS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResourceModel extends Model {
    use SoftDeletes;

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

    /**
     * 应该被调整为日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * 开启白名单字段
     * @var array
     */
    protected $fillable = [
        'enumType',
        'resDate',
        'intVersionID',
        'intIntegrateID',
        'textJson'
    ];
    /**
     * 隐藏属性
     */
    protected $hidden = ['created_by','updated_by','created_at','updated_at'];

}
