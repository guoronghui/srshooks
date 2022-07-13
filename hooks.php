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
    if ($arr_query["key"] == "ca0526ea42d31cee") {
        echo "0";
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
