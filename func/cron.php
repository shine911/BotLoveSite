<?php
require("../conf/conn.php");
$sql = "SELECT * FROM user";
$result = $mysql->query($sql);
while($user = $result->fetch_assoc())
{
	echo like($user['react'], $user['token']);
}

function like($c,$token){
	//TURN OFF ERROR
	error_reporting(0);
	set_time_limit(0);
    $idPost =  json_decode(getUrl('https://graph.facebook.com/me/home?fields=id,message,created_time,from,comments,type&access_token='.$token.'&offset=0&limit=5'.''),true);
    for ($i=1; $i<=count($idPost[data]);$i++){
    	echo getUrl('https://graph.facebook.com/'.$idPost[data][$i-1][id].'/reactions?type='.$c.'&method=post&access_token='.$token);
	}
};

function getUrl($url){
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $url);
$ch = curl_exec($curl);
curl_close($curl);
return $ch;
}
?>