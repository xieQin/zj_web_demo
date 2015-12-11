<?php
/**
 *
 * @authors xieq
 * @date    2014-10-15 14:51:18
 */

class LoginService {

    static function doLogin($user) {
    	$userID = MyDes::share()->encode($user->id, DES_KEY);
        $str = $userID . "###" . rands(30);
        $user->SIMULATION_LOGIN_STR = $str;
        set_cookie(getC('LOGIN_KEY'), $str , time() + 60*60*24);
        self::saveLogin($user, $userID);
    }

    static function saveLogin($user, $userID) {
        $mc = MC();
        $mmk = getC('LOGIN_KEY') . "_" . $userID;

        $mc->set($mmk, $user, 60*60*24);
    }

    static function loginOut() {
        $user = self::getLoginUser();
        $userID = MyDes::share()->encode($user->id, DES_KEY);
        self::delLoginInfo($userID);
        set_cookie(getC('LOGIN_KEY'), 0, -1);
    }

    static function delLoginInfo($mid) {
        $mc = MC();
        $mmk = getC('LOGIN_KEY') . "_" . $mid;
        $mc->delete($mmk);
    }

    static function getLoginUser() {
        $str = get_cookie(getC('LOGIN_KEY'));
        $arr = explode("###", $str);

        $mc = MC();
        $mk = getC('LOGIN_KEY') . "_" . $arr[0];
        $obj = $mc->get($mk);

        if ($str && $obj->SIMULATION_LOGIN_STR == $str) {
            return $obj;
        }
        return null;
    }

    static function checkLoginValid() {
        $user = self::getLoginUser();
        if($user == null) {
            echo "please login in...";
            exit;
        }
        else {
            return true;
        }
    }
}
