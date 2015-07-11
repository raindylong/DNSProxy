<?php

$domain = $_GET["domain"];

$domain = str_replace("http://","", $domain) ;


// 如果是DNS反向解析请求，直接返回一个域名
$arpa = explode("-",$domain);
if ( $arpa[count($arpa)-1] == "addr.arpa." ){
        print_r("addr.arpa.ejoy.com");exit;
}

$domain = str_replace(":","", $domain) ;
$domain = str_replace("&","", $domain) ;
$domain = str_replace(";","", $domain) ;
$domain = str_replace("@","", $domain) ;
$domain = str_replace("|","", $domain) ;
$domain = str_replace("!","", $domain) ;
$domain = str_replace(",","", $domain) ;
$domain = str_replace("#","", $domain) ;
$domain = str_replace("$","", $domain) ;
$domain = str_replace("%","", $domain) ;
$domain = str_replace("*","", $domain) ;
$domain = str_replace("^","", $domain) ;
$domain = str_replace("(","", $domain) ;
$domain = str_replace(")","", $domain) ;
$domain = str_replace("+","", $domain) ;
$domain = str_replace("=","", $domain) ;
$domain = str_replace("[","", $domain) ;
$domain = str_replace("]","", $domain) ;
$domain = str_replace("{","", $domain) ;
$domain = str_replace("}","", $domain) ;
$domain = str_replace("\"","", $domain) ;
$domain = str_replace("'","", $domain) ;
$domain = str_replace("/","", $domain) ;


if ( $domain == "" ) {
	print_r("127.0.0.1");exit;
}

// 如果拿到的domain最后一个字符不是"."，则增加一个"."
$arrp = str_split($domain);
if( $arrp[count($arrp)-1] != '.' ){
	$domain = $domain.'.';
};

$search_array = array(
///////////// 以下是数组内容 /////

"localhost."=>"127.0.0.1",
"broadcasthost."=>"255.255.255.255",
"localhost."=>"::1",
"."=>"",


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
