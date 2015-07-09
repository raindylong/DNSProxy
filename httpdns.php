<?php
// 获取链接的HTML代码
//
$domain = $_GET["domain"];

$domain = str_replace("http://","", $domain) ;

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
"init.gc.apple.com."=>"96.7.54.185",
"cn.wsj.com."=>"96.7.54.98",
///////////// 以上是数组内容 /////////////
) ;


if (array_key_exists("$domain", $search_array)) {
        print_r($search_array["$domain"]);
        exit;

}

//// 去 dnspod httpdns拿一次dns结果
$html = file_get_contents("http://119.29.29.29/d?dn=$domain");

if(!$html){
        die("");
}

function wdomain($ip,$string){
        $fp = fopen("./domain/$string.txt", "w");//文件被清空后再写入
        $flag=fwrite($fp,"$ip $string\n");
        fclose($fp);
}

////如果有多个结果，只取第一个IP
$array = explode(";",$html);
if( isset($array[1]) && ($array[1] != "") ){
	$html = $array[1];
}

        wdomain($html,$domain); //写入domain目录中
	print_r($html);

?>
