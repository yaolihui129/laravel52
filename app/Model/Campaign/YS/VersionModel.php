<?php namespace App\Model\Campaign\YS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VersionModel extends Model {
//    use SoftDeletes;

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'ys_version';

    /**
     * The primary key associated with the table.
     *
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
    protected $fillable = ['chrVersionKey', 'chrVersionName','chrVersionDescribe','IssueDate'];

    /**
     * 隐藏属性
     */
    protected $hidden = ['intProduct','created_by','updated_by','created_at','updated_at'];


}
