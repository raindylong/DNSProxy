

///////////// 以上是数组内容 /////////////
) ;


/*
if (array_key_exists("$domain", $search_array)) {
        print_r($search_array["$domain"]);
        exit;
}
*/

if (isset($search_array["$domain"])){
	print_r($search_array["$domain"]);
        exit;
}


$html = file_get_contents("http://119.29.29.29/d?dn=$domain");

if(!$html){
        die("");
}

function wdomain($ip,$filename,$domain){
        $fp = fopen("$filename", "w");//文件被清空后再写入
        $flag=fwrite($fp,"$ip $domain\n");
        fclose($fp);
}


$array = explode(";",$html);
if( isset($array[1]) && ($array[1] != "") ){
        $html = $array[1];
}

        wdomain($html,"/tmp/domain/".$domain.".txt",$domain);
	print_r($html);

?>
