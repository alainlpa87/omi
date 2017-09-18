<?php
/*
 * Delete list of emails in benchmark to prevent error for reach the maximun amount. (run at 12:00 am everyday)
 * */

require_once 'BMEAPI.class.php';

//Login in Benchmark API
$api = new BMEAPI('rick@ownmyinvention.com', 'PsUsa33181', 'http://www.benchmarkemail.com/api/1.0');
if ($api->errorCode){
    echo "-1";
}

//$list = $api->listGet("", 2, 400, "date", "asc");

$list = $api->listGet("", 1, 1, "date", "asc");

if (!$list){
    echo "Error!";
    echo "\n\tCode=".$api->errorCode;
    echo "\n\tMsg=".$api->errorMessage."\n";
} else {
    foreach($list as $listData){
        $deletedList = $api->listDelete( $listData['id'] );

        if ( !$deletedList )
        {
            echo "Error!";
            echo "\n\tCode=".$api->errorCode;
            echo "\n\tMsg=".$api->errorMessage."\n";
        }
        else
        {
            echo "Contact List Deleted \n";
        }
    }
}