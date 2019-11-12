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

}
