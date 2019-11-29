<?php namespace App\Models\Campaign\YS;

use Illuminate\Database\Eloquent\Model;

class IntegrateModel extends Model {

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
    protected $fillable = [
        'chrIntergrateKey',
        'chrIntegrateName',
        'chrIntegrateDescribe',
        'intVersionID',
        'start_at',
        'end_at'
    ];//开启白名单字段

    /**
     * 隐藏属性
     */
    protected $hidden = ['created_by','updated_by','created_at','updated_at'];

}
