<?php

class BaseAction extends Action {

    function alertMsg($msg) {
        header("Cache-control: no-store");
        $str = "<script type='text/javascript'>\n";
        $str .= "alert('{$msg}');\n";
        $str .= "location.href = '{$_SERVER['HTTP_REFERER']}';\n";
        $str .= "</script>";
        echo $str;
    }

    function alertMsgToUrl($msg, $url) {
        header("Cache-control: no-store");
        $str = "<script type='text/javascript'>\n";
        $str .= "alert('{$msg}');\n";
        $str .= "location.href = '{$url}';\n";
        $str .= "</script>";
        echo $str;
    }

    function alert($msg) {
        header("Cache-control: no-store");
        $str = "<script type='text/javascript'>\n";
        $str .= "alert('{$msg}');\n";
        $str .= "</script>";
        echo $str;
    }

    function redirect() {
        header("Cache-control: no-store");
        $str = "<script type='text/javascript'>\n";
        $str .= "location.href = '{$_SERVER['HTTP_REFERER']}';\n";
        $str .= "</script>";
        echo $str;
    }

    function redirectToUrl($url) {
        header("Cache-control: no-store");
        $str = "<script type='text/javascript'>\n";
        $str .= "location.href = '{$url}';\n";
        $str .= "</script>";
        echo $str;
    }

    function clueError($msg = "操作失败！", $toUrl = null) {
        if (!$toUrl) {
            $toUrl = $_SERVER["HTTP_REFERER"];
        }
        renderString("<script>alert('「×」 {$msg}');location.href='{$toUrl}'</script>");
    }

    function clueTrue($msg = "操作成功！", $toUrl = null) {
        if (!$toUrl) {
            $toUrl = $_SERVER["HTTP_REFERER"];
        }
        renderString("<script>alert('【√】 {$msg}');location.href='{$toUrl}'</script>");
    }

    function getCache() {
        return MC();
    }

}

?>
