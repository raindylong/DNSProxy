<?php
// 获取链接的HTML代码
//
$domain = $_GET["domain"];
$html = file_get_contents("http://119.29.29.29/d?dn=$domain");

if(!$html){
	die("");
}

//print_r("----");
//print_r($domain."\n");
//如果有多个结果，只取一个IP返回
$array = explode(";",$html);
if($array[1]== ""){
	print_r($html);
}
else{
	print_r($array[1]);
}

?>
