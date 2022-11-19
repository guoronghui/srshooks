<?php
$verifyData = file_get_contents("php://input");
//$verifyData = "{"action":"on_play","client_id":105,"ip":"139.71.22.215","vhost":"__defaultVhost__","app":"live","tcUrl":"rtmp://ip:1935/live?user=player&pwd=123","pageUrl":""}";
$obj=json_decode($verifyData);

if ( $obj->action == "on_connect"){
    echo "0";
}
else if ( $obj->action == "on_close"){
    echo "0";
}
else if ( $obj->action == "on_publish"){
    $arr = parse_url($obj->param);
    $arr_query = convertUrlQuery($arr['query']);
    
    //修改推流密码
    if ($arr_query["key"] == "6666") {
        echo "0";
		
#推流开启企业微信提醒
#key=企业微信机器人中的值
$webhook = "https://qyapi.weixin.qq.com/cgi-bin/webhook/send?key=6666-6666-6666-666-6666";   #这里需要修改
# curl初始化
$curl = curl_init();
#需要推送的url
curl_setopt($curl, CURLOPT_URL, $webhook);
curl_setopt($curl, CURLOPT_POST, 1);
#content必须是utf8编码
curl_setopt($curl, CURLOPT_HTTPHEADER,array('Content-Type: application/json;charset=utf-8'));
#content 为需要推送的内容,内容可以自定义
$stream=$obj->stream;
$streamdata = $stream." 直播已开始。 \n >直播地址：[电信](http://xxx.com/live/".$stream.".m3u8) \n \n";
$post_dataa = array ('msgtype' => 'markdown','markdown' => array ('content' => $streamdata));
$post_data = json_encode($post_dataa);
		
curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($curl);
curl_close($curl);		
#企业微信提醒结束
	
    }
    else {
         echo "1";
    }
}
else if ( $obj->action == "on_unpublish"){
    echo "0";
}
else if ( $obj->action == "on_play"){
	
	
	
	
	
	
    //$arr = parse_url($obj->tcUrl);
    //$arr_query = convertUrlQuery($arr['query']);
    //if ($arr_query["user"] == "player" && $arr_query["pwd"] == "123") {
    //    echo "0";
    //}
    //else {
    //     echo "1";
    //}
    echo "0";
}
else if ( $obj->action == "on_stop"){
    echo "0";
}
else if ( $obj->action == "on_dvr"){
    echo "0";
}
else{
    echo "1";
}

function convertUrlQuery($query)
{
    $queryParts = explode('&', $query);
    $params = array();
    foreach ($queryParts as $param) {
        $item = explode('=', $param);
        $params[$item[0]] = $item[1];
    }
    return $params;
}
 
function getUrlQuery($array_query)
{
    $tmp = array();
    foreach($array_query as $k=>$param)
    {
        $tmp[] = $k.'='.$param;
    }
    $params = implode('&',$tmp);
    return $params;
}

?>