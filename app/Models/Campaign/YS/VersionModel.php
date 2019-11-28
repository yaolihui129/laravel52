<?php namespace App\Models\Campaign\YS;

use Illuminate\Database\Eloquent\Model;

class VersionModel extends Model {

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

    protected $fillable = ['chrVersionKey', 'chrVersionName','chrVersionDescribe','IssueDate'];//开启白名单字段

    /**
     * 隐藏属性
     */
    protected $hidden = ['intProduct','created_by','updated_by','created_at','updated_at'];

}
