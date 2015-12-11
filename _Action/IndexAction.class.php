<?php
/**
 *
 * @author xieq
 * @date    2015-02-09 11:08:29
 *
 */

class IndexAction extends BaseAction {

    function __before() {

    }

    function index() {
        renderView('index', 'index');
    }

    function test() {
    	echo "test woking...";
    }

    function testApi() {
    	$res = DemoApiCenterFacade::getApi('DemoApi', 'NOWFirstPageImagesQuery', array(
    		'Page' => 1,
    		'PageSize' => '5',
    		'NOWFirstPageImagesID' => null
    	));

    	renderJson($res);
    }
}