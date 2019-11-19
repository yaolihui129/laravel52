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
	/**
	 * 隐藏属性
	 */
	protected $hidden = ['created_by','updated_by','created_at','updated_at'];

}
