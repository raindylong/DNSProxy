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

