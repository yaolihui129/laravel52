<?php namespace App\Models\Campaign\YS;

use Illuminate\Database\Eloquent\Model;

class BugModel extends Model {

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'ys_bug';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

}
