<?php

namespace App\Services\YS;

use App\AutoLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BUGService {

    /**
     * @param $version
     * @param $integrate
     * @param $startTime
     * @param $endTime
     * @return mixed
     */
    public function getBugData($version, $integrate, $startTime, $endTime){
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



        $sql ="select a.dataBugDate,a.chrBugModel,a.intBugSum,a.intBugStatus1,a.intBugStatus2,a.intBugStatus3,a.intBugStatus4
            FROM ys_bug a
            where a.intVersionID = '$version'
            AND a.intIntegrateID = '$integrate'
            AND a.type = '0'
            ".$str;

        //        LEFT JOIN ys_version b on b.id=a.intVersionID
//            LEFT JOIN ys_integrate c on c.id=a.intIntegrateID

        $res =DB::select ($sql);

        return $res;
    }
	
	/**
	 *
	 * @param unknown $logs        	
	 * @param unknown $scriptId        	
	 * @param unknown $schemeId        	
	 * @param unknown $execTaskId        	
	 * @param unknown $jobId        	
	 * @param unknown $payload        	
	 */
	public function insert($logs, $scriptId, $schemeId, $execTaskId, $jobId, $reportId, $payload, $browsers) {
		DB::insert ( "insert into auto_logs (intOrderNo,chrResult,chrCmd,chrCmdParam,chrErrorMessage,
				fltDuring,chrImage,chrElementAlias,chrDescription,intLineNo,intLevel,chrStatus,intScriptID,
				intSchemeID,intExecTaskID,intJobID,intTaskID,intTimerTaskID,intReportID,intBrowserID) 
				values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [ 
				$logs ["No"],
				$logs ["result"],
				$logs ["cmd"],
				$logs ["cmdParam"],
				$logs ["errorMessage"],
				$logs ["during"],
				$logs ["image"],
				$logs ["elementAlias"],
				$logs ["description"],
				$logs ["lineNo"],
				$logs ["level"],
				$logs ["status"],
				$scriptId,
				$schemeId,
				$execTaskId,
				$jobId,
				$payload ["taskId"],
				$payload ["tiTaskId"],
				$reportId,
				$browsers ["browserId"] 
		] );
	}
}

?>