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

"plus.xiangji.qq.com."=>"101.226.62.63",
"mp.weixin.qq.com."=>"101.226.68.61",
"short.wecall.qq.com."=>"101.226.76.168",
"clients6.google.com."=>"74.125.23.101",
"developer.android.com."=>"74.125.23.101",
"android.clients.google.com."=>"74.125.23.102",
"developers.google.com."=>"74.125.23.102",
"chrome.google.com."=>"74.125.23.138",
"translate.google.com."=>"74.125.23.139",
"clojure.org."=>"75.126.104.177",
"kharma.unity3d.com."=>"75.126.59.147",
"www.assetstore.unity3d.com."=>"75.126.59.150",
"www.toobop.net."=>"80.67.28.68",
"security.ubuntu.com."=>"91.189.92.200",
"realtimeradiosity.com."=>"93.185.104.27",
"cn.wsj.com."=>"96.7.54.122",
"init-p01st.push.apple.com."=>"96.7.54.186",
"config.mobile.yahoo.com."=>"98.137.201.111",


///////////// 以上是数组内容 /////////////
) ;



// 据说用array_key_exists比isset慢
/*
if (array_key_exists("$domain", $search_array)) {
        print_r($search_array["$domain"]);
        exit;
}
*/

// 据说用isset会快很多
if (isset($search_array["$domain"])){
	print_r($search_array["$domain"]);
        exit;
}


// DNSPod的 httpdns 地址 ，file_get_contents比较简单，可以改成其他方法
$html = file_get_contents("http://119.29.29.29/d?dn=$domain");

if(!$html){
        die("");
}

function wdomain($ip,$filename,$domain){
        $fp = fopen("$filename", "w"); //文件被清空后再写入
        $flag=fwrite($fp,"$ip $domain\n");
        fclose($fp);
}


$array = explode(";",$html);
if( isset($array[1]) && ($array[1] != "") ){
        $html = $array[1];
}

// domain文件生成的临时目录 /tmp/domain ，与gen_httpdns.sh中的domain_tmpdir对应
        wdomain($html,"/tmp/domain/".$domain.".txt",$domain);
	print_r($html);

?>
