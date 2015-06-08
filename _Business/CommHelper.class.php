<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommHelper
 *
 * @author zq
 */
class CommHelper {

    //put your code here
    public static function arrayIsEmptyOrNull($entity) {
        if (!is_array($entity))
            return true;
        $i = empty($entity) || count($entity) == 0;
        return $i;
    }

    public static function combineTime($time) {
        $nowTime = date("Y-m-d ");
        return $nowTime . trim($time);
    }

    public static function getPRCNowTime() {
        date_default_timezone_set("PRC");
        return time();
    }

    public static function getPRCNowStr() {
        $t = self::getPRCNowTime();
        return date("Y-m-d H:i:s", $t);
    }

    public static function getPRCNowStrByTime($now) {
        return date("Y-m-d H:i:s", $now);
    }

    public static function getPRCTimeAfterDays($days) {
        date_default_timezone_set("PRC");
        return strtotime("+" . $days . " day");
    }

    public static function daydiff($begin_time, $end_time) {
        if ($begin_time < $end_time) {
            $starttime = $begin_time;
            $endtime = $end_time;
        } else {
            $starttime = $end_time;
            $endtime = $begin_time;
        }
        $timediff = $endtime - $starttime;
        $days = intval($timediff / 86400);

        return $days;
    }

    public static function isNULL($params) {
        return !isset($params) || empty($params);
    }

    public static function isDateFormat($timeString) {

        if (empty($timeString)) {
            return 0;
        }
        return preg_match("/^[0-9]{4}(\-|\/)[0-9]{1,2}(\\1)[0-9]{1,2}(|\s+[0-9]{1,2}(:[0-9]{1,2}){0,2})$/", $timeString);
    }

    public static function array_search_between_time($st = null, $ed = null) {
        $start = 0;
        $end = 0;
        $stIndex = 0;
        $edIndex = 0;
        if (!empty($st)) {
            $start = strtotime($st);
        }
        if (!empty($ed)) {
            $end = strtotime($ed);
        }
        $output = array();
        if (empty($st) && !empty($ed)) {
            foreach ($res as $key => $value) {
                if ($value["TimeSort"] > $end) {
                    $edIndex = $key - 1;
                    break;
                }
            }
            if ($key === -1) {
                return null;
            }
            $output = array_slice($res, 0, $edIndex + 1);
        } else if (!empty($st) && empty($ed)) {
            foreach ($res as $key => $value) {
                if ($value["TimeSort"] >= $start) {
                    $stIndex = $key;
                    break;
                }
            }
            if ($key === -1) {
                return null;
            }
            $output = array_slice($res, $stIndex, count($res) - $stIndex);
        } else if (!empty($st) && !empty($ed)) {
            $getFirst = FALSE;
            foreach ($res as $key => $value) {
                if ($value["TimeSort"] >= $start && !$getFirst) {
                    $stIndex = $key;
                    $getFirst = TRUE;
                }
                if ($value["TimeSort"] > $end) {
                    $edIndex = $key - 1;
                    break;
                }
            }
            if ($edIndex < $stIndex) {
                return null;
            }
            $output = array_slice($res, $stIndex, $edIndex - $stIndex);
        }
        return $output;
    }

    public static function array_search_between_time1($res, $st = null, $ed = null) {
        $start = 0;
        $end = 0;
        if (!empty($st)) {
            $start = strtotime($st);
        }
        if (!empty($ed)) {
            $end = strtotime($ed);
        }
        $output = array();
        if (empty($st) && !empty($ed)) {
            foreach ($res as $key => $value) {
                if ($value["TimeSort"] <= $end) {
                    array_push($output, $value);
                }
            }
        } else if (!empty($st) && empty($ed)) {
            foreach ($res as $key => $value) {
                if ($value["TimeSort"] >= $start) {
                    array_push($output, $value);
                }
            }
        } else if (!empty($st) && !empty($ed)) {
            foreach ($res as $key => $value) {
                if ($value["TimeSort"] >= $start && $value["TimeSort"] <= $end) {
                    array_push($output, $value);
                }
            }
        }
        return $output;
    }

    public static function randomkeys($length) {
        $output = '';
        for ($a = 0; $a < $length; $a++) {
            $output .= chr(mt_rand(48, 57));    //生成php随机数
        }
        return $output;
    }

    public static function IndexOf($string, $c) {
        $index = strpos($string, $c);

        return substr($string, 0, $index);
    }

    // 获取访问用户的浏览器信息
    public static function determinebrowser ($Agent) {
        $browseragent="";   //浏览器
        $browserversion=""; //浏览器的版本
        if (ereg('MSIE ([0-9].[0-9]{1,2})',$Agent,$version)) {
            $browserversion=$version[1];
            $browseragent="Internet Explorer";
        } else if (ereg( 'Opera/([0-9]{1,2}.[0-9]{1,2})',$Agent,$version)) {
            $browserversion=$version[1];
            $browseragent="Opera";
        } else if (ereg( 'Firefox/([0-9.]{1,5})',$Agent,$version)) {
            $browserversion=$version[1];
            $browseragent="Firefox";
        }else if (ereg( 'Chrome/([0-9.]{1,3})',$Agent,$version)) {
            $browserversion=$version[1];
            $browseragent="Chrome";
        }
        else if (ereg( 'Safari/([0-9.]{1,3})',$Agent,$version)) {
            $browseragent="Safari";
            $browserversion="";
        }
        else {
            $browserversion="";
            $browseragent="Unknown";
        }
        return $browseragent." ".$browserversion;
    }

