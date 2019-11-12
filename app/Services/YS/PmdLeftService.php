<?php

namespace App\Services\YS;

use App\AutoLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PmdLeftService {

	public function getPmdLeftData($version,$integrate,$startTime,$endTime) {

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

        $sql ="select a.chrSpecialName,a.dateSpecialDate,a.floatSpecialSpeed 
            from ys_pmdleft a
            where a.intVersionID = '$version'
            and a.intIntegrateID = '$integrate'
            ".$str;
//        LEFT JOIN ys_version b on b.id=a.intVersionID
//            LEFT JOIN ys_integrate c on c.id=a.intIntegrateID

        $res =DB::select ($sql);

		return $res;
	}
}

?>