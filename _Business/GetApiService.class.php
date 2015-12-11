<?php
/**
 * Get请求方式的api调用
 * @author xieq
 * @date    2015-12-10 10:30:57
 * @version $Id$
 */

class GetApiService {

	/**
     * [getDES get请求 放回数据DES加密接口]
     * @param {String} $api 必须传，api名 用于获取相应配置
     * @param {String} $act 必须传，请求的api接口
     * @param {Array} $para 请求参数
     * @return {Json} 请求返回数据
     */
	function getDES($api, $act, $para) {
		$apiconfig = getC($api);
		$url = @$apiconfig['url'];
		$token = @$apiconfig['apitoken'];
		$para = self::getPara($para);
		$url = $url . "/". $act ."?" . $para . "&apitoken=" . $token;
    	$res = CURLHandler::share()->query($url);
    	$res = MyDes::share()->decode($res, @$apiconfig['DES_KEY']);
    	$res = json_decode($res);
    	return $res;
	}

	/**
     * [getPara 参数转换]
     * @param {Array} $para 需要转换的参数数组
     * @return {String} 转换后的参数 用于get请求传参
     */
	function getPara($para) {
		$p = '';
		foreach ($para as $key => $value) {
			$p .= $key . '=' . $value . "&";
		}
		$p = substr($p, 0, -1);
		return $p;
	}
}