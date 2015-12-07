<?php
/**
 *
 * @authors xieq
 * @date    2014-10-13 17:55:53
 */

abstract class BBaseFacade {

	protected static $act;
    protected static $url;
    protected static $ss;
    protected static $uid;
    protected static $key;
    protected static $token;

    abstract static function share($name, $act);


    abstract function cacheTimeLength();

    /**
     * 返回ApiHeaderPara
     * @return string
     */
    private function getApiHeaderPara() {
        $cd = new ApiHeaderPara();
        $cd->token = self::$token;
        $cd->act = self::$act;
        $cd->os = CommHelper::determineplatform($_SERVER['HTTP_USER_AGENT']);
        $cd->dv = CommHelper::determineplatform($_SERVER['HTTP_USER_AGENT']);
        $cd->dt = CommHelper::determinebrowser($_SERVER['HTTP_USER_AGENT']);
        $cd->ss = self::$ss;
        $cd->uid = self::$uid;
        return "h=" . MyDes::share()->encode(json_encode($cd), self::$key);
    }

    /**
     * 返回PrivatePara
     * @return string
     */
    public function getPrivatePara($privateParaClass) {

        if($privateParaClass) {
            return "&p=" . MyDes::share()->encode(json_encode($privateParaClass),  self::$key);
        }
        else {
            return null;
        }
    }

    /**
     * 封装curl的调用接口，post的请求方式
     * @return array()
     */
    protected function doCurlPostRequest($privatePara, $isDES, $timeout = 15, $url = "", $isCache = true) {

        $url = self::$url;
        $requestString = $this->getApiHeaderPara();
        $requestString = $requestString . $privatePara;

        if ($url == "" || $requestString == "" || $timeout <= 0) {
            return false;
        }

        $isCache = $isCache && $this->cacheTimeLength() > 0;
        if ($isCache) {
            $mc = MC();
            $mk_d = self::$act . "_" . md5($privatePara);
            $mk_t = $mk_d . "_lasttime2";

            if ($mc->get($mk_t)) {
                $data = $mc->get($mk_d);
                if ($data) {
                    return $data;
                }
            } else {
                $mc->set2($mk_t, "1", $this->cacheTimeLength());
            }
        }

        $data = $this->post($url, $requestString);

        if ($isDES) {
            $data = MyDes::share()->decode($data,  self::$key);
        }

        if ($isCache) {
            //数据最长保存一小时（实际缓存时间为$mk_t的缓存时间）
            $mc->set($mk_d, $data, 60 * 60);
        }

        return $data;
    }

    function post($url, $requestString) {
        $con = curl_init((string) $url);
        curl_setopt($con, CURLOPT_HEADER, false);
        curl_setopt($con, CURLOPT_POSTFIELDS, $requestString);
        curl_setopt($con, CURLOPT_POST, true);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($con, CURLOPT_TIMEOUT, (int) $timeout);
        $data = curl_exec($con);
        $httpCode = curl_getinfo($con, CURLINFO_HTTP_CODE);
        curl_close($con);
        if ($httpCode == 200) {
            return $data;
        } else {
            return false;
        }
    }
}