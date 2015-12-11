<?php
/**
 *
 * @authors xieq
 * @date    2014-10-13 17:53:05
 */

class ApiServiceFacade extends BBaseFacade {

    /**
     * @return ApiServiceFacade
     */
    static function share($apiname, $act) {
        static $ins = null;
        $config = getC($apiname);
        self::$act = $act;
        self::$key = @$config['DES_KEY'];
        self::$token = @$config["token"];
        if (!$ins) {
            self::$url = @$config['url'];
            $ins = new ApiServiceFacade();
        }
        return $ins;
    }

    public function cacheTimeLength() {
        return 5;
    }

    public function getPara($para = NULL, $isDES = TRUE, $isJSON = TRUE) {
        $privatePara = $this->getPrivatePara($para);
        if($isJSON) {
            $curlResult = json_decode($this->doCurlPostRequest($privatePara, $isDES));
        }
        else {
            $curlResult = $this->doCurlPostRequest($privatePara, $isDES);
        }

        return $curlResult;
    }
}