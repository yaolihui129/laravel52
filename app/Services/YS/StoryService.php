<?php

namespace App\Services\YS;

use App\AutoLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StoryService {
    /**
     * @param $version
     * @param $integrate
     * @param $startTime
     * @param $endTime
     * @return string
     */
    public function getStoryData($version, $integrate, $startTime, $endTime){
        if($startTime){
            if ($endTime){
                //如果开始时间结束时间都有
                $str="AND a.created_at BETWEEN' $startTime' and '$endTime' ";
            }else{
                //只有开始时间，没有结束时间
                $str="AND a.created_at >=' $startTime'";
            }
        }else{
            if ($endTime){
                //如果没有开始时间，只有结束时间
                $str="AND a.created_at <=' $endTime' ";
            }else{
                //开始时间，结束时间都没有
                $str="";
            }
        }

        $sql="SELECT a.dateStoryDate,a.chrStoryKey,a.chrStoryName,a.floatStorySpeed,a.textStroyJson 
            FROM ys_story a
            WHERE a.intVersionID = '$version'
            AND a.intIntegrateID = '$integrate'
            AND a.type = '1'
            ".$str."ORDER BY floatStorySpeed DESC";

//        LEFT JOIN ys_version b on b.id=a.intVersionID
//            LEFT JOIN ys_integrate c on c.id=a.intIntegrateID

        $res =DB::select ($sql);

        return $res;
    }

    /**
     *
     * @param $chrStoryTime
     * @param $chrStoryName
     * @param $chrStorySpeed
     * @param $textStroyJson
     * @param $chrVersionID
     * @param $chrIntegrateID
     */
	public function insert($chrStoryTime, $chrStoryName, $chrStorySpeed, $textStroyJson, $chrVersionID, $chrIntegrateID) {
		DB::insert ( "insert into ys_story (chrStoryTime,chrStoryName,chrStorySpeed,textStroyJson,chrVersionID,chrIntegrateID) 
				values (?,?,?,?,?,?)", [
            $chrStoryTime,
            $chrStoryName,
            $chrStorySpeed,
            $textStroyJson,
            $chrVersionID,
            $chrIntegrateID
		] );
	}



}

?>