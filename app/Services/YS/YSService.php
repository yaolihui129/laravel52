<?php

namespace App\Services\YS;

use App\AutoLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class YSService {

	public function getVersion() {
		$query=DB::select ("
            select id,chrVersionKey,chrVersionName 
            from ys_version 
            ORDER BY chrVersionKey"
        );
		return $query;
	}
    public function getIntegrate($version) {
        return DB::select ("
            select id,chrIntergrateKey,chrIntegrateName 
            from ys_integrate 
            WHERE intVersionID ='$version' 
            ORDER BY chrIntergrateKey DESC"
        );
    }
}

?>