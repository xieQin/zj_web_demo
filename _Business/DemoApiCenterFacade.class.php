<?php
/**
 *
 * @author xieq
 * @date    2015-05-20 11:13:37
 */

class DemoApiCenterFacade {

    function getApi($apiname, $act, $para) {
    	$res = ApiServiceFacade::share($apiname, $act)->getPara($para);

    	return $res;
    }
}