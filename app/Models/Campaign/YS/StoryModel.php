<?php namespace App\Models\Campaign\YS;

use Illuminate\Database\Eloquent\Model;

class StoryModel extends Model {

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'ys_story';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

}
