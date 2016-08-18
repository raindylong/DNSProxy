

///////////// 以上是数组内容 /////////////
) ;


/*
if (array_key_exists("$domain", $search_array)) {
        print_r($search_array["$domain"]);
        exit;
}
*/

function wdomain($ip,$filename,$domain){
        $fp = fopen("$filename", "w");//文件被清空后再写入
        $flag=fwrite($fp,"$ip $domain\n");
        fclose($fp);
}

if (isset($search_array["$domain"])){
	print_r($search_array["$domain"]);
        exit;
}


//$html = file_get_contents("http://119.29.29.29/d?dn=$domain");

$ch = curl_init();
// set url 
curl_setopt($ch, CURLOPT_URL, "http://119.29.29.29/d?dn=$domain");
//return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// $output contains the output string 
$output = curl_exec($ch);
// close curl resource to free up system resources 
curl_close($ch);

$html = $output ;

if(!$html){
        die("");
}

/*
##### 如果dnspod拿不到，记录一次
if ( $html == "") {
        wdomain($html,"/tmp/domainerr/".$domain.".txt",$domain);
        // 用dns query查一次
        $dnsr = dns_get_record("$domain", DNS_A);
        //print_r($dnsr);
        $html=$dnsr[0]["ip"] ;
}
*/


$array = explode(";",$html);
if( isset($array[1]) && ($array[1] != "") ){
        $html = $array[1];
}

        wdomain($html,"/tmp/domain/".$domain.".txt",$domain);
	print_r($html);

?>
