<?php namespace App\Model\Campaign\YS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IntegrateModel extends Model {
    use SoftDeletes;

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'ys_integrate';

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
     *
     * @var array
     */
    protected $fillable = [
        'chrIntergrateKey',
        'chrIntegrateName',
        'chrIntegrateDescribe',
        'intVersionID',
        'start_at',
        'end_at'
    ];

    /**
     * 隐藏属性
     */
    protected $hidden = ['created_by','updated_by','created_at','updated_at'];

}
