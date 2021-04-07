<?php
echo "<a target='_blank' href=''>GitHub repo</a> <br> ";
main();


function main () {
	
	$apiCall = 'https://api.covid19api.com/summary';
	// $json_string = file_get_contents($apiCall); 
	$json_string = curl_get_contents($apiCall);
	$obj = json_decode($json_string);
	//$data = $obj->Global->NewConfirmed;
    $arr1 = Array();
    $arr2 = Array();
    foreach($obj->Countries as $i){
        //$data = $obj->Countries[$i]->Country . " : " . $obj->Countries[$i]->TotalDeaths;
        array_push($arr1, $i->Country);
        array_push($arr2, $i->TotalDeaths);
    }
	//$data = $obj->Countries[170]->Country . " : " . $obj->Countries[170]->TotalDeaths;
	//echo $data." <br><br> ";
    array_multisort($arr2, SORT_DESC, $arr1);
    print_r($arr1);
}


function curl_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}