<?php namespace App\Models\Campaign\YS;

use Illuminate\Database\Eloquent\Model;

class ApiModel extends Model {

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'ys_api';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

}