    // 获取访问用户的操作系统信息
    public static function determineplatform ($Agent) {
        $browserplatform=='';
            if (eregi('win',$Agent) && strpos($Agent, '95')) {
            $browserplatform="Windows 95";
        }
        elseif (eregi('win 9x',$Agent) && strpos($Agent, '4.90')) {
            $browserplatform="Windows ME";
        }
        elseif (eregi('win',$Agent) && ereg('98',$Agent)) {
            $browserplatform="Windows 98";
        }
        elseif (eregi('win',$Agent) && eregi('nt 5.0',$Agent)) {
            $browserplatform="Windows 2000";
        }
        elseif (eregi('win',$Agent) && eregi('nt 5.1',$Agent)) {
            $browserplatform="Windows XP";
        }
        elseif (eregi('win',$Agent) && eregi('nt 6.0',$Agent)) {
            $browserplatform="Windows Vista";
        }
        elseif (eregi('win',$Agent) && eregi('nt 6.1',$Agent)) {
            $browserplatform="Windows 7";
        }
        elseif (eregi('win',$Agent) && ereg('32',$Agent)) {
            $browserplatform="Windows 32";
        }
        elseif (eregi('win',$Agent) && eregi('nt',$Agent)) {
            $browserplatform="Windows NT";
        }
        elseif (eregi('Mac OS',$Agent)) {
            $browserplatform="Mac OS";
        }
        elseif (eregi('linux',$Agent)) {
            $browserplatform="Linux";
        }
        elseif (eregi('unix',$Agent)) {
            $browserplatform="Unix";
        }
        elseif (eregi('sun',$Agent) && eregi('os',$Agent)) {
            $browserplatform="SunOS";
        }
        elseif (eregi('ibm',$Agent) && eregi('os',$Agent)) {
            $browserplatform="IBM OS/2";
        }
        elseif (eregi('Mac',$Agent) && eregi('PC',$Agent)) {
            $browserplatform="Macintosh";
        }
        elseif (eregi('PowerPC',$Agent)) {
            $browserplatform="PowerPC";
        }
        elseif (eregi('AIX',$Agent)) {
            $browserplatform="AIX";
        }
        elseif (eregi('HPUX',$Agent)) {
            $browserplatform="HPUX";
        }
        elseif (eregi('NetBSD',$Agent)) {
            $browserplatform="NetBSD";
        }
        elseif (eregi('BSD',$Agent)) {
            $browserplatform="BSD";
        }
        elseif (ereg('OSF1',$Agent)) {
            $browserplatform="OSF1";
        }
        elseif (ereg('IRIX',$Agent)) {
            $browserplatform="IRIX";
        }
        elseif (eregi('FreeBSD',$Agent)) {
            $browserplatform="FreeBSD";
        }
        if ($browserplatform=='') {
            $browserplatform = "Unknown";
        }
        return $browserplatform;
    }

    public static function objectToArray($data) {
        if (is_array($data) || is_object($data)) {
            $result = array();
            foreach ($data as $key => $value) {
                $result[$key] = self::objectToArray($value);
            }
            return $result;
        }
        return $data;
    }

    public static function arrayToObject( $array ){
        foreach( $array as $key => $value ){
            if( is_array( $value ) ) $array[ $key ] = arrayToObject( $value );
        }
        return (object) $array;
    }

    public static function get_url_root() {
        static $root;
        if ($root) {
            return $root;
        }

        $script = $_SERVER["SCRIPT_NAME"];
        $dir = str_replace("\\", "/", dirname(__FILE__));
        $tmpArr = explode("/", $dir);

        $root = "/";
        for ($n = 1; $n < count($tmpArr) - 1; $n++) {
            if (strpos($script, $tmpArr[$n]) !== false) {
                $root .= $tmpArr[$n] . "/";
            }
        }
        return $root;
    }

    public static function type_is_img($type) {
        return in_array($type, array("jpg", "jpeg", "gif", "png"));
    }

    public static function img_to_base64($file) {
        if($fp = fopen($file,"rb", 0)){
            $binary = fread($fp,filesize($file));
            fclose($fp);

            $base64 = chunk_split(base64_encode($binary));
            return $base64;
        }
    }

    public static function str_check($str) { 
        if (!get_magic_quotes_gpc()) {
            $str = addslashes($str);
        } 
        $str = str_replace("_", "\_", $str);
        $str = str_replace("%", "\%", $str);
        $str = nl2br($str);
        $str = htmlspecialchars($str);
        return $str; 
    }

    public static  function getUrlRoot() {
        $port = "";
        if ($_SERVER["SERVER_PORT"] != '80') {
            $port = ":" . $_SERVER["SERVER_PORT"];
        }
        $url = "http://" . $_SERVER["SERVER_NAME"] . $port . getC("APP_URL");
        return $url;
    }

    public static function createApiToken($baseKey) {
        $tmpt = strtolower(md5($baseKey));
        $tmpt = strtolower(md5(substr($tmpt, 3, 12)));
        return $tmpt;
    }
}
?>